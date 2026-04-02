const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');

const app = express();
app.use(cors());
const server = http.createServer(app);
const io = new Server(server, {
  cors: { origin: '*' }
});

app.get('/', (req, res) => {
  res.send('AZE Server Calisiyor!');
});

io.on('connection', (socket) => {
  console.log('Baglandi:', socket.id);

  socket.on('join', (username) => {
    socket.username = username;
    io.emit('userJoined', username);
  });

  socket.on('message', (data) => {
    io.emit('message', data);
  });

  socket.on('ptt_start', (data) => {
    socket.broadcast.emit('ptt_start', data);
  });

  socket.on('ptt_data', (data) => {
    socket.broadcast.emit('ptt_data', data);
  });

  socket.on('ptt_stop', (data) => {
    socket.broadcast.emit('ptt_stop', data);
  });

  socket.on('disconnect', () => {
    if (socket.username) {
      io.emit('userLeft', socket.username);
    }
  });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log('AZE Server port:', PORT);
});
