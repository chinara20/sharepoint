const userId = ...; // Şu anki kullanıcının ID'si

Echo.private(`messages.${userId}`)
    .listen('MessageSent', (e) => {
        console.log(e.message);
        // Burada gelen mesajı arayüzde gösterin
    });

function sendMessage(toUserId, message) {
    axios.post('/messages', { to_user_id: toUserId, message: message });
    // Diğer alanlar...
}
