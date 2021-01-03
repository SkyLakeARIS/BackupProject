<?php
include "session.php";

//해당 세션 지움.
unset($_SESSION['sessionID']);

if($_SESSION['sessionID'] == null)
{
	header( 'Location: main.php' );
	exit;
}
?>