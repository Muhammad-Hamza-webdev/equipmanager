<!-- Chat Header -->
<div class="chat-header">
    <button class="back-button" onclick="goBack()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
    </button>
    
    <div class="chat-header-info">
        <div class="user-avatar" style="background-color: var(--primary-brand);"></div>
        <div class="user-details">
            <div class="user-name">
                <?php if ($user_role === 'buyer'): ?>
                    <?= htmlspecialchars($chat->sellerUserName ?: $chat->sellerCompanyName ?: 'Seller') ?>
                <?php else: ?>
                    <?= htmlspecialchars($chat->buyerFirstName . ' ' . $chat->buyerLastName) ?>
                <?php endif; ?>
            </div>
            <div class="user-status">Order #<?= $chat->equipmentPaymentID ?> • $<?= number_format($chat->grossAmount, 2) ?></div>
        </div>
    </div>

    <div class="status-badge <?= htmlspecialchars($chat->chatStatus) ?>">
        <?= ucfirst(htmlspecialchars($chat->chatStatus)) ?>
    </div>
</div>

<!-- Messages Area -->
<div class="messages-area" id="messagesArea">
    <?php if (!empty($messages)): ?>
        <?php 
        $last_date = null;
        foreach ($messages as $message): 
            $message_date = date('M j, Y', strtotime($message->createdAt));
            
            // Show date separator if date changed
            if ($last_date !== $message_date):
                $last_date = $message_date;
        ?>
            <div class="date-separator">
                <span><?= $message_date ?></span>
            </div>
        <?php endif; 
            
            $is_outgoing = ($message->senderUserID == $current_user_id);
            $message_class = $is_outgoing ? 'outgoing' : 'incoming';
            $timestamp = date('g:i A', strtotime($message->createdAt));
        ?>
            
            <div class="message-wrapper <?= $message_class ?>">
                <?php if ($is_outgoing): ?>
                    <div class="message-options">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" cursor="pointer">
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                        </svg>
                    </div>
                <?php endif; ?>
                
                <div class="message-content">
                    <div class="message-bubble <?= $message_class ?>">
                        <?= htmlspecialchars($message->messageText) ?>
                    </div>
                    <div class="message-timestamp">
                        <?= $timestamp ?>
                        <?php if (!$is_outgoing && !empty($message->firstName)): ?>
                            • <?= htmlspecialchars($message->firstName) ?>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($is_outgoing): ?>
                        <div class="read-receipt">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if (!$is_outgoing): ?>
                    <div class="message-options">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" cursor="pointer">
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-messages">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            <p>No messages yet. Start the conversation!</p>
        </div>
    <?php endif; ?>
</div>

<!-- Input Area -->
<?php if (isset($chat->orderStatus) && $chat->orderStatus === 'completed'): ?>
<div class="order-completed-banner">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
    <div class="order-completed-text">
        <strong>Order Completed</strong>
        <span>This order has been completed successfully. No further messages can be sent.</span>
    </div>
</div>
<?php else: ?>
<div class="chat-input-area">
    <button class="input-button add-button" id="addButton">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </button>
    
    <input 
        type="text" 
        class="message-input" 
        id="messageInput"
        placeholder="Type a message here"
    >
    
    <button class="input-button send-button" id="sendButton">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
        </svg>
    </button>
