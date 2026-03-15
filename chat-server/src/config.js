require("dotenv").config();

module.exports = {
	// Server configuration
	PORT: process.env.PORT || 3000,

	// PHP API configuration - supports both localhost and ngrok
	PHP_API_URL: process.env.PHP_API_URL || "http://localhost/equipmanager",
	PHP_API_URL_NGROK: process.env.PHP_API_URL_NGROK || null,

	// Allow client to specify which PHP URL to use
	ACCEPT_PHP_URL_FROM_CLIENT: process.env.ACCEPT_PHP_URL_FROM_CLIENT === "true",

	// Shared secret for Node.js → PHP API calls (must match PHP NODE_API_SECRET env var)
	// Set in chat-server/.env — see .env.example
	NODE_API_SECRET: process.env.NODE_API_SECRET || "",

	// JWT configuration (must match PHP JWT_SECRET env var)
	// Set in chat-server/.env — see .env.example
	JWT_SECRET: process.env.JWT_SECRET || "",

	// CORS configuration
	CORS_ORIGIN: process.env.CORS_ORIGIN || "http://localhost",

	// Socket.io configuration
	SOCKET_PATH: "/socket.io",

	// Logging
	LOG_LEVEL: process.env.LOG_LEVEL || "info",
};
