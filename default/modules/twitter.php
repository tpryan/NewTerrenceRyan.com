<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php'; //sets twitter_settings
include_once 'module_common.php';
require_once('TwitterAPIExchange.php');
require_once('util.php');

$service_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$service_params = '?screen_name=tpryan&count=1&trim_user=true&exclude_replies=true&include_rts=true';
$cache_dir = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/";
$service_cache = $cache_dir . "twitter.html";
$cache_age = 2 * 60 * 60;



if (isset($_GET['reset_cache']) && file_exists($service_cache)){
    unlink($service_cache);
}

if (shouldStillBeCached($service_cache, $cache_age)){
    $service_html = file_get_contents($service_cache);
}
else{
    try {
        $service_html = refreshTwitterHTML($service_url, $service_params, $service_cache, $twitter_settings);
    } catch (Exception $e) {
        $service_html = "<article><p>No current projects</p></article>";
        var_dump($e);
    }
}

echo $service_html;



function refreshTwitterHTML($service_url, $service_params, $service_cache, $twitter_settings){
    $service_content = get_service_content($service_url, $service_params, $twitter_settings);
    $service_html = generateTwitterHTML($service_content);
    $cache_html = "<!-- From Cache -->" . $service_html;
    file_put_contents($service_cache, $cache_html);
    return $service_html;
}

function get_service_content($service_url, $service_params, $twitter_settings){
    $twitter = new TwitterAPIExchange($twitter_settings);
    $results = $twitter->setGetfield($service_params)
             ->buildOauth($service_url, "GET")
             ->performRequest();

    return json_decode($results, true);
}

function generateTwitterHTML($service_json){

    $util = new util();
    date_default_timezone_set('America/New_York');
    $datetime = new DateTime($service_json[0]['created_at']);
    $datetime->setTimezone(new DateTimeZone('America/New_York'));
    $tweet_url = "https://twitter.com/tpryan/status/" . $service_json[0]['id'];
    
    $result = "";
    $result .=  "<!-- pulled in from Twitter -->" ."\n";


    $item = "";
    $item .= '          <p class="content"><strong>';
    $item .= '<a href="' . $tweet_url . '">';

    $item .= $util->human_time_diff($datetime->format('U'));
    $item .= '</a></strong>: ';
    $item .= '<a href="' . $tweet_url . '">';
    $item .= $service_json[0]['text'];
    $item .= '</a></p>' . "\n";

    $result .= $item;
    
    return $result;

}




?>