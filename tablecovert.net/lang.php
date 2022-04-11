<?php
session_start();
$dil	=strip_tags($_GET["lang"]);
if ($dil =="TR" || $dil == "NL"){
	$_SESSION["lang"] = $dil;

	header("location: ".$_SERVER['HTTP_REFERER']."");
}else {
 header("Location:homepage");
}

?>