<link rel="stylesheet" href="\css\custom.css">
<div class="custom-editor">
    <div class="editor-panel flex flex-row cursor-pointer text-2xl gap-1">
        <!-- Each panel item with a clickable icon -->
        <div class="panel-item" onclick="insertImage()" data-tooltip="Insert Image"> <!-- Example: Insert Image -->
            <i class="fa fa-image"></i> <!-- Example: Icon for Image -->
        </div>
        <div class="panel-item" onclick="makeTextBold()" data-tooltip="Make Text Bold"> <!-- Example: Make Text Bold -->
            <i class="fa fa-bold"></i> <!-- Example: Icon for Bold -->
        </div>
        <div class="panel-item" onclick="insertHorizontalRule()" data-tooltip="Insert Horizontal Rule">
            <!-- Example: Insert Horizontal Rule -->
            <i class="fa fa-minus"></i> <!-- Example: Icon for Horizontal Rule -->
        </div>
        <!-- Add more panel items with icons as needed -->
    </div>
    <textarea oninput="searchUsersAtReplies(this.value)" type="text" class="w-full messageContentInThread" name="content"
        id="reply-textarea" cols="30" rows="10"></textarea>
</div>
