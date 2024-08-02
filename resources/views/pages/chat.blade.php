<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head içeriği -->
    <style>
        #user_list {
            height: 300px; /* Ayarlanabilir yükseklik */
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        #chat_area {
            border: 1px solid #ccc;
            padding: 10px;
        }
        #messages {
            height: 200px; /* Ayarlanabilir yükseklik */
            overflow-y: scroll;
            margin-bottom: 10px;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/socket.io-client/dist/socket.io.slim.js"></script>
<script src="{{ mix('js/app.js') }}"></script>

<body>
    <div id="app">
        <h1>Chat Room</h1>

        <div id="user_list">
            <h2>Users</h2>
            <ul>
                @foreach($users as $user)
                    <li onclick="selectUser({{ $user->id }}, '{{ $user->name }}')">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>

        <div id="chat_area" style="display: none;">
            <h3 id="selected_user_name"></h3>
            <div id="messages">
                <!-- Mesajlar burada listelenecek -->
            </div>
            <input type="text" id="message_input" placeholder="Type your message here...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        var selectedUserId;

        function selectUser(userId, userName) {
    selectedUserId = userId;
    document.getElementById('selected_user_name').innerText = userName;
    document.getElementById('chat_area').style.display = 'block';

    Echo.private(`messages.${selectedUserId}`)
        .listen('MessageSent', (e) => {
            const messageElement = document.createElement('div');
            messageElement.innerText = e.message.content; // Mesaj içeriği
            document.getElementById('messages').appendChild(messageElement);
        });
}


        function sendMessage() {
            const message = document.getElementById('message_input').value;
            axios.post('/messages', { to_user_id: selectedUserId, message: message });
            // Mesaj gönderme işlemi
        }

        // Diğer JavaScript kodları
    </script>
</body>
</html>
