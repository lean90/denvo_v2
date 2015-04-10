

function Common(){
    this.getParameterByName = function(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };
    this.getYoutubeVideoId = function (text) {
        if(text == null || text == undefined || text == ''){
            return '';
        }
        /* Commented regex (in PHP syntax)
        $text = preg_replace('%
            # Match any youtube URL in the wild.
            (?:https?://)?   # Optional scheme. Either http or https
            (?:www\.)?       # Optional www subdomain
            (?:              # Group host alternatives
              youtu\.be/     # Either youtu.be,
            | youtube\.com   # or youtube.com
              (?:            # Group path alternatives
                /embed/      # Either /embed/
              | /v/          # or /v/
              | /watch\?v=   # or /watch\?v=
              )              # End path alternatives.
            )                # End host alternatives.
            ([\w\-]{10,12})  # $1: Allow 10-12 for 11 char youtube id.
            \b               # Anchor end to word boundary.
            [?=&\w]*         # Consume any URL (query) remainder.
            (?!              # But don\'t match URLs already linked.
              [\'"][^<>]*>   # Not inside a start tag,
            | </a>           # or <a> element text contents.
            )                # End negative lookahead assertion.
            %ix', 
            '<a href="http://www.youtube.com/watch?v=$1">YouTube link: $1</a>',
            $text);
        */
        // Here is the same regex in JavaScript literal regexp syntax:
        return text.replace(
            /(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=))([\w\-]{10,12})\b[?=&\w]*(?!['"][^<>]*>|<\/a>)/ig,
            '$1');
    };
}