#include <stdio.h>

int getSum(int n)
{
    int sum = 0, i;
    for (i = 1; i <= n; i++)
        sum += i;
    return sum;
}

int main()
{
    int res = getSum(100);
    printf("1+2+...+100=%d\n", res);
}
