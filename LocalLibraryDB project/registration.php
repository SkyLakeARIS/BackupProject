<?php
$ID = $_POST['registerID'];
$PW = $_POST['registerPW'];
$PWConfirm = $_POST['registerPWConfirm'];
$libraryName = $_POST['registerLibraryName'];
$libraryAddress = $_POST['registerAddress'];
$newPhoneNumber = $_POST['registerPhoneNumber'];
$signUpOk = 1;

	try
	{
		//입력값 검증 부분.
		if(empty($_POST["registerID"]))
		{
			throw new exception("<p align = 'center'>아이디를 입력해주세요.</p>");
		}

		if(empty($_POST["registerPW"]))
		{
			throw new exception("<p align = 'center'>비밀번호를 입력해주세요.</p>");
		}

		if(empty($_POST["registerPWConfirm"]))
		{
			throw new exception("<p align = 'center'>확인 비밀번호를 입력해주세요.</p>");
		}

		if(empty($_POST["registerLibraryName"]))
		{
			throw new exception("<p align = 'center'>서점 명을 입력해주세요.</p>");
		}

		if(empty($_POST["registerAddress"]))
		{
			throw new exception("<p align = 'center'>서점 주소를 입력해주세요.</p>");
		}
		if(empty($_POST["registerPhoneNumber"]))
		{
			throw new exception("<p align = 'center'>전화번호를 입력해주세요.</p>");
		}	

		//비밀번호가 8자-16자 사이인지 확인
		$PWLength = strlen($_POST["registerPW"]);
		if($PWLength < 8)
		{
			throw new exception("<p align = 'center'>비밀번호는 8자리 이상 16자리 이하입니다.</p>");
		}
		//비밀번호 일치하는지 확인
		if($PW !== $PWConfirm)
		{
			throw new exception("<p align = 'center'>확인 비밀번호가 일치하지 않습니다.</p>");
		}
		//전화번호 형식 체크
		if(preg_match("/[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}/", $newPhoneNumber) == 0)
		{
			throw new exception("<p align = 'center'>올바르지 않은 전화번호 형식입니다. - 필수</p>");
		}

		//아이디 중복검사. 쿼리를 날려서 결과 있는지 확인함.
		$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
		$sqlQuery = "SELECT ID FROM User WHERE ID = '" . $ID . "';";
		$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
		
		//입력값이 정확한지 체크  NULL != 중복.
		if(mysqli_fetch_array( $sqlResult ) != NULL)
		{
			throw new exception("<p align = 'center'>이미 존재하는 아이디 입니다.</p>");
		}
	}
	catch(Exception $error)
	{
		$signUpOk = 0;
		echo $error->getMessage();
	}	

	if($signUpOk == 1)
	{
		//DB 작업
		$sqlQuery = "INSERT INTO User VALUES('{$ID}','{$PW}','{$libraryName}','{$libraryAddress}','{$newPhoneNumber}');";
		$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
		
		if($sqlResult != NULL)
		{
			echo "<p align = 'center'>회원가입 성공</p>";
		}
		else
		{
			echo "error: " . mysqli_error($sqlConn);
		}		
	}
	else
	{
		echo "<p align = 'center'>회원가입 실패</p>";
	}

?>

<div align = "center">
<fieldset style = "width:200px; height:120px">
<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
	<input type='submit' value='메인으로' id = "submitMainPage"/>
</form>
<form name="signUpButton" action="/signUp.php" method="post" id ="signUpButton">
	<input type='submit' value='이전으로' id = "submitSignUp"/>
</form>
</fieldset>
</div>