<html>
<head>
<meta charset="utf-8"/>
<title>동네 서점 DB - 도서 검색:<?php echo "{$_POST['searchKeyword']}" ?>에 대한 결과 페이지</title>
<style>
     legend {background-color: gainsboro;
                 border-color: gainsboro;
                font-size: 1.7em;
         width: auto;
         font-weight: bold;
        }
        fieldset {
            border: 2px solid gray;
                    padding: 3000x 1000x;
            margin:auto;
            width: 1000px;
            height: auto;
            text-align: center;
                text-size: 1.3em;
        }
        
        div {
            float: left;
            
        }
      body {
            float: center;
            margin: auto;
            padding: 50px;
        }
input[type="search"] {
		width : 40%;
		padding: 10px 40px;
			margin: 5px 0;
			box-sizing: border-box;
			border: solid 2px #483D8B;
			border-radius: 5px;
			font-size: 16px;
			background-image: url("css/images/serach2.png");
			background-position: 5px 4px;
			background-repeat: no-repeat;
		}

input[type="submit"] {
			width: 65px;
			padding: 10px 3px;
			margin: 3px 0;
			box-sizing: border-box;
		}
</style>
</head>
<body>
      
           <p style="text-align:right;" class="x_icon">
<a href="#" onclick="window.open('about:blank', '_self').close();">
<img src="https://tkis.kunsan.ac.kr/css/images/x_icon.png" alt="닫기"></a>
</p>
 <h3 style="text-align:center;" class= "main">
<a href="#" onclick="location.href=('main.php')">
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ><a style="font-weight: bold; font-size: 2em"> 도서 검색</a></a>
</h3>
<!--검색-->
<h2 style="text-align:center;">
<form name="searchBar" action="/search.php" method="post" id ="searchBar">
	<input type='search' name='searchKeyword' placeholder='검색어를 입력하세요.' autofocus id = "searchKeyWord"/>
	<input type='submit' value='검색' id= "submitSearch"/>
</form>
</h2>

<?php
$keyword = $_POST['searchKeyword'];
//쿼리
$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT count(*) FROM User, book where name LIKE'%{$keyword}%' and User.ID=Book.seller;";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

$resultCount = mysqli_fetch_assoc($sqlResult);

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT * FROM User, book where name LIKE'%{$keyword}%' and User.ID=Book.seller;";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
    

if($resultCount['count(*)'] > 0)
{
    ?>
<form>
<fieldset>
    <legend>검색 결과</legend>
    <?php 
    while($searchResult = mysqli_fetch_assoc($sqlResult))
    {
    ?>
        <p style= "font-size: 1em; color: navy font-family: 바탕"></p> <?php echo "<img src ='./image/{$searchResult['image']}'>"; ?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "도서명: {$searchResult['name']}";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "저자: {$searchResult['author']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "출판사: {$searchResult['publisher']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "출판연도: {$searchResult['date']}</p>"; ?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "ISBN: {$searchResult['isbn']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "가격: {$searchResult['price']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "상태: {$searchResult['isUsed']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "취급점: {$searchResult['LibraryName']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "주소: {$searchResult['Address']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "전화번호: {$searchResult['PhoneNumber']}</p>";?>
        <p style= "font-size: 1em; color: navy"></p> <?php echo "<p></p><p></p>";?>
    <?php
    }
    ?>
</fieldset>
</form>
</fieldset>
</form>

<?php } else {  ?>

<form>
<fieldset>
    <legend>검색 결과</legend>
   <?php echo "<p>검색 결과가 없습니다..</p>"; ?>
</fieldset>
</form>
<?php } ?>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
	<input type='submit' value='돌아가기' id = "submitMainPage"/>
</form>
</body>
</html>