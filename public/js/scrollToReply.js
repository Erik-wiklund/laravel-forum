function scrollToReply(replyId) {
    const replyElement = document.getElementById(`reply_${replyId}`);
    if (replyElement) {
        replyElement.scrollIntoView({
            behavior: 'smooth'
        });
    }
}