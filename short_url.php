<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//snamespace Googl;
require_once('google-url/Googl.class.php');
//$ch;
$nurl=$_POST['nurl'];


$apikey=''; // privide api key here

// print_r(json_decode($result));
$googl = new Googl($apikey);
echo $googl->shorten($nurl);

exit;
?>