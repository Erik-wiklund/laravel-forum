<div class="modal fade" id="resourceCategoryModal" tabindex="-1" role="dialog" aria-labelledby="choseCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content here, including radio buttons for report reasons -->
            <form action="{{ route('resources.create') }}" id="resourceCategoryForm" method="GET">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="choseCategoryLabel">Choose category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="res_category" id="res_category">
                        <option value="software">Software</option>
                        <option value="art_images">Art & Images</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <button id="submitresourceCategoryButton" style="background-color: blue" type="submit"
                        class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
