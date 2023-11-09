$(document).ready(function () {
    // Listen for changes in the radio buttons within the "Report Reply" modal
    $('#reportConversationModal input[type=radio][name=reason]').change(function () {
        if (this.value === 'Other') {
            // Show the hidden text input if "Other" is selected
            $('#otherReasonConversationInput').show();
        } else {
            // Hide the text input for other options
            $('#otherReasonConversationInput').hide();
        }
    });
});
