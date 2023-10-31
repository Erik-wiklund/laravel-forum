$(document).ready(function() {
    $('.openmodModal').on('click', function(e) {
        e.preventDefault();

        // Get the thread status info from the hidden div
        var threadStatusInfo = $('#user-info').html();

        // Set the modal content to the thread status info
        $('#modModalBody').html(threadStatusInfo);

        // Show the modal
        $('#ModeratorActionsModal').modal('show');
    });
});


const quoteButtons = document.querySelectorAll('.quote-button');

        quoteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const quotedMessage = button.getAttribute('data-quote');
                const username = button.getAttribute('data-username');

                if (quotedMessage) {
                    // Use the captured 'quotedMessage' and 'username' here
                    const contentToInsert = `
    <div class="quoted-message" style="background-color: grey; padding: 10px;">
        User ${username} said:
    </div>
    <div class="quoted-message" style="background-color: lightgrey; padding: 10px;">
        ${quotedMessage}
    </div><br>
`;


                    // Assuming you have initialized TinyMCE and have a reference to the editor instance
                    const editor = tinymce.get('reply-textarea');
                    const editor2 = tinymce.get('reply-textarea2');


                    if (editor) {
                        editor.insertContent(contentToInsert);
                    }

                    if (editor2) {
                        editor.insertContent(contentToInsert);
                    }
                }
            });
        });

        

        function updateCheckboxValue(checkbox) {
            const value = checkbox.checked ? '1' : '0';
            const context = checkbox.checked ? 'lockThread' : 'unlockThread';
        
            // Send an AJAX request to update the checkbox value in the database
            axios.post(`/update-thread-checkbox/${threadId}`, {
                value,
                context
            })
            .then(response => {
                // Handle a successful response here, if needed
                // Reload the window after a successful response
                location.reload();
            })
            .catch(error => {
                // Handle errors if the request fails
                console.error('Error:', error);
            });
        }