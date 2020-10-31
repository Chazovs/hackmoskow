#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv)
{
    float work(float arg1, float arg2);

    float arg1 = atof(argv[1]);
    float arg2 = atof(argv[2]);

    printf("%f\n", work(arg1, arg2));

    return 0;
}
float work(float arg1, float arg2) {
    return arg1 * arg2;
}
float work(float arg1, float arg2) {
    return arg1 * arg2;
}
