<?php



set_time_limit(0);

include("../con-gdgrab.php");




$url = "http://www.gooddrama.to/drama-movies";

$html = file_get_contents($url);


#http://www.gooddrama.to/japanese-movie/a-chorus-of-angels-movie
preg_match_all('/http:\/\/www.gooddrama.to\/[^-]+-movie\/[^"]+/i', $html, $matches);

foreach($matches[0] as $url){
	include("./test.php");
}

echo "<pre>";

print_r($matches);

echo "</pre>";





































?>
