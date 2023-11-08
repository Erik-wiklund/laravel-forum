$(document).ready(function () {
    // Initialize replyId and threadId variables
    var replyId = null;
    var threadId = null;

    // Listen for the "Report" button click
    $('.reportReplyMessageButton button').click(function (e) {
        e.preventDefault();
        // Get the values of data-report and data-thread attributes
        replyId = $(this).data('report');
        threadId = $(this).data('thread');
        console.log(replyId);
        console.log(threadId);
        // Now, replyId and threadId are captured here.

        // Open the report modal
        $('#reportModal').modal('show');
    });

    // Listen for the "Submit Report" button click inside the modal
    $('#submitReportButton').click(function (e) {
        // Hide the error message
        $('#reasonError').hide();

        // Check if any reason is selected
        const selectedReason = $('input[type=radio][name=reason]:checked').val();
        if (!selectedReason) {
            // Show the error message and prevent form submission
            $('#reasonError').show();
            e.preventDefault();
        } else {
            // Set the values in the hidden input fields
            $('#replyIdInput').val(replyId);
            $('#threadIdInput').val(threadId);
            console.log(replyId);
        console.log(threadId);
            // Continue with form submission
            $('#reportReplyForm').submit();
        }
    });
});