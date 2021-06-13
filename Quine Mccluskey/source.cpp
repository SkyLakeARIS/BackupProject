#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <conio.h>

#define DoNothing (0);

typedef struct quine
{
	char variable[4 + 1];	// A B C D를 나타내는 변수 / 이진수	
	int decimal[16];		// 최소항을 나타내는 변수 (0~15의 십진수)
	int decimalSize;		// 결합했을 때 최소항의 개수를 저장하는 변수
	int Onecount;			// 최소항이 1을 몇개 가지고 있는지 저장하는 변수
}quine;
int g_Impl_Index = 0;
int g_PI_Index = 0;
int g_EPI_Index = 0;
int g_recur_count = 0, g_Max_recur = 5;
//인자로 전달받은 impl 값들 출력  isPI가 1이면 출력시 *을 붙여줌.
void PrintImplicant(const quine impl[], const int index, int isPI)
{
	int numOfOne = -1;
	for (int i = 0; i < index; i++)
	{
		impl[i].Onecount == numOfOne ? printf("") : printf("%d\n", impl[i].Onecount);
		numOfOne = impl[i].Onecount;
		printf("(%s) (", impl[i].variable);
		for (int j = 0; j < impl[i].decimalSize; j++)
		{
			printf("%d ", impl[i].decimal[j]);
		}
		printf(")");
		isPI == 1 ? printf("*\n") : printf("\n");
	}
	printf("\n");
}
//선택
void SelectImplicant(quine data[])
{
	int select = 0, num = 0, oneCount = 0;
	char variable[4 + 1] = { NULL, };
	for (int decimal = 0; decimal < 16; decimal++) // 16개 최소항 마킹
	{
		num = decimal;
		oneCount = 0;
		for (int i = 1; i <= 4; i++)	//decimal을 이진수로 변환
		{
			variable[4 - i] = num % 2 == 0 ? '0' : '1';
			num % 2 == 1 ? ++oneCount : oneCount;
			num = num / 2;
		}
		printf("(%s) (%d)   ", variable, decimal);
		scanf_s("%d", &select);
		if (select == 1)	//선택된 값은 implicant로 들어감.
		{
			data[g_Impl_Index].decimalSize = 1;
			data[g_Impl_Index].Onecount = oneCount;
			data[g_Impl_Index].decimal[0] = decimal;
			strcpy_s(data[g_Impl_Index].variable, sizeof(variable), variable);
			++g_Impl_Index;
		}
	}
}
// impl에서 newImpl로 멤버변수 값 복사
void MoveToNewImplicant(quine impl[], const int index, quine newImpl[], const int newIndex)
{
	for (int i = 0; i < impl[index].decimalSize; i++)
	{
		newImpl[newIndex].decimal[i] = impl[index].decimal[i];
	}
	newImpl[newIndex].decimalSize = impl[index].decimalSize;
	newImpl[newIndex].Onecount = impl[index].Onecount;
	strcpy_s(newImpl[newIndex].variable, sizeof(impl[index].variable), impl[index].variable);
}
//선택한 최소항들을 1의 개수에 따라 정렬하여 impl 배열에 넣음.
void Implicant(quine data[], quine impl[])
{
	int newIndex = 0;
	for (int i = 0; i <= 4; i++) // 1의 개수대로 정렬
	{
		for (int j = 0; j < g_Impl_Index; j++)
		{
			if (data[j].Onecount == i)
			{
				//data->impl로 이동
				MoveToNewImplicant(data, j, impl, newIndex);
				++newIndex;
			}
		}
	}
	PrintImplicant(impl, newIndex, 0);
}
//머징 함수  인자로받은 impl와 index값       impl의 최소항 개수    찾은 PI를 저장할 변수  단계별 반복 회수
int Get_PrimeImplicant(quine impl[], const int index, const int decimalIndex, quine pimpl[], int count)
{
	int newIndex = 0, newDecimalIndex = decimalIndex * 2, mergeCount = 0, countOverlap = 0;
	int PI_Index = 0, PI_Table[16] = { 0, }, is_PI = 0;
	char merge[4 + 1] = { NULL, };
	quine newimpl[32];

	++g_recur_count; // 최대 반복 횟수 저장을 위해 카운트.
	if (count != 0) // count가 0이 되면 반복 종료. 위와 아래 둘 다 단계별 출력을 위해 만들었습니다.
	{
		for (int i = 0; i < index - 1; i++)
		{
			for (int j = i; j < index; j++)
			{
				//1의 개수를 통해 인접한 항인지 체크(0-1, 1-2, 2-3...) 
				if (impl[i].Onecount + 1 == impl[j].Onecount)
				{
					mergeCount = 0;		//비트열을 비교하기 전 0 초기화
					//비교 변수를 이용해 두 최소항의 비트열 비교를 함.
					strcpy_s(merge, sizeof(impl[i].variable), impl[i].variable);
					for (int k = 0; k < 4; k++)
					{
						//해당 자리의 비트가 다르면 '-'  대입
						if (impl[i].variable[k] != impl[j].variable[k])
						{
							merge[k] = '-';
							++mergeCount;
						}
					}
					//머지 카운트가 1이면 결합, 0이거나 그 이상이면 결합하지 않음.
					if (mergeCount == 1)
					{
						countOverlap = 0;
						for (int index = 0; index < newIndex; index++)	//중복 검사.
						{
							if (strcmp(newimpl[index].variable, merge) == 0)
							{
								++countOverlap;
							}
						}
						//중복 검사를 통과하면 new prime implicant에 값 삽입.
						if (countOverlap == 0)
						{
							MoveToNewImplicant(impl, i, newimpl, newIndex);
							newimpl[newIndex].decimalSize = newDecimalIndex;
							strcpy_s(newimpl[newIndex].variable, sizeof(merge), merge); //머징된 항 복사
							for (int index = 0; index < decimalIndex; index++)
							{
								newimpl[newIndex].decimal[decimalIndex + index] = impl[j].decimal[index];
							}
							++newIndex;
						}
					}
				}
			}
		}
		//newIndex가 0이면 더 이상 결합할 항이 없다는것을 의미하므로 반복 종료.
		if (newIndex == 0)
		{
			PrintImplicant(impl, index, 0);
			g_Max_recur = g_recur_count;
			return 1;
		}
		else
		{
			if (Get_PrimeImplicant(newimpl, newIndex, newDecimalIndex, pimpl, count - 1))
			{
				//0 1 2 3 ''' 13 14 15 의 번호 테이블에 (테이블의 인덱스가 최소항의 번호를 나타냄)
				//PI가 가지고 있는 최소항들의 번호들을 카운트해서 중복 체크를 함.
				for (int i = 0; i < newIndex; i++)
				{
					//pimpl에 이미 구해진 pi값을 넣음.
					MoveToNewImplicant(newimpl, i, pimpl, g_PI_Index);
					++g_PI_Index;
				}
			}
			for (int i = 0; i < g_PI_Index; i++)	//이전 단계에서 PI를 구하기 위해 PI테이블을 만듦. 
			{
				for (int j = 0; j < pimpl[i].decimalSize; j++)
				{
					PI_Table[pimpl[i].decimal[j]]++;
				}
			}
			for (int i = 0; i < index; i++)
			{
				is_PI = 0;
				for (int j = 0; j < impl[i].decimalSize; j++)
				{
					if (PI_Table[impl[i].decimal[j]] == 0) // 해당 자리가 0이면 PI확정
					{
						is_PI = 1;	// 최소항중에 유일한 번호 하나라도 있으면 pi이기 때문에 그냥 하나만 카운트
					}
				}
				if (is_PI == 1)
				{
					MoveToNewImplicant(impl, i, pimpl, g_PI_Index);
					++g_PI_Index;
				}
			}
		}
	}
	else
	{
		PrintImplicant(impl, index, 0);
	}
	return 0;
}
//PI차트를 이용해 EPI를 구하는 함수
void Get_EPI(quine pimpl[], quine EPI[])
{
	int decimal_table[16] = { 0 }, newIndex = 0, count_Overlap = 0, is_EPI = 0;
	//PI차트를 그리기 위한 변수
	int PI_Chart[32][16] = { 0, }, EPI_Table[16] = { 0, };
	// 1이면 * (후보항 번호)
	// 2이면 (*) EPI
	// 3이면 +  EPI 탈락 번호

	//EPI를 찾기위해 각 후보항들의 번호가 몇개인지 카운트함.
	for (int i = 0; i < g_PI_Index; i++)
	{
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{
			decimal_table[pimpl[i].decimal[j]]++;
			//EPI테이블 그리기
			PI_Chart[i][pimpl[i].decimal[j]] = 3;
		}
	}

	//위에서 찾은 후보항 번호 테이블을 이용해 1개만 카운트가 되어있는 후보항을 찾아 EPI에 편입.
	//표에서 세로로 혼자 있음 == 후보항중에 혼자만 가지고 있는 번호가 있음.
	for (int i = 0; i < g_PI_Index; i++)
	{
		is_EPI = 0;
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{

			if (decimal_table[pimpl[i].decimal[j]] == 1)
			{
				is_EPI = 1;
				//EPI 테이블 그리기
				PI_Chart[i][pimpl[i].decimal[j]] = 2;

			}
		}
		if (is_EPI == 1) {
			MoveToNewImplicant(pimpl, i, EPI, newIndex);
			++newIndex;
		}
	}

	for (int i = 0; i < newIndex; i++)	//숨겨진 EPI를 찾기위해 EPI테이블을 만듬
	{
		for (int j = 0; j < EPI[i].decimalSize; j++)
		{
			EPI_Table[EPI[i].decimal[j]]++;
		}
	}
	for (int i = 0; i < g_PI_Index; i++)	//숨겨진 EPI를 탐색함.
	{
		count_Overlap = 0;
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{
			if (EPI_Table[pimpl[i].decimal[j]] != 0)
			{
				++count_Overlap;
			}
			else
			{	//PI 차트 그리기
				PI_Chart[i][pimpl[i].decimal[j]] = 1;
			}
		}
		if (count_Overlap == 0) // EPI_Table에 하나의 번호라도 중복되지 않는 최소항이면 EPI로 편입
		{
			MoveToNewImplicant(pimpl, i, EPI, newIndex);
			++newIndex;
		}
	}
	//EPI 배열의 인덱스 초기화
	g_EPI_Index = newIndex;

	//PI 차트 그리기
	for (int blank = 0; blank < 30; blank++)
	{
		printf(" ");
	}
	for (int i = 0; i < 16; i++)
	{
		decimal_table[i] >= 1 ? printf("%3d", i) : DoNothing;
		decimal_table[i] == 0 ? printf("   ") : DoNothing;
	}
	printf("\n");
	for (int i = 0; i < g_PI_Index; i++)
	{
		printf("(");
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{
			printf("%3d", pimpl[i].decimal[j]);
		}
		printf(")");
		//라인을 맞추기 위해 빈칸 그리기
		for (int blank = 0; blank < (30 - ((pimpl[i].decimalSize * 3) + 2)); blank++)
		{
			printf(" ");
		}
		for (int j = 0; j < 16; j++)
		{
			PI_Chart[i][j] == 0 ? printf("   ") : DoNothing;
			PI_Chart[i][j] == 1 ? printf(" * ") : DoNothing;
			PI_Chart[i][j] == 2 ? printf("(*)") : DoNothing;
			PI_Chart[i][j] == 3 ? printf(" + ") : DoNothing;
		}
		printf("\n");
	}
}
//결과 출력
void Result(quine EPI[])
{
	int hyphen = 0;
	printf("f = ");
	for (int i = 0; i < g_EPI_Index; i++)
	{
		hyphen = 0;
		EPI[i].variable[0] == '1' ? printf("A") : EPI[i].variable[0] == '0' ? printf("A'") : hyphen++;
		EPI[i].variable[1] == '1' ? printf("B") : EPI[i].variable[1] == '0' ? printf("B'") : hyphen++;
		EPI[i].variable[2] == '1' ? printf("C") : EPI[i].variable[2] == '0' ? printf("C'") : hyphen++;
		EPI[i].variable[3] == '1' ? printf("D") : EPI[i].variable[3] == '0' ? printf("D'") : hyphen++;
		hyphen == 4 ? printf("") : i < g_EPI_Index - 1 ? printf("+") : printf("");
	}
}
//단계별로 출력하는 함수.
void ViewStepByStep()
{
	int currentStep = 1, key = 0, recursionCount = 1, nextStep = 0;
	quine data[16], impl[16], pimpl[32], EPI[32];

	SelectImplicant(data);
	while (key != 27)
	{
		if (currentStep == 2)
		{
			nextStep = 1;
			while (nextStep == 1) //머징 단계별 출력 부분
			{
				system("cls");
				g_PI_Index = 0;
				g_recur_count = 0;
				Get_PrimeImplicant(impl, g_Impl_Index, 1, pimpl, recursionCount);
				224 == _getch() ? key = _getch() : DoNothing;
				key == 72 ? recursionCount-- : DoNothing;
				key == 80 ? recursionCount++ : DoNothing;
				if (recursionCount <= 0)  //이전 단계로 이동
				{
					currentStep--;
					recursionCount = 1;
					nextStep = 0;
				}
				if (recursionCount > g_Max_recur) // 머징이 완료되면 다음 단계 이동
				{
					recursionCount = g_Max_recur;
					currentStep++;
					nextStep = 0;
				}
			}
		}
		else
		{
			system("cls");
			if (currentStep == 1) Implicant(data, impl);
			if (currentStep == 3) PrintImplicant(pimpl, g_PI_Index, 1); // 구한 PI 항들을 출력
			if (currentStep == 4) Get_EPI(pimpl, EPI);
			if (currentStep == 5) Result(EPI);
			224 == _getch() ? key = _getch() : DoNothing;
			key == 72 ? currentStep > 1 ? currentStep-- : currentStep : DoNothing;
			key == 80 ? currentStep < 5 ? currentStep++ : currentStep : DoNothing;
		}
	}
}

void main()
{
	ViewStepByStep();
}