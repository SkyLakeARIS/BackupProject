<?php 
include 'session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB</title>

<style>

	div.fixed {
			border: 2px solid #483D8B;
			width: 300px;
			position: fixed;
			top: 10;
			right: 0;
		}


div.fixed1 {
			border: 2px solid #483D8B;
			width: 300px;
			position: fixed;
			top: 10;
			right: 0;
		}

	input {
		width : 50%;
		padding : 10px 20px;
		margin : 5px 0;
		box-sizing : border-box;
}

	input[type="search"] {
		width : 20%;
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

input[type="text"] {
			width: 60%;
			padding: 10px 20px;
			margin: 10px 0;
			box-sizing: border-box;
			border: none;
			background-color: #483D8B;
			color: white;
		}

input[type="password"] {
			width: 60%;
			padding: 10px 20px;
			margin: 5px 0;
			box-sizing: border-box;
			border: none;
			background-color: #483D8B;
			color: white;
		}

input[type="submit"] {
			width: 30%;
			padding: 10px 20px;
			margin: 5px 0;
			box-sizing: border-box;
		}

</style>
</head>
<body>
<p style="text-align:right;" class="x_icon">
<a href="#" onclick="window.open('about:blank', '_self').close();">
<img src="https://tkis.kunsan.ac.kr/css/images/x_icon.png" alt="닫기"></a>
</p>

<p style="text-align:left;" class= "main">
<a href="#" onclick="location.href=('main.php')">
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ></a>
</p>

<h1 style="text-align: center; font-weight: bold; font-size: 2.5em; color: navy; font-family: 나눔스퀘어">
<img src="https://www.flaticon.com/svg/static/icons/svg/3100/3100752.svg" alt= dd width="60" height="52">
동네 서점 DB 검색 사이트</h1>

<p>도서 검색 검색창 </p>
<?php
//signInState / true == 로그인된 상태, false == 로그아웃된 상태
//세션 상태에 따라 출력하는 html form이 다름.
if($signInState)
{
	echo "<p>안녕하세요. {$_SESSION['sessionID']} 님! </p>"
	?>
	<!-- 검색어 입력 form + autofocus, placeholder -->
             <div align="center">
	<form name="searchBar" action="/search.php" method="post" id ="searchBar">
		<input type='search' name='searchKeyword' placeholder='검색어를 입력하세요.' autofocus id = "searchKeyWord"/>
		<input type='submit' value='검색' id= "submitSearch"/>
	</form>
             </div>
	<!--관리 and 로그아웃 form -->
	<form name="managementButton" action="/management.php" method="post" id = "managementButton">
		<input type='submit' value='관리' id= "submitManagement"/>
	</form>
	<form name="signOutButton" action="/signOut.php" method="post" id = "signOutButton">
		<input type='submit' value='로그아웃' id= "submitSignOut"/>
	</form>
	<?php
}
else
{
	echo "<p>안녕하세요.</p>"
	?>
	<!-- 검색어 입력 form + autofocus, placeholder -->
             <div align="center">
	<form name="searchBar" action="/search.php" method="post" id ="searchBar">
		<input type='search' name='searchKeyword' placeholder='검색어를 입력하세요.' autofocus id = "searchKeyWord"/>
		<input type='submit' value='검색' id= "submitSearch"/>
	</form>
             </div>
	<div class="fixed">
	<!-- //ID / PW 입력 form -->
	<form name="signInBar" action="/signIn.php" method="post" id = "signInBar">
		<p>- 아이디 :</p> 
		<input type='text' name='userID' placeholder='아이디를 입력하세요.' id = "inputID" />
		<p>- 비밀번호 :</p>
		<input type='password' name='userPW' placeholder='비밀번호를 입력하세요.' id="inputPW" />
		<p>
		<input type='submit' value='로그인' id = "submitSignIn"/>
		</p>

	</form>
	<!--회원가입 form -->
	<form name="signUpButton" action="/signUp.php" method="post" id = "SignUpButton">

		<input type='submit' value='회원가입' id= "submitSignUp"/>

	</form>
</div>
	<?php } ?>


	</body>
<footer style="text-align : center">Copyright ⓒ 2020 Local bookstore searchsite. All rights Reserved.</footer>
	</html>

<table cellpadding="0" cellspacing="0" width="462"> <tr> 
<td style="border:1px solid #cecece;"><a href="https://v4.map.naver.com/?searchCoord=ed7376a5fb210020fd23368e3dad3ed6761071fa0a7f44967ebe85d9db3e73c9&query=6rWw7IKwIOyEnOygkA%3D%3D&tab=1&lng=6be64cfafa0c9c138e33390ebcd0b076&mapMode=0&mpx=4a81338e335377ede7031e570b4c6afb1a669aa31edaa9d275f8ac756e3588f54d104b4e839cf3f7260a2c9086a00d04c217675b617c0550b63d0eca509ee25f&lat=a8a3f7db768da0443f75ac47916b35d8&dlevel=11&enc=b64&menu=location" target="_blank"><img src="http://prt.map.naver.com/mashupmap/print?key=p1607068986763_-1846059497" width="460" height="340" alt="지도 크게 보기" title="지도 크게 보기" border="0" style="vertical-align:top;"/></a></td> </tr> <tr> <td> <table cellpadding="0" cellspacing="0" width="100%"> <tr> <td height="30" bgcolor="#f9f9f9" align="left" style="padding-left:9px; border-left:1px solid #cecece; border-bottom:1px solid #cecece;"> <span style="font-family: tahoma; font-size: 11px; color:#666;">2020.12.4</span>&nbsp;<span style="font-size: 11px; color:#e5e5e5;">|</span>&nbsp;<a style="font-family: dotum,sans-serif; font-size: 11px; color:#666; text-decoration: none; letter-spacing: -1px;" href="https://v4.map.naver.com/?searchCoord=ed7376a5fb210020fd23368e3dad3ed6761071fa0a7f44967ebe85d9db3e73c9&query=6rWw7IKwIOyEnOygkA%3D%3D&tab=1&lng=6be64cfafa0c9c138e33390ebcd0b076&mapMode=0&mpx=4a81338e335377ede7031e570b4c6afb1a669aa31edaa9d275f8ac756e3588f54d104b4e839cf3f7260a2c9086a00d04c217675b617c0550b63d0eca509ee25f&lat=a8a3f7db768da0443f75ac47916b35d8&dlevel=11&enc=b64&menu=location" target="_blank">지도 크게 보기</a> </td> <td width="98" bgcolor="#f9f9f9" align="right" style="text-align:right; padding-right:9px; border-right:1px solid #cecece; border-bottom:1px solid #cecece;"> <span style="float:right;"><span style="font-size:9px; font-family:Verdana, sans-serif; color:#444;">&copy;&nbsp;</span>&nbsp;<a style="font-family:tahoma; font-size:9px; font-weight:bold; color:#2db400; text-decoration:none;" href="https://www.navercorp.com" target="_blank">NAVER Corp.</a></span> </td> </tr> </table> </td> </tr> </table>