#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <conio.h>

#define DoNothing (0);

typedef struct quine
{
	char variable[4 + 1];	// A B C D�� ��Ÿ���� ���� / ������	
	int decimal[16];		// �ּ����� ��Ÿ���� ���� (0~15�� ������)
	int decimalSize;		// �������� �� �ּ����� ������ �����ϴ� ����
	int Onecount;			// �ּ����� 1�� � ������ �ִ��� �����ϴ� ����
}quine;
int g_Impl_Index = 0;
int g_PI_Index = 0;
int g_EPI_Index = 0;
int g_recur_count = 0, g_Max_recur = 5;
//���ڷ� ���޹��� impl ���� ���  isPI�� 1�̸� ��½� *�� �ٿ���.
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
//����
void SelectImplicant(quine data[])
{
	int select = 0, num = 0, oneCount = 0;
	char variable[4 + 1] = { NULL, };
	for (int decimal = 0; decimal < 16; decimal++) // 16�� �ּ��� ��ŷ
	{
		num = decimal;
		oneCount = 0;
		for (int i = 1; i <= 4; i++)	//decimal�� �������� ��ȯ
		{
			variable[4 - i] = num % 2 == 0 ? '0' : '1';
			num % 2 == 1 ? ++oneCount : oneCount;
			num = num / 2;
		}
		printf("(%s) (%d)   ", variable, decimal);
		scanf_s("%d", &select);
		if (select == 1)	//���õ� ���� implicant�� ��.
		{
			data[g_Impl_Index].decimalSize = 1;
			data[g_Impl_Index].Onecount = oneCount;
			data[g_Impl_Index].decimal[0] = decimal;
			strcpy_s(data[g_Impl_Index].variable, sizeof(variable), variable);
			++g_Impl_Index;
		}
	}
}
// impl���� newImpl�� ������� �� ����
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
//������ �ּ��׵��� 1�� ������ ���� �����Ͽ� impl �迭�� ����.
void Implicant(quine data[], quine impl[])
{
	int newIndex = 0;
	for (int i = 0; i <= 4; i++) // 1�� ������� ����
	{
		for (int j = 0; j < g_Impl_Index; j++)
		{
			if (data[j].Onecount == i)
			{
				//data->impl�� �̵�
				MoveToNewImplicant(data, j, impl, newIndex);
				++newIndex;
			}
		}
	}
	PrintImplicant(impl, newIndex, 0);
}
//��¡ �Լ�  ���ڷι��� impl�� index��       impl�� �ּ��� ����    ã�� PI�� ������ ����  �ܰ躰 �ݺ� ȸ��
int Get_PrimeImplicant(quine impl[], const int index, const int decimalIndex, quine pimpl[], int count)
{
	int newIndex = 0, newDecimalIndex = decimalIndex * 2, mergeCount = 0, countOverlap = 0;
	int PI_Index = 0, PI_Table[16] = { 0, }, is_PI = 0;
	char merge[4 + 1] = { NULL, };
	quine newimpl[32];

	++g_recur_count; // �ִ� �ݺ� Ƚ�� ������ ���� ī��Ʈ.
	if (count != 0) // count�� 0�� �Ǹ� �ݺ� ����. ���� �Ʒ� �� �� �ܰ躰 ����� ���� ��������ϴ�.
	{
		for (int i = 0; i < index - 1; i++)
		{
			for (int j = i; j < index; j++)
			{
				//1�� ������ ���� ������ ������ üũ(0-1, 1-2, 2-3...) 
				if (impl[i].Onecount + 1 == impl[j].Onecount)
				{
					mergeCount = 0;		//��Ʈ���� ���ϱ� �� 0 �ʱ�ȭ
					//�� ������ �̿��� �� �ּ����� ��Ʈ�� �񱳸� ��.
					strcpy_s(merge, sizeof(impl[i].variable), impl[i].variable);
					for (int k = 0; k < 4; k++)
					{
						//�ش� �ڸ��� ��Ʈ�� �ٸ��� '-'  ����
						if (impl[i].variable[k] != impl[j].variable[k])
						{
							merge[k] = '-';
							++mergeCount;
						}
					}
					//���� ī��Ʈ�� 1�̸� ����, 0�̰ų� �� �̻��̸� �������� ����.
					if (mergeCount == 1)
					{
						countOverlap = 0;
						for (int index = 0; index < newIndex; index++)	//�ߺ� �˻�.
						{
							if (strcmp(newimpl[index].variable, merge) == 0)
							{
								++countOverlap;
							}
						}
						//�ߺ� �˻縦 ����ϸ� new prime implicant�� �� ����.
						if (countOverlap == 0)
						{
							MoveToNewImplicant(impl, i, newimpl, newIndex);
							newimpl[newIndex].decimalSize = newDecimalIndex;
							strcpy_s(newimpl[newIndex].variable, sizeof(merge), merge); //��¡�� �� ����
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
		//newIndex�� 0�̸� �� �̻� ������ ���� ���ٴ°��� �ǹ��ϹǷ� �ݺ� ����.
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
				//0 1 2 3 ''' 13 14 15 �� ��ȣ ���̺� (���̺��� �ε����� �ּ����� ��ȣ�� ��Ÿ��)
				//PI�� ������ �ִ� �ּ��׵��� ��ȣ���� ī��Ʈ�ؼ� �ߺ� üũ�� ��.
				for (int i = 0; i < newIndex; i++)
				{
					//pimpl�� �̹� ������ pi���� ����.
					MoveToNewImplicant(newimpl, i, pimpl, g_PI_Index);
					++g_PI_Index;
				}
			}
			for (int i = 0; i < g_PI_Index; i++)	//���� �ܰ迡�� PI�� ���ϱ� ���� PI���̺��� ����. 
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
					if (PI_Table[impl[i].decimal[j]] == 0) // �ش� �ڸ��� 0�̸� PIȮ��
					{
						is_PI = 1;	// �ּ����߿� ������ ��ȣ �ϳ��� ������ pi�̱� ������ �׳� �ϳ��� ī��Ʈ
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
//PI��Ʈ�� �̿��� EPI�� ���ϴ� �Լ�
void Get_EPI(quine pimpl[], quine EPI[])
{
	int decimal_table[16] = { 0 }, newIndex = 0, count_Overlap = 0, is_EPI = 0;
	//PI��Ʈ�� �׸��� ���� ����
	int PI_Chart[32][16] = { 0, }, EPI_Table[16] = { 0, };
	// 1�̸� * (�ĺ��� ��ȣ)
	// 2�̸� (*) EPI
	// 3�̸� +  EPI Ż�� ��ȣ

	//EPI�� ã������ �� �ĺ��׵��� ��ȣ�� ����� ī��Ʈ��.
	for (int i = 0; i < g_PI_Index; i++)
	{
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{
			decimal_table[pimpl[i].decimal[j]]++;
			//EPI���̺� �׸���
			PI_Chart[i][pimpl[i].decimal[j]] = 3;
		}
	}

	//������ ã�� �ĺ��� ��ȣ ���̺��� �̿��� 1���� ī��Ʈ�� �Ǿ��ִ� �ĺ����� ã�� EPI�� ����.
	//ǥ���� ���η� ȥ�� ���� == �ĺ����߿� ȥ�ڸ� ������ �ִ� ��ȣ�� ����.
	for (int i = 0; i < g_PI_Index; i++)
	{
		is_EPI = 0;
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{

			if (decimal_table[pimpl[i].decimal[j]] == 1)
			{
				is_EPI = 1;
				//EPI ���̺� �׸���
				PI_Chart[i][pimpl[i].decimal[j]] = 2;

			}
		}
		if (is_EPI == 1) {
			MoveToNewImplicant(pimpl, i, EPI, newIndex);
			++newIndex;
		}
	}

	for (int i = 0; i < newIndex; i++)	//������ EPI�� ã������ EPI���̺��� ����
	{
		for (int j = 0; j < EPI[i].decimalSize; j++)
		{
			EPI_Table[EPI[i].decimal[j]]++;
		}
	}
	for (int i = 0; i < g_PI_Index; i++)	//������ EPI�� Ž����.
	{
		count_Overlap = 0;
		for (int j = 0; j < pimpl[i].decimalSize; j++)
		{
			if (EPI_Table[pimpl[i].decimal[j]] != 0)
			{
				++count_Overlap;
			}
			else
			{	//PI ��Ʈ �׸���
				PI_Chart[i][pimpl[i].decimal[j]] = 1;
			}
		}
		if (count_Overlap == 0) // EPI_Table�� �ϳ��� ��ȣ�� �ߺ����� �ʴ� �ּ����̸� EPI�� ����
		{
			MoveToNewImplicant(pimpl, i, EPI, newIndex);
			++newIndex;
		}
	}
	//EPI �迭�� �ε��� �ʱ�ȭ
	g_EPI_Index = newIndex;

	//PI ��Ʈ �׸���
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
		//������ ���߱� ���� ��ĭ �׸���
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
//��� ���
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
//�ܰ躰�� ����ϴ� �Լ�.
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
			while (nextStep == 1) //��¡ �ܰ躰 ��� �κ�
			{
				system("cls");
				g_PI_Index = 0;
				g_recur_count = 0;
				Get_PrimeImplicant(impl, g_Impl_Index, 1, pimpl, recursionCount);
				224 == _getch() ? key = _getch() : DoNothing;
				key == 72 ? recursionCount-- : DoNothing;
				key == 80 ? recursionCount++ : DoNothing;
				if (recursionCount <= 0)  //���� �ܰ�� �̵�
				{
					currentStep--;
					recursionCount = 1;
					nextStep = 0;
				}
				if (recursionCount > g_Max_recur) // ��¡�� �Ϸ�Ǹ� ���� �ܰ� �̵�
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
			if (currentStep == 3) PrintImplicant(pimpl, g_PI_Index, 1); // ���� PI �׵��� ���
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