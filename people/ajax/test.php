<?php
error_reporting ( 0 );
include '../../TMDb.php';

$tmdb = new TMDb ( 'c2c73ebd1e25cbc29cf61158c04ad78a' );
// $config = $tmdb->getConfig ();
$Movie = $tmdb->searchPerson ('cristan');
echo json_encode($Movie);
?>
