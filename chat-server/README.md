# EquipManager Chat Server

Node.js Socket.io server for real-time order-based chat.

## Environment Variables

Create a `.env` file in the `chat-server` directory:

```env
PORT=3000
PHP_API_URL=http://localhost/equipmanager
JWT_SECRET=your-secret-key-change-in-production-2026
CORS_ORIGIN=http://localhost
LOG_LEVEL=info
```

**IMPORTANT**: The `JWT_SECRET` must match the secret in your PHP `Jwt_service.php` library.

## Installation

```bash
cd chat-server
npm install
```

## Running the Server

### Development

```bash
npm run dev
```

### Production

```bash
npm start
```

## Endpoints

### WebSocket

- **URL**: `ws://localhost:3000/socket.io`
- **Authentication**: JWT token in `auth.token`

### REST API

- **POST /api/chat-locked**: Notify that a chat has been locked
- **GET /health**: Health check endpoint

## Architecture

- **server.js**: Main entry point, Express + Socket.io setup
- **auth.js**: JWT authentication middleware
- **socket.js**: Socket.io event handlers
- **phpApi.js**: PHP API client
- **config.js**: Configuration management

## Production Deployment

1. Update environment variables for production
2. Use a process manager like PM2:
   ```bash
   npm install -g pm2
   pm2 start src/server.js --name equipmanager-chat
   pm2 save
   pm2 startup
   ```
3. Configure reverse proxy (nginx/Apache) if needed
4. Ensure firewall allows WebSocket connections
