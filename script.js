const socket = io();

function joinChat() {
  const name = document.getElementById('name').value;
  if (name) {
    document.getElementById('name-input').style.display = 'none';
    document.getElementById('chat-window').style.display = 'block';
    socket.emit('newUser', name);
  }
}

function sendMessage() {
  const message = document.getElementById('message-input').value;
  if (message) {
    socket.emit('chatMessage', message);
    appendMessage('You', message);
    document.getElementById('message-input').value = '';
  }
}

function appendMessage(sender, message) {
  const chatMessages = document.getElementById('chat-messages');
  const messageElement = document.createElement('div');
  messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
  chatMessages.appendChild(messageElement);
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

socket.on('chatMessage', ({ sender, message }) => {
  appendMessage(sender, message);
});
