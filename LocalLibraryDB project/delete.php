<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 삭제</title>
<style>
table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			padding: 10px;
			border-bottom: 1px solid #483D8B;
		}
		tr:hover { background-color: #483D8B; }
</style>
</head>
<body>
<h3 style="font-weight: bold; font-size: 1.5em; color: navy;">
<a href="#" onclick="location.href=('main.php')">
<img src="css/images/banner.png" alt="동네 서점 DB Local bookstore searchsite" ></a>도서 삭제</h3>
<p style="text-align:right;" class="x_icon">
<a href="#" onclick="window.open('about:blank', '_self').close();">
<img src="https://tkis.kunsan.ac.kr/css/images/x_icon.png" alt="닫기"></a>
</p>
<?php
$book_id = $_GET['book_id'];
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT name, author, publisher, isbn, price, date, isUsed, image FROM User, book where isbn = '{$book_id}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
$book = mysqli_fetch_assoc($sqlResult);
?>

<table>
<p style="font-family"> 삭제하려는 도서 정보입니다. </p>

		<tr>
			<th>도서명</th>
			<th>저자</th>		
			<th>출판사</th>
			<th>ISBN</th>
			<th>가격</th>		
			<th>출판연도</th>
			<th>상품 상태</th>
			<th>썸네일</th>		
		</tr>

		<tr>
		<td> <?php echo "{$book['name']}</p>"; ?> </td>
		<td> <?php echo "<p> {$book['author']}</p>";?> </td>
		<td> <?php echo "<p>{$book['publisher']}</p>";?> </td>
		<td> <?php echo  "<p>{$book['isbn']}</p>"; ?></td>
		<td> <?php echo  "<p>{$book['price']}</p>";?> </td>
		<td> <?php echo  "<p>{$book['date']}</p>";?> </td>
		<td> <?php echo  "<p>{$book['isUsed']}</p>";?> </td>
		<td> <?php echo  "<p>{$book['image']}</p>";?> </td>
		</tr>
</table>

<p style="font-family"> 정말로 삭제하시겠습니까? </p>

<form name="deleteBookButton" enctype="multipart/form-data" action="/delete_result.php" method="post" id = "deleteBookButton">
    <input type='hidden' name='isbn' value="<?php echo $book['isbn'] ?>" id = "receiveISBN"/>
    <input type='hidden' name='image' value="<?php echo $book['image'] ?>" id ="receiveImage" />
    <input type='submit' value='도서 삭제' id = "submitDelete"/>
</form>
<form name="mainPageButton" enctype="multipart/form-data" action="/management.php" method="post" id ="mainPageButton">
    <input type='submit' value='관리화면으로' id = "submitMainPage"/>
</form>
</body>
</html>