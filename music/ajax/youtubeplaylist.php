<?php
error_reporting(0);
# http://gdata.youtube.com/feeds/api/playlists/PLDcnymzs18LVXfO_x0Ei0R24qDbVtyy66/?v=2&alt=json&start-index=1
# https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLFgquLnL59akA2PflFpeQG9L01VFg90wS&key=AIzaSyDxQHQpabLYJlj04eVZFpRGZUlhLkXp8FE&maxResults=50
$list = $_GET['list'];
$start = $_GET['start'];
if (!isset($list)) {
	$list = "PLFgquLnL59akA2PflFpeQG9L01VFg90wS";
}
if (!isset($start)) {
	$start = 1;
}

switch ($list) {
	case 'latest':
	$list = "PLFgquLnL59akA2PflFpeQG9L01VFg90wS";
		break;
	case 'pop':
	$list = "PLDcnymzs18LVXfO_x0Ei0R24qDbVtyy66";
		break;
	case 'rock':
	$list = "PLhd1HyMTk3f5yqcPXjLo8qroWJiMMFBSk";
		break;
	case 'country':
	$list = "PLvLX2y1VZ-tEmqtENBW39gdozqFCN_WZc";
		break;
	default:
	$list = "PLFgquLnL59akA2PflFpeQG9L01VFg90wS";
		break;
}

$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$list.'&key=AIzaSyDxQHQpabLYJlj04eVZFpRGZUlhLkXp8FE&maxResults=50';
$cont = json_decode(file_get_contents($url));
$feed = $cont->items;
if(count($feed)):
	foreach($feed as $item):
		$title = $item->snippet->title;
		$title = explode("[",$title)[0];
		$title = explode("(",$title)[0];
		$results[] = array(
			'title' => $title,
			'img' => $item->snippet->thumbnails->medium->url,
			'desc' => $item->snippet->description
			);
	endforeach;
endif;

for($i = 0; $i < count ( $results ); $i ++) {
	if ($i % 4 == 0) {
		echo '<div class="row">';
	}
	echo '<div class="col-sm-6 col-md-3">
					<a href="search.php?q=' . $results [$i] ['title'] . '">
						<div class="thumbnail">
							<div style="height: 150px; overflow: hidden;" class="center-image" >
								<img style="width: 100%;" src="' . $results [$i] ['img'] . '" alt="' . $results [$i] ['title'] . '">
							</div>
							<div class="caption">
								<h2 class="center ellipsis" title="' . $results [$i] ['title'] . '">' . $results [$i] ['title'] . '</h2>
							</div>
						</div>
					</a>
				</div>';
	if ($i % 4 == 3) {
		echo '</div>';
	}
}
?>
