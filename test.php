<?php

if (!function_exists('gethttp')){
function gethttp($string){
	preg_match('/http:\/\/[^"]+/', $string, $matches);
	return $matches[0];
}
}








if (!isset($url)) $url = "http://www.gooddrama.to/japanese-movie/0.5mm-movie";

$html = file_get_contents($url);

preg_match('/<img.*?src="(.*?)".*?series_image.*?>/', $html, $matches);

echo "<pre>";
echo htmlspecialchars(print_r($matches, 1));

$posterurl = gethttp($matches[1]);


preg_match('/<span id="full_notes">([^<]+)/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
if (!isset($matches[1])){
	preg_match('/<span>Description:<\/span>.*?<div>(.*?)<\/div>/ms', $html, $matches);
	echo htmlspecialchars(print_r($matches, 1));
}
$desc = $matches[1];
if (empty($desc)) exit;


preg_match('/<span>Category:<\/span>[^<]*<a[^>]+>(.*?)<\/a>/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
$category = $matches[1];


preg_match('/<span>Released:<\/span>[^\d]+(\d+)/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
$released = $matches[1];


# <span id="rating_num">8.43</span>
# (<span id="votes">7</span> Votes)


preg_match('/<span id="rating_num">(.*?)<\/span>/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
$rating = $matches[1];
if ($rating == "NA") $rating = 0.0;

preg_match('/<span id="votes">(\d+)/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
$votes = $matches[1];


preg_match('/<span>Genres:<\/span>.*?<a.*?>(.*?)<\/a>/ms', $html, $matches);
echo htmlspecialchars(print_r($matches, 1));
$genre = $matches[1];

$sql = "INSERT INTO movies VALUES(NULL, '$url', '$posterurl', '".addslashes($desc)."', '$category', $released, $rating, $votes, '$genre', '')";
$con->query($sql) or die(htmlspecialchars($sql)."<hr>".mysqli_error($con));


?>
