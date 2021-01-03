<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 등록</title>
<style>
input[type="text"] {
		width : 10px
		padding: 7px 10px;
			margin: 5px 0;
			box-sizing: border-box;
			border: solid 2px #483D8B;
			border-radius: 5px;
			font-size: 16px;
			
			background-position: 5px 4px;
			background-repeat: no-repeat;
		}
    legend {
        width: auto;
        background-color:gainsboro;
        font-weight: bold;
        font-size: 1.3em;
        font-family: sans-serif
    }
input[type="file"] {
		width : auto;
        height: auto;
		padding: auto;
			margin: 5px 0;
			box-sizing: border-box;
			border: solid 2px #483D8B;
			border-radius: 5px;
			font-size: 16px;
			background-image: url("css/images/serach2.png");
			background-position: 5px 4px;
			background-repeat: no-repeat;
		}

    fieldset{
        width: 490px;
        height: auto;
        border: 3px solid gray;
                    margin: auto;

    }
    
input[type="submit"] {
			width: auto;
            height: auto;
			padding: auto;
			margin: 3px 0;
			box-sizing: border-box;
		}
    
    body {
            float: center;
            margin: auto;
            padding: 50px;
        }
    div {
            float: left;
            
        }
</style>
</head>
<body>
               <p style="text-align:right;" class="x_icon">
<a href="#" onclick="window.open('about:blank', '_self').close();">
<img src="https://tkis.kunsan.ac.kr/css/images/x_icon.png" alt="닫기"></a>
</p>
<h3 style= "text-align:center;" "font-weight: bold; font-size: 1.5em; color: navy; font-family: 견고딕;" class= "main">
<a href="#" onclick="location.href=('main.php')">
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ><tr></a><a style="font-weight: bold; font-size: 2em"> 도서 등록</a></h3>

<fieldset style= margin: auto;>
    <legend style= "1.2em;">등록할 도서</legend>
<!-- 등록할 도서 정보 입력 -->
<form name="BookInformationBar" enctype="multipart/form-data" action="/registerBook_result.php" method="post" id ="BookInformationBar">
    <p>도서명</p>
	<input type='text' name='bookName' autofocus placeholder='입력하세요.' id = "bookName"/>
	<p>저자</p>
	<input type='text' name='author' placeholder='입력하세요.' id ="bookAuthor"/>
	<p>출판사</p>
	<input type='text' name='publisher' placeholder='입력하세요.' id ="bookPublisher"/>
	<p>ISBN</p>
	<input type='text' name='ISBN' placeholder='입력하세요.' id ="bookISBN"/>
	<p>가격</p>
	<input type='text' name='price' placeholder='입력하세요.' id ="bookPrice"/>
	<p>출간연도(yyyy-mm-dd)</p>
	<input type='text' name='date' placeholder='입력하세요.' id ="bookDate"/>

	<p>중고여부(택1)</p>
	새상품
	<input type='radio' name='isUsed' value='새상품' checked id="newBook"/>
    중고
	<input type='radio' name='isUsed' value='중고' id="usedBook"/>
	<p>섬네일 등록(크기 2메가 이하, jpg,png,jpeg)</p>
    <input type="file" name="uploadFile" size=100 id = "bookImage">
	<br></br>	
<div>
        <a style="align-content: : right"></a>
	<input type='submit' value='도서 등록' id ="submitRegister"/>
</div>
</form>
</fieldset>


<div style="margin: auto;"
>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
    
</div>
    <div>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
    <input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</div>
</body>
</html>