<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 정보 - 내 정보 수정</title>
<style>
legend {background-color: lightsteelblue;
    border-color: gainsboro;
    text-decoration-color: gray;
    font-size: 1.3em;
    width: auto;
    text-align: center;
    font-family: fantasy;
}
form {border-color: gainsboro;
    margin:auto;
    float: left;
    width: 500px
}

.div {
    float: left;
    
    text-align: center;
}

body {
    float: center;
    margin: auto;
    padding: 50px;
}

input[type="password"] {
    
    padding: 3px 2px;
    margin: 10px 0;
    box-sizing: border-box;
    border: none;
    background-color: gainsboro;
    color: midnightblue;
}

input[type="text"] {
    
    padding: 3px 2px;
    margin: 10px 0;
    box-sizing: border-box;
    border: none;
    background-color: gainsboro;
    color: midnightblue;
}

div.static {
    border: 2px solid #B8860B;
    position: static;
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
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ><a style="font-weight: bold; font-size: 2em"> 정보 수정</a></a>
</h3>
<?php
include 'session.php';

$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
$sqlQuery = "SELECT * FROM User where ID = '{$_SESSION['sessionID']}';";
$sqlResult = mysqli_query( $sqlConn, $sqlQuery);

$myInfo = mysqli_fetch_assoc($sqlResult);

?> 
<div class="static">
<form>

<form>
<fieldset style = "width:400px; height:400px">

<legend>개인 정보</legend>

<div>
<p style = "font-size: 1.1em;"> <?php echo "현재 등록된 정보입니다."; ?></p>
</div>
<div>
<?php echo "<p>아이디: {$myInfo['ID']}</p>"; ?>
</div>
<div>
<?php echo "<p>서점명: {$myInfo['LibraryName']}</p>"; ?>
</div>
<?php echo "<p>주소: {$myInfo['Address']}</p>"; ?>
<?php echo "<p>전화번호: {$myInfo['PhoneNumber']}</p>"; ?>

</fieldset>
</form>
</form>
</div>


<fieldset style = "width:400px; height:600px">
<legend>수정 정보</legend>
<form name="myInformationBar" enctype="multipart/form-data" action="/modifyMyInfo_result.php" method="post" id="myInformationBar">
<input type='hidden' name='myID' autofocus value="<?php echo $myInfo['ID'] ?>"  id = "myID"/>
<p> 비밀번호( 8자-16자 이내)</p>
<input type='password' name='myPW' value="<?php echo $myInfo['PW'] ?>" id = "myPW"/>
<p> 확인 비밀번호 </p>
 <input type='password' name='myPWConfirm' value="<?php echo $myInfo['PW'] ?>" id = "myPWConfirm"/>
<p>서점명 </p>
 <input type='text' name='myLibraryName' value="<?php echo $myInfo['LibraryName'] ?>" id = "myLibraryName"/>
<p>주소</p>
<input type='text' name='myAddress' value="<?php echo $myInfo['Address'] ?>" id = "myAddress" />
<p>전화번호(- 포함) </p>
<input type='text' name='myPhoneNumber' value="<?php echo $myInfo['PhoneNumber'] ?>" id = "myPhoneNumber"/>
<input type='submit' value='정보 수정' id = "submitModify"/>
</form>

<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
<input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>

<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
<input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>

</fieldset>

</body>
</html>