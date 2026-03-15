const phpApi = require("./phpApi");

/**
 * Socket.io event handlers
 * Handles real-time chat events and broadcasts
 */
function setupSocketHandlers(io) {
	io.on("connection", (socket) => {
		console.log(
			`Socket connected: ${socket.id} (User: ${socket.userId}, Chat: ${socket.chatId})`,
		);

		/**
		 * Join chat room
		 */
		socket.on("join_chat", (data) => {
			const roomName = `chat_${socket.chatId}`;

			// Join the room
			socket.join(roomName);

			console.log(`User ${socket.userId} joined room ${roomName}`);

			// Notify user they've joined
			socket.emit("joined_chat", {
				chat_id: socket.chatId,
				room: roomName,
				status: socket.chatStatus,
			});
		});

		/**
		 * Send message
		 * Validates via PHP API then broadcasts to room
		 */
		socket.on("send_message", async (data) => {
			try {
				let { chat_id, message, php_api_url } = data;

				// Ensure chat_id is a number
				chat_id = parseInt(chat_id, 10);
				const socketChatId = parseInt(socket.chatId, 10);

				console.log("[Message] Received send_message event:");
				console.log("[Message] socket.chatId (from JWT):", socketChatId, "(type:", typeof socketChatId + ")");
				console.log("[Message] chat_id (from client):", chat_id, "(type:", typeof chat_id + ")");
				console.log("[Message] Match:", chat_id === socketChatId ? "✓ YES" : "✗ NO");
				if (php_api_url) {
					console.log("[Message] PHP API URL from client:", php_api_url);
				}

				// Validate chat_id matches authenticated user's chat
				if (chat_id !== socketChatId) {
					console.error(
						`[Message] ✗ Invalid chat ID - Expected: ${socketChatId}, Got: ${chat_id}`,
					);
					socket.emit("error", {
						message: `Invalid chat ID - Expected: ${socketChatId}, Got: ${chat_id}`,
					});
					return;
				}

				// Validate message
				if (!message || typeof message !== "string") {
					socket.emit("error", { message: "Invalid message" });
					return;
				}

				const trimmedMessage = message.trim();
				if (trimmedMessage.length === 0 || trimmedMessage.length > 2500) {
					socket.emit("error", {
						message: "Message must be between 1 and 2500 characters",
					});
					return;
				}

				// Save message via PHP API (source of truth)
				// Pass PHP API URL from client if provided
				const result = await phpApi.saveMessage(
					socketChatId,
					socket.userId,
					trimmedMessage,
					php_api_url,
				);

				if (!result.success) {
					socket.emit("error", {
						message: result.message || "Failed to send message",
					});
					return;
				}

				// Broadcast to all users in the chat room
				const roomName = `chat_${socketChatId}`;
				io.to(roomName).emit("new_message", {
					message_id: result.message_id,
					chat_id: socketChatId,
					sender_user_id: socket.userId,
					sender_name: result.sender_name,
					message: trimmedMessage,
					timestamp: result.timestamp,
				});

				console.log(
					`[Message] ✓ Message sent in chat ${socketChatId} by user ${socket.userId}`,
				);
			} catch (error) {
				console.error("[Message] Error sending message:", error);
				socket.emit("error", { message: "Server error while sending message" });
			}
		});

		/**
		 * Disconnect
		 */
		socket.on("disconnect", () => {
			console.log(`Socket disconnected: ${socket.id} (User: ${socket.userId})`);
		});
	});
}

/**
 * Emit chat locked event to a specific chat room
 * Called by PHP when order is completed/cancelled
 *
 * @param {object} io - Socket.io server instance
 * @param {number} chatId
 */
function emitChatLocked(io, chatId) {
	const roomName = `chat_${chatId}`;
	io.to(roomName).emit("chat_locked", {
		chat_id: chatId,
		timestamp: new Date().toISOString(),
	});
	console.log(`Chat ${chatId} locked event emitted to room ${roomName}`);
}

module.exports = {
	setupSocketHandlers,
	emitChatLocked,
};
