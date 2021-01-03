<?php
include "session.php";
?>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 도서 목록</title>
</head>
<body>
<!-- 서점 관리자 : 전체 도서 목록 페이지 -->
<h3>동네 서점 DB 내 도서 목록</h3>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//페이지당 표기 수 :10개
$begin = ($page - 1) * 10;
$end = $begin + 10;
$currentID = $_SESSION['sessionID'];
//쿼리
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT count(*) FROM User, book where name LIKE'%{$keyword}%' and User.ID=Book.seller;";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

$resultCount = mysqli_fetch_assoc($sqlResult);

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT name, author, publisher, isbn, price, date, isUsed, image FROM User, book where ID = '{$currentID}' and User.ID=Book.seller LIMIT {$begin},{$end};";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

if($resultCount['count(*)'] > 0)
{
	while($book = mysqli_fetch_assoc($sqlResult))
	{
?>
		<div align = "center">
		<fieldset style = "width:500px">
		<p align = "center"></p> <?php echo "도서명: {$book['name']}"; ?>
		<p align = "center"></p> <?php echo "저자: {$book['author']}</p>"; ?>
		<p align = "center"></p> <?php echo "출판사: {$book['publisher']}</p>"; ?>
		<p align = "center"></p> <?php echo "ISBN: {$book['isbn']}</p>"; ?>
		<p align = "center"></p> <?php echo "가격: {$book['price']}</p>"; ?>
		<p align = "center"></p> <?php echo "출판연도: {$book['date']}</p>"; ?>
		<p align = "center"></p> <?php echo "상품 상태: {$book['isUsed']}</p>"; ?>
		<p align = "center">등록한 도서 이미지입니다. </p>
		<p align = "center"></p> <?php echo "<img src ='./image/{$book['image']}'><p>"; ?>
		<p></p><p></p>
		</fieldset>
		</div>
<?php
	}
}
else
{
	
	echo "<p>등록된 도서가 없습니다..</p>"; 
}
?>

<!-- 수정할 도서 정보 입력 -->
<ul>
<li><a href="/viewMyBook.php?page=1">1</a></li>
<li><a href="/viewMyBook.php?page=2">2</a></li>
<li><a href="/viewMyBook.php?page=3">3</a></li>
<li><a href="/viewMyBook.php?page=4">4</a></li>
<li><a href="/viewMyBook.php?page=5">5</a></li>
</ul>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
<input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
<input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</body>
</html>