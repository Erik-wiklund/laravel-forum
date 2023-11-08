function scrollToReply(replyId) {
    const replyElement = document.getElementById(`reply_${replyId}`);
    if (replyElement) {
        replyElement.scrollIntoView({ block: "center" });
    }
}

window.addEventListener('load', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const scrollToReplyId = urlParams.get('scrollToReply');
    if (scrollToReplyId) {
        scrollToReply(scrollToReplyId);
    }
});