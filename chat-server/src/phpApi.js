const axios = require("axios");
const config = require("./config");

/**
 * PHP API client
 * All business logic validation happens in PHP
 * Supports dynamic PHP API URL for both localhost and ngrok
 */

/**
 * Get the appropriate PHP API URL
 * @param {string} clientPhpUrl - Optional PHP API URL from client
 * @returns {string}
 */
function getPHPApiUrl(clientPhpUrl) {
	// If client specifies URL and we accept it, use that
	if (config.ACCEPT_PHP_URL_FROM_CLIENT && clientPhpUrl) {
		return clientPhpUrl;
	}
	// Otherwise use default or ngrok URL
	return config.PHP_API_URL;
}

/**
 * Validate chat access
 *
 * @param {number} chatId
 * @param {number} userId
 * @param {string} phpApiUrl - Optional PHP API URL
 * @returns {Promise<{success: boolean, role: string, chat_status: string}>}
 */
async function validateChatAccess(chatId, userId, phpApiUrl = null) {
	try {
		const apiUrl = getPHPApiUrl(phpApiUrl);
		const endpoint = `${apiUrl}/chat/api_validate`;
		
		console.log("[PHP API] Validating chat access:");
		console.log("[PHP API] Endpoint:", endpoint);
		console.log("[PHP API] Chat ID:", chatId, "User ID:", userId);
		
		const response = await axios.post(
			endpoint,
			{
				chat_id: chatId,
				user_id: userId,
			},
			{
				headers: {
					"Content-Type": "application/json",
					// Send shared secret so PHP can verify this is the trusted Node server
					"X-Node-Secret": config.NODE_API_SECRET,
				},
				timeout: 5000,
			},
		);

		console.log("[PHP API] ✓ Validation response:", response.data);
		return response.data;
	} catch (error) {
		console.error("[PHP API] ✗ Validation error:");
		console.error("[PHP API] Error message:", error.message);
		if (error.response) {
			console.error("[PHP API] Response status:", error.response.status);
			console.error("[PHP API] Response data:", error.response.data);
		} else if (error.request) {
			console.error("[PHP API] No response received - request made but no response");
		}
		return {
			success: false,
			message: "API validation failed",
		};
	}
}

/**
 * Save message via PHP API
 *
 * @param {number} chatId
 * @param {number} userId
 * @param {string} message
 * @param {string} phpApiUrl - Optional PHP API URL
 * @returns {Promise<{success: boolean, message_id: number, timestamp: string}>}
 */
async function saveMessage(chatId, userId, message, phpApiUrl = null) {
	try {
		const apiUrl = getPHPApiUrl(phpApiUrl);
		const endpoint = `${apiUrl}/chat/api_send`;
		
		console.log("[PHP API] Saving message:");
		console.log("[PHP API] Endpoint:", endpoint);
		console.log("[PHP API] Data:", { chat_id: chatId, user_id: userId, message: message.substring(0, 50) + "..." });
		
		const response = await axios.post(
			endpoint,
			{
				chat_id: chatId,
				user_id: userId,
				message: message,
			},
			{
				headers: {
					"Content-Type": "application/json",
					// Send shared secret so PHP can verify this is the trusted Node server
					"X-Node-Secret": config.NODE_API_SECRET,
				},
				timeout: 5000,
			},
		);

		console.log("[PHP API] ✓ Response:", response.data);
		return response.data;
	} catch (error) {
		console.error("[PHP API] ✗ Save message error:");
		console.error("[PHP API] Error message:", error.message);
		if (error.response) {
			console.error("[PHP API] Response status:", error.response.status);
			console.error("[PHP API] Response data:", error.response.data);
		} else if (error.request) {
			console.error("[PHP API] No response received:", error.request);
		}
		return {
			success: false,
			message: error.response?.data?.message || error.message || "Failed to save message",
		};
	}
}

module.exports = {
	validateChatAccess,
	saveMessage,
	getPHPApiUrl,
};