</div>
<?php endif; ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Chat container structure */
    :host {
        display: contents;
    }

    .chat-header {
        padding: 20px 32px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--card-bg);
        flex-shrink: 0;
    }

    .back-button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.2s ease;
    }

    .back-button:hover {
        opacity: 0.7;
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-weight: bold;
        font-size: 18px;
        flex-shrink: 0;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .user-name {
        font-weight: 700;
        font-size: 16px;
        color: var(--text-primary);
    }

    .user-status {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        border: 1px solid transparent;
        margin-left: auto;
        flex-shrink: 0;
    }

    .status-badge.open {
        background: #e6f7f0;
        color: #0d7a2c;
        border-color: rgba(13, 122, 44, 0.2);
    }

    .status-badge.locked {
        background: #fff5f5;
        color: #d32f2f;
        border-color: rgba(211, 47, 47, 0.2);
    }

    /* Messages area - FIXED HEIGHT with scrolling */
    .messages-area {
        flex: 1;
        padding: 24px 32px;
        overflow-y: auto;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: var(--card-bg);
        min-height: 300px;
    }

    /* Custom Scrollbar */
    .messages-area::-webkit-scrollbar {
        width: 8px;
    }

    .messages-area::-webkit-scrollbar-track {
        background: transparent;
    }

    .messages-area::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 10px;
        background-clip: padding-box;
    }

    .messages-area::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    .date-separator {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: 8px 0;
        flex-shrink: 0;
    }

    .date-separator span {
        font-size: 12px;
        color: #9CA3AF;
        background: var(--card-bg);
        padding: 0 16px;
        z-index: 1;
        position: relative;
    }

    .date-separator::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        border-bottom: 1px solid #F3F4F6;
        z-index: 0;
    }

    .message-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
        flex-shrink: 0;
    }

    .message-wrapper.incoming {
        justify-content: flex-start;
    }

    .message-wrapper.outgoing {
        justify-content: flex-end;
    }

    .message-options {
        width: 20px;
        height: 20px;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.2s ease;
        flex-shrink: 0;
    }

    .message-wrapper:hover .message-options {
        opacity: 1;
    }

    .message-content {
        display: flex;
        flex-direction: column;
        gap: 4px;
        max-width: 70%;
    }

    .message-bubble {
        padding: 12px 16px;
        border-radius: 12px;
        word-wrap: break-word;
        font-size: 15px;
        line-height: 1.4;
        min-width: 0;
    }

    .message-bubble.incoming {
        background: #F3F4F6;
        color: var(--text-primary);
        border-bottom-left-radius: 4px;
    }

    .message-bubble.outgoing {
        background: var(--primary-brand);
        color: var(--text-light);
        border-bottom-right-radius: 4px;
    }

    .message-timestamp {
        font-size: 12px;
        color: var(--text-secondary);
        padding: 0 8px;
    }

    .message-wrapper.outgoing .message-timestamp {
        text-align: right;
        color: #9CA3AF;
    }

    .read-receipt {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 8px;
    }

    .no-messages {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-align: center;
        gap: 16px;
        padding: 40px;
    }

    .no-messages i, .no-messages svg {
        font-size: 56px;
        opacity: 0.25;
        color: var(--primary-brand);
    }

    .no-messages p {
        font-size: 15px;
        margin: 0;
        font-weight: 500;
        color: var(--text-primary);
    }

    .no-messages p:last-child {
        font-size: 13px;
        color: var(--text-secondary);
        font-weight: 400;
    }

    /* Input Area */
    .chat-input-area {
        padding: 20px 32px;
        border-top: 1px solid var(--border-color);
        background: var(--card-bg);
        flex-shrink: 0;
        display: flex;
        gap: 12px;
        align-items: flex-end;
    }

    .input-button {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: none;
        background: var(--primary-brand);
        color: var(--text-light);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .input-button:hover:not(:disabled) {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(19, 55, 46, 0.3);
    }

    .input-button:active:not(:disabled) {
        transform: translateY(0);
    }

    .input-button:disabled {
        background: #D1D5DD;
        cursor: not-allowed;
        color: #9CA3AF;
    }

    .add-button {
        background: #E5E7EB;
        color: var(--text-primary);
    }

    .add-button:hover:not(:disabled) {
        background: #D1D5DD;
    }

    .message-input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 15px;
        font-family: inherit;
        color: var(--text-primary);
        outline: none;
        transition: all 0.2s ease;
        resize: none;
        max-height: 100px;
    }

    .message-input:focus {
        border-color: var(--primary-brand);
        box-shadow: 0 0 0 3px rgba(19, 55, 46, 0.1);
    }

    .message-input::placeholder {
        color: var(--text-secondary);
    }

    .message-input:disabled {
        background: #F3F4F6;
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    /* Order Completed Banner */
    .order-completed-banner {
        padding: 18px 32px;
        border-top: 1px solid #D1FAE5;
        background: linear-gradient(135deg, #ECFDF5 0%, #F0FDF4 100%);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 14px;
        color: #065F46;
    }

    .order-completed-banner svg {
        flex-shrink: 0;
        color: #059669;
    }

    .order-completed-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .order-completed-text strong {
        font-size: 15px;
        font-weight: 700;
        color: #065F46;
    }

    .order-completed-text span {
        font-size: 13px;
        color: #047857;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chat-header {
            padding: 16px 24px;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .user-name {
            font-size: 15px;
        }

        .user-status {
            font-size: 12px;
        }

        .messages-area {
            padding: 16px 20px;
        }

        .message-content {
            max-width: 85%;
        }

        .chat-input-area {
            padding: 16px 20px;
            gap: 10px;
        }

        .input-button {
            width: 36px;
            height: 36px;
        }

        .message-input {
            padding: 10px 12px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .chat-header {
            padding: 12px 16px;
            flex-wrap: wrap;
        }

        .back-button {
            width: 32px;
            height: 32px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
        }

        .user-name {
            font-size: 14px;
        }

        .user-status {
            font-size: 11px;
        }

        .status-badge {
            padding: 4px 10px;
            font-size: 10px;
        }

        .messages-area {
            padding: 12px 16px;
            gap: 12px;
        }

        .message-content {
            max-width: 100%;
        }

        .message-bubble {
            padding: 10px 14px;
            font-size: 14px;
        }

        .chat-input-area {
            padding: 12px 16px;
            gap: 8px;
        }

        .input-button {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }

        .message-input {
            padding: 10px 12px;
            font-size: 14px;
        }
    }
</style>

<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

<script>
    // Configuration - Auto-detect Socket.IO server
    const protocol = window.location.protocol === 'https:' ? 'https' : 'http';
    const hostname = window.location.hostname;
    const port = window.location.port ? ':' + window.location.port : '';
    
    // Default Socket.IO server URL
    let SOCKET_SERVER_URL = 'http://localhost:3000';
    
    if (hostname !== 'localhost' && hostname !== '127.0.0.1') {
        SOCKET_SERVER_URL = protocol + '://' + hostname + ':3000';
    }
    
    // PHP-injected values (override defaults)
    const PHP_CONFIGURED_NODE_URL = '<?= defined('CHAT_NODE_SERVER_URL') ? CHAT_NODE_SERVER_URL : '' ?>';
    if (PHP_CONFIGURED_NODE_URL) {
        SOCKET_SERVER_URL = PHP_CONFIGURED_NODE_URL;
    }
    
    const JWT_TOKEN = '<?= $jwt_token ?>';
    const CHAT_ID = <?= isset($chat) ? (int)$chat->chatID : 'null' ?>;
    const CURRENT_USER_ID = <?= isset($current_user_id) ? (int)$current_user_id : 'null' ?>;
    const CHAT_STATUS = '<?= isset($chat) ? $chat->chatStatus : 'unknown' ?>';

    console.log('='.repeat(50));
    console.log('[Chat] Configuration loaded');
    console.log('[Chat] Socket.IO URL:', SOCKET_SERVER_URL);
    console.log('[Chat] Chat ID:', CHAT_ID);
    console.log('[Chat] User ID:', CURRENT_USER_ID);
    console.log('[Chat] Chat Status:', CHAT_STATUS);
    console.log('[Chat] JWT Token:', JWT_TOKEN ? 'Provided' : 'MISSING!');
    console.log('='.repeat(50));

    let socket = null;
    let isConnected = false;

    function initSocket() {
        console.log('[Chat] Initializing Socket.IO connection to:', SOCKET_SERVER_URL);
        console.log('[Chat] Chat ID:', CHAT_ID);
        console.log('[Chat] User ID:', CURRENT_USER_ID);
        
        if (!JWT_TOKEN) {
            console.error('[Chat] ❌ JWT Token is missing! Cannot connect to socket.');
            return;
        }

        if (!CHAT_ID || !CURRENT_USER_ID) {
            console.error('[Chat] ❌ Missing Chat ID or User ID');
            return;
        }
        
        socket = io(SOCKET_SERVER_URL, {
            auth: {
                token: JWT_TOKEN
            },
            reconnection: true,
            reconnectionDelay: 1000,
            reconnectionAttempts: 5,
            // polling FIRST: works through Hostinger reverse proxy;
            // Socket.IO will automatically upgrade to WebSocket once connected
            transports: ['polling', 'websocket']
        });

        socket.on('connect', () => {
            console.log('[Chat] ✓ Connected to chat server (Socket ID:', socket.id + ')');
            isConnected = true;

            // Join the chat room
            console.log('[Chat] Joining chat room for chat ID:', CHAT_ID);
            socket.emit('join_chat', {
                chat_id: CHAT_ID
            });
        });

        socket.on('joined_chat', (data) => {
            console.log('[Chat] ✓ Successfully joined chat room:', data);
        });

        socket.on('disconnect', () => {
            console.log('[Chat] ❌ Disconnected from chat server');
            isConnected = false;
        });

        socket.on('connect_error', (error) => {
            console.error('[Chat] ❌ Connection error:', error);
        });

        socket.on('new_message', (data) => {
            console.log('[Chat] ✓ New message received:', data);
            appendMessageToDOM(data);
        });

        socket.on('chat_locked', () => {
            console.log('[Chat] ℹ️ Chat has been locked');
            lockChatUI();
        });

        socket.on('error', (error) => {
            console.error('[Chat] ❌ Socket error:', error);
        });
    }

    function sendMessage(message) {
        if (!message) {
            return;
        }

        if (!isConnected) {
            console.warn('[Chat] ⚠️ Not connected to socket server yet. Try again in a moment...');
            alert('Chat connection in progress. Please wait a moment and try again.');
            return;
        }

        console.log('[Chat] Sending message via Socket.IO (length:', message.length + ')');
        
        socket.emit('send_message', {
            chat_id: CHAT_ID,
            message: message,
            php_api_url: '<?= rtrim(base_url(), "/") ?>'
        }, (response) => {
            console.log('[Chat] Send response:', response);
        });

        // Clear input immediately
        const messageInput = document.getElementById('messageInput');
        if (messageInput) {
            messageInput.value = '';
            messageInput.focus();
        }
    }

    function appendMessageToDOM(data) {
        const messagesContainer = document.getElementById('messagesArea');
        if (!messagesContainer) return;

        // Remove no-messages placeholder if exists
        const noMessages = messagesContainer.querySelector('.no-messages');
        if (noMessages) {
            noMessages.remove();
        }

        const isOwnMessage = data.sender_user_id === CURRENT_USER_ID;
        const messageClass = isOwnMessage ? 'outgoing' : 'incoming';
        
        const timestamp = new Date(data.timestamp);
        const timeStr = timestamp.toLocaleString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });

        const messageHTML = `
            <div class="message-wrapper ${messageClass}">
                ${!isOwnMessage ? `
                    <div class="message-options">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" cursor="pointer">
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                        </svg>
                    </div>
                ` : ''}
                
                <div class="message-content">
                    <div class="message-bubble ${messageClass}">
                        ${escapeHtml(data.message)}
                    </div>
                    <div class="message-timestamp">
                        ${timeStr}
                        ${!isOwnMessage && data.sender_name ? ' • ' + escapeHtml(data.sender_name) : ''}
                    </div>
                    ${isOwnMessage ? `
                        <div class="read-receipt">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                    ` : ''}
                </div>

                ${isOwnMessage ? `
                    <div class="message-options">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" cursor="pointer">
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                        </svg>
                    </div>
                ` : ''}
            </div>
        `;

        messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function lockChatUI() {
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        
        if (messageInput) messageInput.disabled = true;
        if (sendButton) sendButton.disabled = true;
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        const messagesArea = document.getElementById('messagesArea');
        if (messagesArea) {
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        const sendButton = document.getElementById('sendButton');
        const messageInput = document.getElementById('messageInput');

        if (sendButton) {
            sendButton.addEventListener('click', function() {
                const message = messageInput.value.trim();
                if (message) {
                    if (!isConnected) {
                        console.warn('[Chat] Waiting for connection...');
                        sendButton.style.opacity = '0.5';
                        sendButton.title = 'Connecting to chat...';
                        setTimeout(() => {
                            sendButton.style.opacity = '1';
                            sendButton.title = 'Send message (Enter)';
                        }, 1000);
                        return;
                    }
                    sendMessage(message);
                }
            });
        }

        if (messageInput) {
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    const message = this.value.trim();
                    if (message) {
                        if (!isConnected) {
                            console.warn('[Chat] Waiting for connection...');
                            return;
                        }
                        sendMessage(message);
                    }
                }
            });
        }

        // Initialize Socket.IO if chat is open
        if (CHAT_STATUS === 'open') {
            console.log('[Chat] Chat is open, initializing socket...');
            initSocket();
        } else {
            console.log('[Chat] ℹ️ Chat is locked, not initializing socket');
            lockChatUI();
        }
    });

    function goBack() {
        window.history.back();
    }

    // Debug function for testing (call from browser console)
    window.debugChat = {
        status: () => {
            console.log({
                socketConnected: isConnected,
                chatId: CHAT_ID,
                userId: CURRENT_USER_ID,
                socketServerUrl: SOCKET_SERVER_URL,
                jwtProvided: !!JWT_TOKEN
            });
        },
        testPhpApi: async () => {
            console.log('[Debug] Testing PHP API...');
            try {
                const response = await fetch('<?= base_url() ?>chat/health');
                const data = await response.json();
                console.log('[Debug] PHP API Response:', data);
            } catch (e) {
                console.error('[Debug] PHP API Error:', e);
            }
        },
        testSocketConnection: () => {
            if (socket && isConnected) {
                console.log('[Debug] Socket is connected. Testing message emit...');
                socket.emit('test_message', { test: 'data' }, (response) => {
                    console.log('[Debug] Test response:', response);
                });
            } else {
                console.warn('[Debug] Socket not connected. Attempting to initialize...');
                initSocket();
            }
        },
        forceSendMessage: (msg) => {
            console.log('[Debug] Force sending message:', msg);
            if (!isConnected) {
                console.warn('[Debug] Socket not connected!');
                return;
            }
            socket.emit('send_message', {
                chat_id: CHAT_ID,
                message: msg,
                php_api_url: '<?= rtrim(base_url(), "/") ?>'
            });
        }
    };

    console.log('[Chat] Debug functions available at window.debugChat');
</script>
