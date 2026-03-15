const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const cors = require("cors");
const config = require("./config");
const authenticateSocket = require("./auth");
const { setupSocketHandlers, emitChatLocked } = require("./socket");

// Initialize Express app
const app = express();
const server = http.createServer(app);

// Parse CORS origin: support comma-separated list or single value
const rawOrigin = config.CORS_ORIGIN || '*';
const corsOriginList = rawOrigin === '*'
	? null  // null = wildcard
	: rawOrigin.split(',').map(s => s.trim());

console.log("Allowed CORS origins:", corsOriginList || '*');

// ── Manual CORS middleware (runs BEFORE everything, survives reverse proxies) ──
// NOTE: Hostinger CDN (hcdn) strips the incoming Origin request header before
// forwarding to Node. So req.headers.origin is undefined on the server side.
// Fix: always respond with the configured origin unconditionally.
app.use((req, res, next) => {
	const requestOrigin = req.headers.origin;
	const allowedOrigin = corsOriginList
		? (requestOrigin && corsOriginList.includes(requestOrigin)
			? requestOrigin          // request origin present + matched: echo it
			: corsOriginList[0])     // CDN stripped it: use configured origin
		: (requestOrigin || '*');    // wildcard mode: echo request origin or *

	res.setHeader('Access-Control-Allow-Origin', allowedOrigin);
	res.setHeader('Access-Control-Allow-Credentials', 'true');
	res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
	res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
	res.setHeader('Vary', 'Origin');

	// Respond immediately to preflight OPTIONS requests
	if (req.method === 'OPTIONS') {
		return res.sendStatus(204);
	}

	next();
});

// cors() package as secondary layer
app.use(
	cors({
		origin: corsOriginList || '*',
		credentials: true,
	}),
);
app.use(express.json());

// Initialize Socket.io
const io = new Server(server, {
	cors: {
		origin: corsOriginList || '*',
		methods: ["GET", "POST"],
		credentials: true,
	},
	path: config.SOCKET_PATH,
	// polling first: ensures compatibility with reverse proxies (Hostinger)
	transports: ["polling", "websocket"],
	allowEIO3: true,
});

console.log("=".repeat(50));
console.log("Socket.IO Configuration:");
console.log("CORS Origin:", config.CORS_ORIGIN);
console.log("Socket Path:", config.SOCKET_PATH);
console.log("Transports: websocket, polling");
console.log("=".repeat(50));

// Apply authentication middleware to all socket connections
io.use(authenticateSocket);

// ── Inject CORS headers at the engine.io level ──────────────────────────────
// Socket.IO polling requests hit engine.io BEFORE Express middleware.
// Same unconditional-origin fix applied here: Hostinger CDN strips req Origin.
io.engine.on("headers", (headers, req) => {
	const requestOrigin = req.headers && req.headers.origin;
	const allowedOrigin = corsOriginList
		? (requestOrigin && corsOriginList.includes(requestOrigin)
			? requestOrigin
			: corsOriginList[0])     // CDN stripped Origin: use configured origin
		: (requestOrigin || '*');

	headers["Access-Control-Allow-Origin"] = allowedOrigin;
	headers["Access-Control-Allow-Credentials"] = "true";
	headers["Access-Control-Allow-Methods"] = "GET, POST, OPTIONS";
	headers["Access-Control-Allow-Headers"] = "Content-Type, Authorization, X-Requested-With";
	headers["Vary"] = "Origin";
});
// ────────────────────────────────────────────────────────────────────────────

// Setup socket event handlers
setupSocketHandlers(io);

// REST endpoint for PHP to notify chat locked
app.post("/api/chat-locked", (req, res) => {
	const { chat_id } = req.body;

	if (!chat_id) {
		return res.status(400).json({
			success: false,
			message: "chat_id is required",
		});
	}

	// Emit chat locked event to the room
	emitChatLocked(io, chat_id);

	res.json({
		success: true,
		message: "Chat locked event emitted",
	});
});

// Health check endpoint
app.get("/health", (req, res) => {
	res.json({
		status: "ok",
		timestamp: new Date().toISOString(),
		connections: io.engine.clientsCount,
	});
});

// Debug endpoint: shows what request headers actually reach Node.js
// Hit this from your browser: https://red-squid-975501.hostingersite.com/debug-headers
// If 'origin' is missing in receivedHeaders, Hostinger CDN is stripping it
app.get("/debug-headers", (req, res) => {
	res.json({
		receivedHeaders: req.headers,
		configuredCorsOrigin: config.CORS_ORIGIN,
		corsOriginList: corsOriginList,
		note: "If 'origin' is absent here, CDN strips it. The unconditional fallback in server.js handles this."
	});
});

// Start server
server.listen(config.PORT, () => {
	console.log("=".repeat(50));
	console.log("EquipManager Chat Server");
	console.log("=".repeat(50));
	console.log(`Server running on port: ${config.PORT}`);
	console.log(`PHP API URL: ${config.PHP_API_URL}`);
	console.log(`CORS Origin: ${config.CORS_ORIGIN}`);
	console.log(`Socket.io path: ${config.SOCKET_PATH}`);
	console.log("=".repeat(50));
});

// Graceful shutdown
process.on("SIGTERM", () => {
	console.log("SIGTERM received, shutting down gracefully...");
	server.close(() => {
		console.log("Server closed");
		process.exit(0);
	});
});

process.on("SIGINT", () => {
	console.log("SIGINT received, shutting down gracefully...");
	server.close(() => {
		console.log("Server closed");
		process.exit(0);
	});
});
