<?php

// In a helpers.php file or a custom helper file
function parseBBCodeToHTML($message)
{
    // Parse BBCode tags and convert to HTML
    return preg_replace('/\[QUOTE=(.*?)\](.*?)\[\/QUOTE\]/is', '<div class="quoted-message">$1 said: $2</div>', $message);
}