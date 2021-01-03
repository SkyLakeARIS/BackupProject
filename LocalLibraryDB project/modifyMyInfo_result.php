<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 정보 - 내 정보 수정</title>
</head>

<?php
$id = $_POST['myID'];
$newPW = $_POST['myPW'];
$newPWConfirm = $_POST['myPWConfirm'];
$newLibraryName = $_POST['myLibraryName'];
$newAddress = $_POST['myAddress'];
$newPhoneNumber = $_POST['myPhoneNumber'];
$modifyMyInfoOk =1;

try
{
    //비밀번호가 8자-16자 사이인지 확인
    $PWLength = strlen($_POST["myPW"]);
    if($PWLength < 8)
    {
        throw new exception("<p>비밀번호는 8자리 이상 16자리 이하입니다.</p>");
    }
    //비밀번호 일치하는지 확인
    if($_POST['myPW'] !== $_POST['myPWConfirm'])
    {
        throw new exception("<p>확인 비밀번호가 일치하지 않습니다.</p>");
    }
    //전화번호 체크
    if(preg_match("/[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}/", $newPhoneNumber) == 0)
    {
        throw new exception("<p>올바르지 않은 전화번호 형식입니다. - 필수</p>");
    }
}
catch(Exception $error)
{
    $modifyMyInfoOk = 0;
    echo $error->getMessage();
}

if($modifyMyInfoOk == 1)
{
    $sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
    $sqlQuery = "UPDATE User set PW = '{$newPW}', LibraryName = '{$newLibraryName}', Address = '{$newAddress}', PhoneNumber = '{$newPhoneNumber}' where ID = '{$id}';";
    $sqlResult = mysqli_query( $sqlConn, $sqlQuery);
    
    if($sqlResult != NULL)
    {		
        echo '<p>정보를 수정하였습니다.</p>';
    }
    else
    {
        echo "error: " . mysqli_error($sqlConn);
    }
}
else
{
    echo '<p>수정에 실패했습니다.</p>';
}

?>
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<form name="previousPageButton" action="/modifyMyInfo.php" method="post" id = "previousPageButton">
    <input type='submit' value='이전 화면으로' id = "submitPreviousPage"/>
</form>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
    <input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</html>