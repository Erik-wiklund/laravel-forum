<?php

// In a helpers.php file or a custom helper file
function parseBBCodeToHTML($message)
{
    // Parse BBCode tags and convert to HTML
    return preg_replace('/\[QUOTE=(.*?)\](.*?)\[\/QUOTE\]/is', '<div class="quoted-message">$1 said: $2</div>', $message);
}

if (!function_exists('processMessageContent')) {
    function processMessageContent($content, $user)
    {
        // Regular expression to find mentioned users
        $pattern = '/@(\w+)/';

        // Replace mentioned usernames with clickable links
        $content = preg_replace_callback($pattern, function ($matches) use ($user) {
            $username = $matches[1];
            $userModel = \App\Models\User::where('username', $username)->first();
            if ($userModel) {
                return '<a style="color:gray;" data-user-id="' . $userModel->id . '" href="#" class="openProfileModal">@' . $username . '</a>';
            }
            return $matches[0]; // Return the original username if user not found
        }, $content);

        return $content;
    }
}
