    function scrollToBottom() {
        var chatbox = document.getElementById('chat-messages');
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    // Call scrollToBottom() when the page loads to initially scroll to the bottom
    window.onload = function () {
        scrollToBottom();
    };

    // Call scrollToBottom() whenever new messages are added
    function addNewMessage() {
        scrollToBottom();
    }
