<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 삭제</title>
</head>
<body>
<?php
$ISBN = $_POST['isbn'];
$image = $_POST['image'];
$deleteOk = 1;  //삭제 상태 확인

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "delete from Book where isbn = '{$ISBN}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

if($sqlResult != NULL)
{		
    unlink("./image/{$image}");
    echo '<p>삭제 성공</p>';
}
else
{
    $deleteOk = 0;
    echo "error: " . mysqli_error($sqlConn);
} 

if($deleteOk == 1)
{
    echo "<p>해당 도서를 삭제했습니다.</p>";
}
else
{
    echo "<p>해당 도서를 삭제하는데 실패했습니다.</p>";
}
?>

<form name="mainPageButton" action="/main.php" method="post" id = "mainPageButton">
<input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<form name="previousPageButton" action="/registerBook.php" method="post" id = "previousPageButton">
<input type='submit' value='이전 화면으로' id = "submitpreviousPage"/>
</form>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
<input type='submit' value='관리 화면으로' id = "submitManagementPage"/>
</form>
</body>
</html>