$(document).ready(function () {
    // Initialize replyId and threadId variables
    var replypmId = null;
    var conversationId = null;

    // Listen for the "Report" button click
    $('.reportpmReplyButton button').click(function (e) {
        e.preventDefault();
        // Get the values of data-report and data-thread attributes
        replypmId = $(this).data('replypm');
        conversationId = $(this).data('conversation');
        console.log(replypmId);
        console.log(conversationId);
        // Now, replyId and threadId are captured here.

        // Open the report modal
        $('#reportReplypmForm').modal('show');
    });

    // Listen for the "Submit Report" button click inside the modal
    $('#submitReportpmButton').click(function (e) {
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
            $('#replypmIdInput').val(replypmId);
            $('#conversationIdInput').val(conversationId);
            console.log(replypmId);
        console.log(conversationId);
            // Continue with form submission
            $('#reportReplypmForm').submit();
        }
    });
});