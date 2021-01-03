<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리</title>
</head>
<body>
<div align="center">
<h3>동네 서점 DB 내 서점 관리</h3>


<!-- 서점 관리자 : 서점 관리 페이지 -->
<div align="center">
<fieldset style = "width:300px; height:350px">
<form name="registerBookButton" action="/registerBook.php" method="post" id ="registerBookButton">
	<input type='submit' value='도서 등록하기' id = "submitRegister"/>
</form>
<br>
<form name="viewMyBookButton" action="/viewMyBook.php" method="post" id="viewMyBookButton">
	<input type='submit' value='내 도서목록' id = "submitView"/>
</form>
<br>
<form name="changeBookInformationButton" action="/changeBookInformation.php" method="post" id ="changeBookInformationButton">
	<input type='submit' value='도서 정보 수정/삭제' id = "submitModifyOrDelete"/>
</form>
<br>
<form name="modifyMyInfoButton" action="/modifyMyInfo.php" method="post" id ="modifyMyInfoButton">
	<input type='submit' value='회원 정보 수정' id = "submitModifyMyInfo"/>
</form>
<br>
<form name="withdrawalButton" action="/withdrawal.php" method="post" id ="withdrawalButton">
	<input type='submit' value='회원 탈퇴' id = "submitWithdrawal"/>
</form>
<br>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<br>
</fieldset>
</div>


</body>
</html>