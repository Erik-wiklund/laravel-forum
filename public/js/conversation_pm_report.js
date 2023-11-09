$(document).ready(function () {
    // Initialize replyId and threadId variables
    var conversationId = null;

    // Listen for the "Report" button click
    $('.reportPrivateMessageButton button').click(function (e) {
        e.preventDefault();
        // Get the values of data-report and data-thread attributes
        conversationId = $(this).data('conversation');
        // Now, replyId and threadId are captured here.

        // Open the report modal
        $('#reportConversationModal').modal('show');
    });

    // Listen for the "Submit Report" button click inside the modal
    $('#submitconversationReportButton').click(function (e) {
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
            $('#conversationIdInput').val(conversationId);

            // Continue with form submission
            $('#conversationReportForm').submit();
        }
    });
});
