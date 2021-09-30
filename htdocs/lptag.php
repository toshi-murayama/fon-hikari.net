<?php
	$p = $_GET["p"]; $cid = $_GET["cid"]; $plid = $_GET["plid"];
	if(!ctype_alnum($p)) exit;
	if(ctype_alnum($cid)){ setcookie("CL_".$p, $cid, time() + 63072000, "/"); setcookie("ACT_".$p, "php", time() + 63072000, "/"); }
	if($plid){ setcookie("PL_".$p, $plid, time() + 63072000, "/"); setcookie("APT_".$p, "php", time() + 63072000, "/"); }