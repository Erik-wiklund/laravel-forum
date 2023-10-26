// $(document).ready(function() {
//     $('.openProfileModal').on('click', function(e) {
//         e.preventDefault();

//         // Get the user ID from the data attribute
//         var userId = $(this).data('user-id');

//         // Create the URL using the named route
//         var url = "{{ route('profile.show_modal', ['user' => ':userId']) }}";
//         url = url.replace(':userId', userId);

//         // Make an AJAX request to load the profile content
//         $.ajax({
//             url: url,
//             method: 'GET',
//             success: function(data) {
//                 // Populate the modal body with the loaded content
//                 $('#profileModalBody').html(data);

//                 // Show the modal manually
//                 $('#profileModal').modal('show');
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });
