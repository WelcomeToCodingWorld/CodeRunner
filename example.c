#include <stdio.h>

int x  = 1;
int main(void) {
	void abc(void *a, int b);
	int y = 5;
	abc(&y,x);
	return x + y;
}

void abc(void *a, int b)
{
	if(b==1)
		printf("%d",*(int*)a);     // If integer pointer is received
	else if(b==2)
		printf("%c",*(char*)a);     // If character pointer is received
	else if(b==3)
		printf("%f",*(float*)a);     // If float pointer is received
}