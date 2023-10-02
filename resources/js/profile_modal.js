$(document).ready(function () {
    $('.profile-modal').click(function (e) {
        e.preventDefault();
        const userId = $(this).data('user-id');
        const modalContent = $('#profileModal .modal-content');

        // Make an AJAX request to fetch the user's profile data
        $.ajax({
            url: '/user/profile/' + userId, // Adjust the URL to your profile route
            method: 'GET',
            success: function (data) {
                // Update the modal content with the retrieved user data
                modalContent.html(data);
                $('#profileModal').modal('show');
            }
        });
    });
});
