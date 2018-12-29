# Go

Reference

- Official Website : https://golang.org/

## Install

Reference

- macOS : http://sourabhbajaj.com/mac-setup/Go/README.html

Environment Variables

- Append commands below to `.bashrc`, `.zshrc` or else.
- Notice : Don't forget to change your path correctly!

```bash
## Go
export GOPATH=$HOME/go
export GOROOT=/usr/local/opt/go/libexec
export PATH=$PATH:$GOPATH/bin
export PATH=$PATH:$GOROOT/bin
### GOBIN must be an absolute path
export GOBIN=/Users/IceHe/go/bin
```

## Temporary Notes

当标识符（包括常量、变量、类型、函数名、结构字段等等）

- 以一个大写字母开头，如：Group1，那么使用这种形式的标识符的对象就可以被外部包的代码所使用（客户端程序需要先导入这个包）
    - 这被称为导出（像面向对象语言中的 public）
- 以小写字母开头，则对包外是不可见的
    - 但是他们在整个包的内部是可见并且可用的（像面向对象语言中的 protected ）

需要注意的是 `{` 不能单独放在一行

Keywords

- func
- select
- defer
- go
- map
- chan
- fallthrough
- range
- type
- var
- ……（其它跟 C 等编程语言差不多的关键字就不提了）

变量声明

```go
// declare
var age int
// assign
var age int = 26
// 自动判断类型
var age = 26
// 省略 var
// `:=` 左侧的变量不能被声明过
age := 26
```

多变量声明

```go
var var1, var2, var3 type
var1, var2, var3 = 1, 2, 3
// or
var var1, var2, var3 type = 1, 2, 3
// or
var1, var2, var3 := 1, 2, 3

// 这种因式分解关键字的写法一般用于声明全局变量
var (
    a int
    b bool
)
```

- bool

```go
var b bool = true
```

- 其它类型：TODO（bool，数据类型例如 int，派生类型 Map Chan…）

引用类型

```go
&i
```

值交换

```go
// 类型必须相同
a, b = b, a
```

常量

```go
var IDENTIFIER [type] = value
// e.g.
const STR string = "icehe"

// 另一种写法
const (
    A = "abc"
    B = len(a)
    C = unsafe.Sizeof(a)
)
```

- 特殊变量 iota：使用之后，每过一行，自动加一（详情另查）

指针变量

```go
&a // 获取变量的实际地址
*p // 是一个指针变量

// e.g.
// var a int = 4
a := 4
// var ptr *int = &a
ptr := &a
fmt.Printf("%d\n", *ptr)
```

case 语句

- swith 后面不需括号，甚至无需跟变量
- case 后面无需 break

```go
var grade string = "B"
var marks int = 90

switch marks {
    case 90: grade = "A"
    case 80: grade = "B"
    case 50,60,70 : grade = "C"
    default: grade = "D"
}

switch {
    case grade == "A" :
        fmt.Printf("优秀!\n" )
    case grade == "B", grade == "C" :
        fmt.Printf("良好\n" )
    case grade == "D" :
        fmt.Printf("及格\n" )
    case grade == "F":
        fmt.Printf("不及格\n" )
    default:
        fmt.Printf("差\n" );
}
fmt.Printf("你的等级是 %s\n", grade );
```

- Type Switch : 用于 type-switch 来判断某个 interface 变量中实际存储的变量类型

```go
var x interface{}

switch i := x.(type) {
    case nil:
        fmt.Printf(" x 的类型 :%T",i)
    case int:
        fmt.Printf("x 是 int 型")
    case float64:
        fmt.Printf("x 是 float64 型")
    case func(int) float64:
        fmt.Printf("x 是 func(int) 型")
    case bool, string:
        fmt.Printf("x 是 bool 或 string 型" )
    default:
        fmt.Printf("未知型")
}
```

select 语句（暂略）

- 跟 channel 有关

if 语句

- if 关键字后面的表达式不需要 `()` 包围

goto 语句

```go
var a int = 10

LOOP: for a < 20 {
    if a == 15 {
        /* 跳过迭代 */
        a = a + 1
        goto LOOP
    }
    fmt.Printf("a的值为 : %d\n", a)
    a++
}
```

for statement

```go
for init; condition; post { }
for condition { }
for { }

// e.g.
for true {
    fmt.Printf("这是无限循环。\n");
}

for key, value := range oldMap {
    newMap[key] = value
}

var i, j int
for i=2; i < 100; i++ {
    for j=2; j <= (i/j); j++ {
        if(i%j==0) {
        break // 如果发现因子，则不是素数
        }
    }
    if(j > (i/j)) {
        fmt.Printf("%d  是素数\n", i)
    }
}
```

函数定义

```go
func function_name( [parameter list] ) [return_types] {
   函数体
}
```

- 返回函数的函数

```go
func function_name func() [return_type] {
   /* 函数体 */
}

// e.g.
func add(x1, x2 int) func()(int,int)  {
    i := 0
    return func() (int,int){
        i++
        return i,x1+x2
    }
}

func add(x1, x2 int) func(x3 int,x4 int)(int,int,int)  {
    i := 0
    return func(x3 int,x4 int) (int,int,int) {
       i++
       return i,x1+x2,x3+x4
    }
}
```

- Closure Example

