$(document).ready(function () {
    $('.resourceCategoryModalButton button').click(function (e) {
        e.preventDefault();
        console.log("clicked");
        $('#resourceCategoryModal').modal('show');
    });

    // Listen for the "Submit Report" button click inside the modal
    // $('#submitThreadReportButton').click(function (e) {
    //     // Hide the error message
    //     $('#reasonError').hide();

    //     // Check if any reason is selected
    //     const selectedReason = $('input[type=radio][name=reason]:checked').val();
    //     if (!selectedReason) {
    //         // Show the error message and prevent form submission
    //         $('#reasonError').show();
    //         e.preventDefault();
    //     } else {
    //         // Set the values in the hidden input fields
    //         $('#threadIdInput').val(threadId);

    //         // Continue with form submission
    //         $('#threadReportForm').submit();
    //     }
    // });
});
