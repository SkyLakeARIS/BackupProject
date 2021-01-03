<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 정보 수정</title>
</head>
<body>
<h3>동네 서점 DB - 도서 정보 수정</h3>
<?php
$book_id = $_GET['book_id'];
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT name, author, publisher, isbn, price, date, isUsed, image FROM User, book where isbn = '{$book_id}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

$book = mysqli_fetch_assoc($sqlResult);
echo "<p>도서명: {$book['name']}</p>";
echo "<p>저자: {$book['author']}</p>";
echo "<p>출판사: {$book['publisher']}</p>";
echo "<p>ISBN: {$book['isbn']}</p>";
echo "<p>가격: {$book['price']}</p>";
echo "<p>출판연도: {$book['date']}</p>";
echo "<p>상품 상태: {$book['isUsed']}</p>";
echo "<p>섬네일: {$book['image']}";
?>

<div align="center">
<fieldset style = "width:300px; height:500px">
<legend>도서 정보</legend>
<form name="BookInformationBar" enctype="multipart/form-data" action="/modify_result.php" method="post" id="BookInformationBar">
    도서명<input type='text' name='bookName' autofocus value="<?php echo $book['name'] ?>"  id = "bookName"/>
    저자<input type='text' name='author' value="<?php echo $book['author'] ?>" id = "bookAuthor"/>
    출판사<input type='text' name='publisher' value="<?php echo $book['publisher'] ?>" id = "bookPublisher"/>
    <input type='hidden' name='ISBN' value="<?php echo $book['isbn'] ?>" id = "bookISBN"/>
    가격<input type='text' name='price' value="<?php echo $book['price'] ?>" id = "bookPrice"/>
    출간연도&lt;yyyy-mm-dd&gt;<input type='text' name='date' value="<?php echo $book['date'] ?>" id = "bookDate"/>
    <p>중고여부</p>
    새상품<input type='radio' name='isUsed' value='새상품' checked id = "newBook"/>
    중고<input type='radio' name='isUsed' value='중고' id = "usedBook"/>
    <p>주의사항: 이미지 파일 등록시 기존 이미지에서 해당 이미지로 교체됩니다.</p>
    섬네일 등록&lt;크기 2메가 이하, jpg,png,jpeg&gt;<input type="file" name="uploadFile" size=100 id = "bookImage">
<input type='submit' value='도서 수정' id = "submitModify"/>
</form>
</fieldset>

<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>

<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
    <input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</body>
</html>