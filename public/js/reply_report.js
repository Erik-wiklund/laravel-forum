$(document).ready(function () {
    // Listen for changes in the radio buttons
    $('input[type=radio][name=reason]').change(function () {
        if (this.value === 'Other') {
            // Show the hidden text input if "Other" is selected
            $('#otherReasonInput').show();
        } else {
            // Hide the text input for other options
            $('#otherReasonInput').hide();
        }
    });
});

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

            // Continue with form submission
            $('#reportForm').submit();
        }
    });
});