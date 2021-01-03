<?php
include "session.php";

$ID = $_POST[ 'userID' ];
$PW = $_POST[ 'userPW' ];

//값을 입력했는지 체크    아마 메세지 창으로 가능하면 교체됨.
if (is_null( $ID ))
{
	header( 'Location: main.php' );
	exit;
}
if (is_null( $PW ))
{
	header( 'Location: main.php' );
	exit;
}

//sql 작업.
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT * FROM User WHERE ID = '{$ID}' AND PW = '{$PW}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

//입력값이 정확한지 체크  NULL == DB와 일치하는 값이 없음.
if(mysqli_fetch_array( $sqlResult ) == NULL)
{
	header( 'Location: main.php' );
	exit;
}

//세션 추가
$_SESSION[ 'sessionID' ] = $ID;
header( 'Location: main.php' );
?>
