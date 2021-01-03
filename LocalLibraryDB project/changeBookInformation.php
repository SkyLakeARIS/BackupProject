<?php
include "session.php";
?>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 정보 수정</title>
</head>
<body>
<h3>동네 서점 DB - 도서 정보 수정</h3>

<?php
//페이지당 표기 수 :10개
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$begin = ($page - 1) * 10;
$end = $begin + 10;

//쿼리
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT count(*) FROM User, book where name LIKE'%{$keyword}%' and User.ID=Book.seller;";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

$resultCount = mysqli_fetch_assoc($sqlResult);

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
//                                                                                                                                          시작 범위 (~부터) 끝 범위 (~까지)
$sqlQuery = "SELECT seller, name, author, publisher, isbn, price, date, isUsed, image FROM User, book where ID = '{$_SESSION['sessionID']}' and User.ID=Book.seller LIMIT {$begin},{$end};";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

if($resultCount['count(*)'] > 0)
{
    while($book = mysqli_fetch_assoc($sqlResult))
    {
        echo "<p>도서명: {$book['name']}</p>";
        echo "<p>저자: {$book['author']}</p>";
        echo "<p>출판사: {$book['publisher']}</p>";
        echo "<p>ISBN: {$book['isbn']}</p>";
        echo "<p>가격: {$book['price']}</p>";
        echo "<p>출판연도: {$book['date']}</p>";
        echo "<p>상품 상태: {$book['isUsed']}</p>";
        echo "<p>섬네일: {$book['image']}";
        ?> <p>등록한 도서 이미지입니다. </p>	<?php
        echo "<img src ='./image/{$book['image']}'>";
        echo "<a href='modify.php?book_id={$book['isbn']}'> 수정하기 </a>";
        echo "<a href='delete.php?book_id={$book['isbn']}'> 삭제하기 </a>";
    }
}
else
{
    echo "<p>등록된 도서가 없습니다....</p>";
} 

?>

<!-- 수정할 도서 정보 입력 -->
<ul>
<li><a href="/changeBookInformation.php?page=1">1</a></li>
<li><a href="/changeBookInformation.php?page=2">2</a></li>
<li><a href="/changeBookInformation.php?page=3">3</a></li>
<li><a href="/changeBookInformation.php?page=4">4</a></li>
<li><a href="/changeBookInformation.php?page=5">5</a></li>
</ul>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
    <input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</body>
</html>
