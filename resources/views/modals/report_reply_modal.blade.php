<div class="modal fade" id="reportReplyModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content here, including radio buttons for report reasons -->
            <form action="{{ route('reports.store') }}" id="reportReplyForm" method="POST">
                @csrf
                <input type="hidden" name="reply_id" id="replyIdInput" value="">
                <input type="hidden" name="thread_id" id="threadIdInput" value="{{ $thread->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report this post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select a reason for reporting:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reason" id="reason1"
                            value="Inappropriate content">
                        <label class="form-check-label" for="reason1">Inappropriate
                            content</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reason" id="reason2" value="Spam">
                        <label class="form-check-label" for="reason2">Spam</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reason" id="reason3" value="Other">
                        <label class="form-check-label" for="reason3">Other
                            reason</label>
                    </div>
                    <div class="form-group" id="otherReasonReplyInput" style="display: none;">
                        <label for="otherReason">Specify the reason:</label>
                        <input class="form-control" type="text" name="otherReason" id="otherReason">
                    </div>
                    <div id="reasonError" class="text-danger" style="display: none;">
                        Please
                        chose a reason.</div>
                </div>
                <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <button id="submitReportButton" type="submit" class="btn btn-primary">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/otherReason.js') }}"></script>
