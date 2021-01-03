<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 회원 가입</title>
</head>
<body>

<p style="text-align:left;" class= "main">
<a href="#" onclick="location.href=('main.php')">
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ></a>
</p>

<div align="center"><h3>회원 가입</h3>
<fieldset style = "width:300px; height:500px">
<legend>정보 입력</legend>
<form name="registerInformation" action="/registration.php" method="post" id ="registerInformationBar">
    <!--회원 정보 입력 form -->
    <div align="center">
    <p>아이디</p>
    <input type='text' name='registerID' placeholder='아이디' autofocus id = "inputID"/>
    <p>비밀번호&lt;8자-16자 이내&gt;</p>
    <input type='password' name='registerPW' placeholder='8자~16자내' size='16' maxlength='16' id ="inputPW" />	
    <p>비밀번호 확인</p>
    <input type='password' name='registerPWConfirm' placeholder='비밀번호 확인' maxlength='16' id = "inputPWConfirm"/>
    <p>서점 명</p>
    <input type='text' name='registerLibraryName' placeholder='서점 명' maxlength='20' id="inputLibraryName" />
    <p>주소</p>
    <input type='text' name='registerAddress' placeholder='주소' maxlength='30' id = "inputAddress"/>
    <p>전화번호&lt;-포함&gt;</p>
    <input type='text' name='registerPhoneNumber' placeholder='-을 포함하여 입력하세요.' maxlength='13' id ="inputPhoneNumber" />
    <input type='submit' value='제출' id = "submit"/>
    </div>
</form>
</fieldset>
</body>
</html>