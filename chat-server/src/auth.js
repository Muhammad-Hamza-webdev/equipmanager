const jwt = require("jsonwebtoken");
const config = require("./config");

/**
 * Socket.io authentication middleware
 * Verifies JWT token is valid and not expired
 * JWT contains user_id, chat_id, and role - no need to call PHP for initial auth
 */
async function authenticateSocket(socket, next) {
	try {
		const token = socket.handshake.auth.token;

		if (!token) {
			console.error("Authentication error: No token provided");
			return next(new Error("Authentication token required"));
		}

		// Verify JWT signature and expiration
		let decoded;
		try {
			decoded = jwt.verify(token, config.JWT_SECRET);
			console.log("[Auth] JWT verified successfully");
		} catch (err) {
			console.error("[Auth] JWT verification failed:", err.message);
			return next(new Error("Invalid or expired token"));
		}

		// Validate required fields in token
		if (!decoded.user_id || !decoded.chat_id || !decoded.role) {
			console.error("[Auth] Invalid token payload - missing required fields");
			return next(new Error("Invalid token payload"));
		}

		// Attach user data to socket from JWT
		socket.userId = decoded.user_id;
		socket.chatId = decoded.chat_id;
		socket.userRole = decoded.role;
		socket.chatStatus = "open"; // Default to open, can be updated if needed

		console.log(
			`[Auth] ✓ User ${socket.userId} authenticated for chat ${socket.chatId} as ${socket.userRole}`,
		);

		next();
	} catch (error) {
		console.error("[Auth] Authentication middleware error:", error.message);
		next(new Error("Authentication failed"));
	}
}

module.exports = authenticateSocket;
