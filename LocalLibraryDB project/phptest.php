<?php
    $browserAgent = $_SERVER['HTTP_USER_AGENT'];
 
    if(strpos($browserAgent, 'iPhone') == true)
	{
        echo "이 기기는 아이폰입니다.";
    }
	else if(strpos($browserAgent, 'iPad') == true)
	{
        echo "이 기기는 아이패드입니다.";
    } 
	else if(strpos($browserAgent, 'Macintosh') == true)
	{
        echo "이 기기는 맥입니다.";
    }
	
	if(strpos($browserAgent, 'Windows') == true)
	{
		echo "윈도우에서 접속.";
	}
	else if(strpos($browserAgent, 'Android') == true)
	{
		echo "모바일에서 접속(안드)";
	}	
	echo $browserAgent;
/*

sort() 함수 = 만약 인덱스에 key를 지정했다면 원 숫자형태로 되돌아감. 오름차순
asort()함수 = 인덱스에 지정한 key값을 유지하면서 정렬함. 오름차순
rsort()함수 = 내림차순
arsort()함수 = 내림차순+asort()함수의 기능 유지
ksort()함수 = 값이 아닌 인덱스에 지정한 key를 기준으로 정렬(알파벳 순)
krsort()함수 = ksort() 기능에 내림차순 정렬

ord() 문자열 -> 아스키 코드
chr() 아스키 -> 문자열

printf(), sprintf() 지원
substr(문자열, 시작점, 길이)
strchr(문자열, 자를 문자열)
str_replace(기존 문자, 새 문자, 대상 변수 )
preg_match(/검색어/, 검색 문자열) - 찾으면 1 아니면 0 반환
strpos() - ??? 검색 필요. 반환형은 true/false인듯.
strcmp 지원
주의사항은 한글은 2바이트기 때문에 인덱스를 2개씩 센다는 점.
ereg(검색어, 문자열) - 대소문자 구별하여 검색
eregi(검색어, 문자열) - 대소문자 구별하지 않는 검색
chop() - 문자열 뒷부분 공백제거
trim() - 앞,뒤의 공백 제거, ltrim() 왼쪽만, rtrim() 오른쪽만
explode(인덱스의 구분 ex(" "),대상 ex($a)) - 문자열을 배열로 만드는 함수 

날짜 시간 함수
https://www.everdevel.com/PHP/date/
수학관련
https://www.everdevel.com/PHP/math/

함수 선언 지원
단 시그니처에 반환형은 없음.
함수에서 return은 가능.

람다함수 지원 (용법 아래)
$변수 = function(매개변수 지정가능)
{
	//코드
}
$변수();

전역변수, 지역변수
타 언어와 달리 전역변수 선언은 함수(지역)내에서 사용 불가, 지역 선언은 전역에서 사용 불가.
사용하려면 사용하려는 스코프에서 global $변수, 후 이용.

static 키워드 지원 ( 프로그램 종료시까지 라이프타임)

class 지원. 프로퍼티 지원.
class 시그니처 동일.
접근제어지시자 지원.
메소드 지원.
프로퍼티 용법
$변수명->프로퍼티; 
예) public age = 20;
$개체->age;  //그냥 멤버변수 접근하는거랑 같은데.. 후에 더 조사 필요.
->로 변수 접근시에는 $를 붙이지 않음.

상속지원.
상속 용법
class cat extends animal {}

this 포인터 지원.

self::로 접근하는 방법도 있는듯..

static 키워드 지원.
static 메소드 및 멤버변수($ 필히 붙힘)는 
C#에서 console.write()하는거처럼. 클래스명::메소드();식으로 함.

생성자 소멸자 지원.
생성자 용법
function __construct(매개변수 가능) {}
소멸자 용법
function __destruct() {}

오버라이딩 지원.
자식에 같은 함수 재정의. 자식의 함수로 호출.

final 키워드 지원.
자식이 재정의 불가.
용법
final 접근제어 function 함수명() {}
클래스 상속 금지시 용법
final class car
-> class porter extends car  (x)
개체생성 용법 동일
 = new 클래스;
namespace 지원.
용법
ex) namespace 이름;
사용 -> \이름\무언가; <- 개체 생성시에도 적용됨(new \namespace\value).

#비추천
use 네임스페이스 as 네임스페이스 대체명;


*/
?>