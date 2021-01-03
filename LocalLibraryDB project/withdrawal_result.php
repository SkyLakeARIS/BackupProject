<?php
include 'session.php'; 

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "select * from User, Book where ID = '{$_SESSION['sessionID']}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

//이미지 파일 제거
while($image = mysqli_fetch_assoc($sqlResult))
{
    //기본이미지는 제거X
    if($image['image'] != "noimage.png")
    {
        unlink("./image/{$image}");
    }
}
//외래키 테이블의 데이터 먼저 삭제
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "delete from Book where seller = '{$_SESSION['sessionID']}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
//참조 테이블의 데이터 삭제
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "delete from User where ID = '{$_SESSION['sessionID']}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

//로그아웃
unset($_SESSION['sessionID']);

if($_SESSION['sessionID'] == null)
{
    header( 'Location: main.php' );
    exit;
}
?>