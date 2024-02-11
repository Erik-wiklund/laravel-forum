<div class="modal fade" id="editThreadModal" tabindex="-1" role="dialog" aria-labelledby="editThreadLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content here, including radio buttons for report reasons -->
            <form action="{{ route('editThread.create', ['thread' => $thread->id]) }}" id="editThreadForm"
                method="POST">

                @csrf
                <input type="hidden" name="threadId" value="{{ $thread->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editThreadLabel">Edit Thread</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input value="{{ $thread->title }}" class="form-check-input" type="text" name="threadTitle"
                            id="threadTitle">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <button id="saveEditThreadButton" style="background-color: blue" type="submit"
                        class="btn btn-primary">Continue</button>
                </div>
            </form>

        </div>
    </div>
</div>
