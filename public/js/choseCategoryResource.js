$(document).ready(function () {
    $('.resourceCategoryModalButton button').click(function (e) {
        e.preventDefault();
        console.log("clicked");
        $('#resourceCategoryModal').modal('show');
    });

    $(document).ready(function () {
        // Listen for the "Continue" button click inside the modal
        $('#submitresourceCategoryButton').click(function (e) {
            e.preventDefault();

            // Get the selected category value
            var selectedCategory = $('#res_category').val();

            // Set the value of the hidden input field in the form
            $('#selected_category').val(selectedCategory);

            // Submit the form
            $('#resourceCategoryForm').submit();
        });
    });
});
