# Number

## Generate Random Numbers

Reference

- How to generate random numbers in Java : https://www.educative.io/edpresso/how-to-generate-random-numbers-in-java

### Random

Test

```java
package xyz.icehe.test;

import java.util.Arrays;
import java.util.Random;

public class RandomTest {

    public static int[] getTenRandomIntegers(int upperBoundExclusive) {
        int[] ints = new int[10];
        for (int i = 0; i < ints.length; i++) {
            ints[i] = new Random().nextInt(upperBoundExclusive);
        }
        return ints;
    }

    public static void main(String[] args) {
        int[] tenRandomIntegers = getTenRandomIntegers(25);
        System.out.println(Arrays.toString(tenRandomIntegers));

        Random random = new Random();
        int upperBoundExclusive = 100;
        int randomInt = random.nextInt(upperBoundExclusive);
        float randomFloat = random.nextFloat();
        double randomDouble = random.nextDouble();

        System.out.println("Random integer value from 0 to " + (upperBoundExclusive - 1) + " : " + randomInt);
        System.out.println("Random float value between 0.0 and 1.0 : " + randomFloat);
        System.out.println("Random double value between 0.0 and 1.0 : " + randomDouble);
    }
}
```

Output

```bash
[4, 19, 22, 14, 0, 13, 16, 16, 3, 8]
Random integer value from 0 to 99 : 80
Random float value between 0.0 and 1.0 : 0.18610674
Random double value between 0.0 and 1.0 : 0.24132468608975155
```

### Math.random

Test

```java
package xyz.icehe.test;

public class MathRandomTest {
    public static void main(String[] args) {
        System.out.println("Random value in double from Math.random() :");
        System.out.println(Math.random());

        int min = 50;
        int max = 100;

        // Generate random double value from 50 to 100
        System.out.println("Random value in double from " + min + " to " + max + ":");
        double random_double = Math.random() * (max - min + 1) + min;
        System.out.println(random_double);

        // Generate random int value from 50 to 100
        System.out.println("Random value in int from " + min + " to " + max + ":");
        int random_int = (int)(Math.random() * (max - min + 1) + min);
        System.out.println(random_int);
    }
}
```

Output

```bash
Random value in double from Math.random() :
0.21037212499838986
Random value in double from 50 to 100:
86.11639990319368
Random value in int from 50 to 100:
77
```

### ThreadLocalRandom

- How do I generate random integers within a specific range in Java? : https://stackoverflow.com/questions/363681/how-do-i-generate-random-integers-within-a-specific-range-in-java

```java
import java.util.concurrent.ThreadLocalRandom;

// nextInt is normally exclusive of the top value,
// so add 1 to make it inclusive
int randomNum = ThreadLocalRandom.current().nextInt(min, max + 1);
```

Test

```java
package xyz.icehe.test;

public class MathRandomTest {
    public static void main(String[] args) {
        // Generate random integer
        int randomInt = ThreadLocalRandom.current().nextInt();
        System.out.println("Random Integer: " + randomInt);

        // Generate Random double
        double randomDouble = ThreadLocalRandom.current().nextDouble();
        System.out.println("Random Double: " + randomDouble);

        // Generate random boolean
        boolean randBoolean = ThreadLocalRandom.current().nextBoolean();
        System.out.println("Random Boolean: " + randBoolean);
    }
}
```

Output

```java
Random Integer: 523210178
Random Double: 0.09568394748594111
Random Boolean: true
```
