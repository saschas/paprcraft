<?php 
include_once('TwitterAPIExchange.php');

$twitter_customer_key           = "2rS9MU11kSzBmngXHZV8DjDFq";
$twitter_customer_secret        = "Tj5hMPsuXULG0QqusmWMvUK8iYNhqRDhD7sTLsPvkKSWG0D94N";
$twitter_access_token           = "703548055-NxdSudOJAonUcOiiSVHQz0GWUEuT18z50KdJyasO";
$twitter_access_token_secret    = "CBcjz4EGyv5PoQa0ZcwrT9Ar1DblgeYwnnz5qDntJdR0L";

$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);

$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => 'saaraan', 'count' => 1));

echo '<div class="twitter-bubble">';
if(isset($my_tweets->errors))
{           
    echo 'Error :'. $my_tweets->errors[0]->code. ' - '. $my_tweets->errors[0]->message;
}else{
    echo makeClickableLinks($my_tweets[0]->text);
}
echo '</div>';

//function to convert text url into links.
function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a target="blank" rel="nofollow" href="$1" target="_blank">$1</a>', $s);
}


?>