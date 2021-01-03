<html>
<head>
<meta charset="utf-8" />
<title>동네 서점 DB 내 서점 관리: 도서 등록</title>
</head>
<body>
<?php
include "session.php";
$currentID = $_SESSION['sessionID'];
$name = $_POST['bookName'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$ISBN = $_POST['ISBN'];
$price = $_POST['price'];
$date = $_POST['date'];
$productState = $_POST['isUsed'];

$file = $_FILES['uploadFile'];
//저장 대상 디렉토리
$target_dir = "./image/";
$target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
$checkOk = 1;	//선조건 체크
$uploadOk = 1;	//이미지파일 체크
$insertOk = 1;	//쿼리 체크
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$daysInEachMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);


//날짜 데이터가 yyyy-mm-dd형식이 맞는지 체크함.
//잘라내서 달과 날짜까 올바른 범위내의 값인지 확인.
$month = intval(substr($date, 5,6));
$day = intval(substr($date, 8,2));
if($month < 0 || $month > 12)
{
	echo "<p>달이 올바르지 않습니다. (1~12)</p>";
	$checkOk = 0;
}

if($day < 0 || $day > $daysInEachMonth[$month-1])
{
	echo "<p>날짜가 올바르지 않습니다.(1~28,30,31)</p>";
	$checkOk = 0;
}

if(substr($date, 4,1) != '-' && substr($date, 7,1) != '-')
{
	echo "<p>형식에 맞게 입력하세요. (yyyy-mm-dd)</p>";
	$checkOk = 0;	
}

//섬네일을 등록했는지 체크함.
if($_FILES['uploadFile']['error'] == 4)
{ //섬네일 등록 x상태
	
	$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
	$sqlQuery = "INSERT INTO Book VALUES ('{$currentID}', '{$name}', '{$author}', '{$publisher}', '{$ISBN}', '{$price}', '{$date}', '{$productState}', 'noimage.png');";
	$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
	
	if($sqlResult != NULL)
	{		
		echo '<p>성공</p>';
	}
	else
	{
		$insertOk = 0;
		echo "error: " . mysqli_error($sqlConn);
	}  	
}
else
{
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]))
	{
		$check = getimagesize($_FILES["uploadFile"]["tmp_name"]);
		if($check !== false)
		{
			echo "<p>File is an image - " . $check["mime"] . ".</p>";
			$uploadOk = 1;
		}
		else
		{
			echo "<p>File is not an image.</p>";
			$uploadOk = 0;
		}
	}
	
	// Check if file already exists
	if (file_exists($target_file))
	{
		echo "<p>Sorry, file already exists.</p>";
	}
	
	// Check file size
	if ($_FILES["uploadFile"]["size"] > 2000000) 
	{
		echo "<p>Sorry, your file is too large.</p>";
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
	{
		echo "{$imageFileType}";
		echo "<p>Sorry, only JPG, JPEG, PNG files are allowed.</p>";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0)
	{
		echo "<p>Sorry, your file was not uploaded.</p>";
		// if everything is ok, try to upload file
	}
	else
	{
		$sqlConn = mysqli_connect( 'localhost', 'root', '1234', 'LocalLibraryDB' );
		$sqlQuery = "INSERT INTO Book VALUES ('{$currentID}', '{$name}', '{$author}', '{$publisher}', '{$ISBN}', '{$price}', '{$date}', '{$productState}', '{$_FILES["uploadFile"]["name"]}');";
		$sqlResult = mysqli_query( $sqlConn, $sqlQuery);
		
		if($sqlResult != NULL)
		{
			if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file))
			{
				echo "The file ". htmlspecialchars( basename( $_FILES["uploadFile"]["name"])). " has been uploaded.";
				
			}
			else
			{
				echo "<p>Sorry, there was an error uploading your file.</p>";
			}			
		}
		else
		{
			$insertOk = 0;
			echo "error: " . mysqli_error($sqlConn);
		}  	
		
	}
}

if($uploadOk == 1 && $insertOk == 1 && $checkOk == 1)
{
	echo "<p>해당 도서를 등록했습니다.</p>";
}
else
{
	echo "<p>해당 도서를 실패했습니다.</p>";
}
?>

<form name="mainPageButton" action="/main.php" method="post" id ="mainPageButton">
    <input type='submit' value='메인화면으로' id = "submitMainPage"/>
</form>
<form name="previousPageButton" action="/registerBook.php" method="post" id = "previousPageButton">
    <input type='submit' value='이전 화면으로' id = "submitPreviousPage"/>
</form>
<form name="managementPageButton" action="/management.php" method="post" id ="managementPageButton">
    <input type='submit' value='관리 화면으로' id="submitManagementPage"/>
</form>
</body>
</html>