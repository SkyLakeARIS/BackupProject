<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 정보 - 회원 탈퇴</title>
<style>
body {
    float: center;
    margin: auto;
    padding: 50px;
}

fieldset{
    width: 300px;
    height: auto;
    margin: auto;
    border: 3px solid gray;
    margin: auto;
    
}


div {
    float: left;
    
}

legend {background-color: gainsboro;
    border-color: gainsboro;
    text-decoration-color: gray;
    font-size: 1.5em;
    width: auto;
    height: auto;
    font-family: fantasy;
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
<img src="css/images/banner_s.png" alt="동네 서점 DB Local bookstore searchsite" ><a style="font-weight: bold; font-size: 2em"> 회원 탈퇴</a></a>
</h3>

 <p> <a style ="color: red; font-size: 1.2em; font-weight: bold;"> <?php echo "※주의 </a>: 회원 탈퇴를 하면 등록된 관련 정보가 모두 삭제 됩니다. "; ?> </p>

<fieldset>
<legend>회원탈퇴</legend>
<?php echo "<p>정말 탈퇴하시겠습니까?</p>"; ?>

<div>
<form name="withdrawalButton" enctype="multipart/form-data" action="/withdrawal_result.php" method="post" id = "withdrawalButton">
<input type='submit' value='탈퇴' id = "submitWithdrawal"/>
</form>
</div>
<div>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
<input type='submit' value='메인으로' id = "submitMainPage"/>
</form>
</div>
<div>
<form name="mainPageButton" enctype="multipart/form-data" action="/management.php" method="post" id ="mainPageButton">
<input type='submit' value='관리화면으로' id = "submitMainPage"/>
</form>
</div>
</fieldset>
</body>
</html>