```go
package main

import "fmt"

func getSequence() func() int {
   i:=0
   return func() int {
      i+=1
     return i
   }
}

func main(){
   /* nextNumber 为一个函数，函数 i 为 0 */
   nextNumber := getSequence()

   /* 调用 nextNumber 函数，i 变量自增 1 并返回 */
   fmt.Println(nextNumber())
   fmt.Println(nextNumber())
   fmt.Println(nextNumber())

   /* 创建新的函数 nextNumber1，并查看结果 */
   nextNumber1 := getSequence()
   fmt.Println(nextNumber1())
   fmt.Println(nextNumber1())
}
```

```bash
$ go run <code>.go
1
2
3
1
2
```

传引用，指针操作

```go
// …
func main() {
   var a int = 100
   var b int= 200

   fmt.Printf("交换前，a 的值 : %d\n", a )
   fmt.Printf("交换前，b 的值 : %d\n", b )

   /* 调用 swap() 函数
    * &a 指向 a 指针，a 变量的地址
    * &b 指向 b 指针，b 变量的地址
    */
   swap(&a, &b)

   fmt.Printf("交换后，a 的值 : %d\n", a )
   fmt.Printf("交换后，b 的值 : %d\n", b )
}

func swap(x *int, y *int) {
   var temp int
   temp = *x    /* 保存 x 地址上的值 */
   *x = *y      /* 将 y 值赋给 x */
   *y = temp    /* 将 temp 值赋给 y */
}
```

声明一个属于某类的方法

```go
package main

import (
   "fmt"
)

/* 定义结构体 */
type Circle struct {
  radius float64
}

func main() {
  var c1 Circle
  c1.radius = 10.00
  fmt.Println("圆的面积 = ", c1.getArea())
}

//该 method 属于 Circle 类型对象中的方法
func (c Circle) getArea() float64 {
  //c.radius 即为 Circle 类型对象中的属性
  return 3.14 * c.radius * c.radius
}
```

声明数组

```go
var variable_name [SIZE] variable_type

// e.g.
// declare
var balance [10] float32
// define
var balance = [5]float32{1000.0, 2.0, 3.4, 7.0, 50.0}
// define : ignore array length
var balance = [...]float32{1000.0, 2.0, 3.4, 7.0, 50.0}
```

- 二维数组

```go
a = [3][4]int{
  {0, 1, 2, 3} ,   /* 第一行索引为 0 */
  {4, 5, 6, 7} ,   /* 第二行索引为 1 */
  {8, 9, 10, 11},  /* 第三行索引为 2 */
}
// 注意：以上代码中倒数第二行的 } 必须要有逗号，因为最后一行的 } 不能单独一行，也可以写成这样：
a = [3][4]int{
  {0, 1, 2, 3} ,   /* 第一行索引为 0 */
  {4, 5, 6, 7} ,   /* 第二行索引为 1 */
  {8, 9, 10, 11}}  /* 第三行索引为 2 */
```

传递数组给函数

- 实例中函数接收整型数组参数，另一个参数指定了数组元素的个数，并返回平均值

```go
func getAverage(arr []int, size int) float32
{
   var i int
   var avg, sum float32

   for i = 0; i < size; ++i {
      sum += arr[i]
   }

   avg = sum / size

   return avg;
}
```

声明指针

```go
var var_name *var_type

// e.g.
var ip *int        /* 指向整型 */
var fp *float32    /* 指向浮点型 */
```

- 空指针判断

```go
if (ptr == nil) // 空指针
if (ptr != nil) // 非空
```

- 指针数组

```go
var ptr [10]*int;
```

- 指向指针的指针

```go
var a int
var ptr *int
var pptr **int

a = 3000

/* 指针 ptr 地址 */
ptr = &a

/* 指向指针 ptr 地址 */
pptr = &ptr

/* 获取 pptr 的值 */
fmt.Printf("变量 a = %d\n", a )
fmt.Printf("指针变量 *ptr = %d\n", *ptr )
fmt.Printf("指向指针的指针变量 **pptr = %d\n", **pptr)
```

定义结构体

```go
package main
import "fmt"

type Book struct {
   title string
   author string
   subject string
   book_id int
}

func main() {
    // 创建一个新的结构体
    fmt.Println(Books{"Go 语言", "www.runoob.com", "Go 语言教程", 6495407})

    // 也可以使用 key => value 格式
    fmt.Println(Books{title: "Go 语言", author: "www.runoob.com", subject: "Go 语言教程", book_id: 6495407})

    // 忽略的字段为 0 或 空
   fmt.Println(Books{title: "Go 语言", author: "www.runoob.com"})
}
```

- 输出

```bash
{Go 语言 www.runoob.com Go 语言教程 6495407}
{Go 语言 www.runoob.com Go 语言教程 6495407}
{Go 语言 www.runoob.com  0}
```

切片 Slice

- Go 数组的长度不可改变，在特定场景中这样的集合就不太适用
- Go 中提供了一种灵活，功能强悍的内置类型切片("动态数组")，与数组相比切片的长度是不固定的
- 可以追加元素，在追加时可能使切片的容量增大。

```go
// 声明一个未指定大小的数组来定义切片
var identifier []type
// e.g.
slice1 := make([]type, len)

// 也可以指定容量，其中 capacity 为可选参数
make([]T, length, capacity)
// e.g.
s := make([]int, 3, 5)
```

- 普通初始化

```go
s := [] int {1,2,3}
```

- 纯引用

```go
s := arr[:]
```

- 范围切片

```go
s := arr[startIndex:endIndex]
s := arr[startIndex:]
s := arr[:endIndex]
```

类型转换

```go
type_name(expression)
// e.g.
var sum int = 17
var count int = 5
var mean float32
mean = float32(sum)/float32(count)
```
