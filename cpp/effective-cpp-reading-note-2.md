# Effective C++ 2

> C++ Advanced - Note: class 类；宁以 pass-by-reference-to-const 替换 pass-by-value；错误返回 reference；private 私有；宁以 non-member、non-friend 替换 member 函数；类型转换；不抛出异常的 swap 函数；尽可能延后变量定义式的出现时间；minimize casting 尽量少做转型操作。

- Created on 2014-05

## 条款19：设计class犹如设计type

treat class design as type design.

注意：

1. 新type的对戏那个如何被创建和销毁：
    以及构造、析构函数，内存分配和释放函数。
2. 对象的初始化和对象的赋值有什么区别。
3. 新type对象如果被以值传递，意味着什么？
4. 什么是新type的合法值？
5. 你的新type需要配合某个继承图系吗？(inheritance graph)
6. 你的新type需要什么样的类型转换？
7. 什么样的操作符和函数对此新type是合理的？
8. 什么样的标准函数应该驳回？（注意必须声明为private者）
9. 谁该取用新type的成员？决定哪些是private/public/protected/friend 等。
10. 什么是新type的未声明接口（undeclared interface）？
11. 你的新type有多么一般化？考虑它成为一个类模版。class template

## 条款20：宁以pass-by-reference-to-const替换pass-by-value

perfer pass-by-reference-to-const to pass-by-value.

缺省情况下C++以by value方式传递对象至函数，
函数参数就是实际实参的复本，由对象的copy构造函数提供。

pass-by-reference-to-const效率更高，减少了复本对象及其成员对象的构造和析构。

而且还可以避免slicing（对象切割）的问题。

当一个derived class对象以by-value方式传递并被视为base class对象，
base class的copy构造函数会被调用，导致derived class对象的那些特化兴致被切割掉了，
只剩下一个base class对象。

一般而言，可以合理假设：内置对象和STL的迭代器和函数对象，可以pass-by-value！

## 条款21：必须返回对象时，别妄想返回其reference

don't try to return a reference when you must return an object.

任何函数如果返回一个reference或pointer指向某个local对象，都会一败涂地！

```cpp
TestObj& retLocalObj2(){
                 TestObj a(2);
                 return a;
}

TestObj& retLocalObj3(){
                 TestObj *a = new TestObj(3);
                 return *a;
}

TestObj* retLocalObj4(){
                 TestObj *a = new TestObj(4);
                 return a;
}
```

- 以上第一个例中，local object建立在栈上，返回时local object已会被释放。
- 第二、三个例中，local object建立在堆上，返回的local object不会被释放，

但是，之后谁能对这些临时的对象释放，delete？例如：

```cpp
w = retLocalObj2() * retLocalObj3() * retLocalObj4();
```

明显没有机会释放中间变量，导致内存泄漏。

正确做法：
必须返回新对象，就让那个函数直接返回一个新对象

```cpp
inline const Rational operator*(const Rational& lhs, const Rational& rhs){
     return Rational(lhs.n * rhs.n, lhs.d * rhs.d);
}
```

必须承受由此带来的构造、析构成本。

- 绝不要返回pointer和reference指向一个local stack对象，
- 或返回reference指向一个heap-allocated对象，
- 或返回pointer或reference指向一个local static对象而有可能同时需要多个这样的对象。

## 条款22：将成员变量声明为private

declare data members private

切记将成员变量声明为private。这可赋予客户访问数据的一致性、
可细微划分放哪高温控制、允诺约束条件获得保证，
并提供class作者以充分的实现弹性和日后的修改空间。
protected并不比public更具有封装性，
private可以使其成员变量，对其derived class更有封装性。

## 条款23：宁以non-member、non-friend替换member函数

prefer non-member non-friend functions to member function

```cpp
class WebBrowser{
public:
     void clearCache();
     void clearHistory();
     void removeCookie();
     // void clearEverything(); // 使用这个成员函数调用前三个函数不够好
     ...
}
void clearBrowser(){
     wb.clearCache();
     wb...
} // 这样更好，有更好的封装性、包裹弹性(packaging flexible)和机能扩充性。
```

为什么呢？
因为，在类内，越少的代码能够做同一件事，封装性越好
clearEverything()也做到了clearCache()...等的函数的工作。

在所有函数必须定义在类内的语言来说，
可以另外定义一个WebBrowser的工具类utility class，
在其中定义一个static member函数完成相关功能。

## 条款24：若所有参数皆需要类型转换，请为此采用non-member函数

declare non-member functions when type conversions should apply to all parameters.

```cpp
class Rational{
public:
     ...
     const Rational operator*(const Rational* rhs) const;
}
result = oneHalf * 2; // 正确
result = 2 * oneHalf; // 错误！int 2 无法隐式转换为Rational类型
```

将operator*在类外定义即可：

```cpp
const Rational operator*(const Rational* lhs, const Rational* rhs){...}
```

之前出错的语句也可以正常运行了！

其实可以将它定义为class Rational的friend函数，但是应该尽量避免，原因未详述。

如果你需要为某个函数的所有参数（包括被this指针所指的那个隐喻参数）
进行类型转换，那么这个函数必须是个non-member。

## 条款25：考虑写出一个不抛出异常的swap函数

consider support for a non-throwing swap.

1. 当std::swap对你的类型效率不高时，提供一个swap成员函数，并确定这个函数不抛出异常；
2. 如果你提供一个member swap，也该提供一个non-member swap用来调用前者。
    对于 classes（而非templates），也请特化std::swap。
3. 调用swap时应针对std::swap使用using声明式，然后调用swap，
    并且不带有任何“命名空间资格修饰”。
4. 为“用户定义类型”进行std templates全特化是最好的，
    但千万不要尝试在std内加入某些对std而言全新的东西。

```cpp
namespace std{
     template<typename T> // std::swap的典型实现；
     void swap(T& a, T& b){
          T temp(a); // 只要T类型支持copying构造函数和copy assignment操作符即可
          a = b;
          b = temp;
     }
}
```

但是有些用户定义类型，复制的动作并非总有必要。因为，
主要情况是，有些成员变量只是指针，指向一个对象，内含真正数据，
（这种设计的常见表现形式是所谓的pimpl手法——pointer to implementation）
两个对象只需要交换这个指针值即可。
所以，可以针对这个用户定义类型，让std::swap进行特化：

```cpp
namespace std{
     template<>     // 这是std::swap针对T是Widget的特化版本
     void swap<Widget>(Widget& a, Widget& b){
          swap(a.pImpl, b.pImpl);
     }
} // 但无法通过编译，因为pImpl是private成员。
```

真正解决方法：

```cpp
class Widget{
public:
     void swap(Widget& other){
          using std::swap; // 令std::swap在此函数内可用
          swap(pImpl, other.pImpl); // 编译器根据实际情况，
               // 调用T专属的版本，或者std中一般化（泛化）的版本
     }
}
namespace std{
     template<>
     void swap<Widget>(Widget& a, Widget& b){
          a.swap(b);
     }
}
```

劝告：成员版swap绝不可抛出异常。

## 条款26：尽可能延后变量定义式的出现时间

postpone variable definitions as long as possible.

1. 当一个变量需要使用时，才去声明它。
2. 为了提高效率，构造时就初始化好它！例：

```cpp
std::string encryted; // 先使用default构造函数
encrypted = password; // 再用赋值操作符……
```

不如

```cpp
std::string encryted(password); // 使用copy构造函数初始化了
```

循环时怎么办？

```cpp
Widget w;
for(...){
     w = xxx;
}
```

还是

```cpp
for(...){
     Widget w = xxx;
}
```

前者效率高一点，但是w作用域扩大，可理解性和易维护性变差！

只有两种情况才使用前者的做法：

- （1）知道赋值比“构造+析构”的成本低
- （2）你正在处理代码中效率高度敏感的部分（performance-sensitive）

## 条款27：尽量少做转型操作

minimize casting

```cpp
(T)expr; // 两种旧式转型
T(expr);

const_cast<T>(expr); // 将对象的常量性去除（cast away the constness）

dynamic_cast<T>(expr); // 安全向下转型（safe downcasting）
          // 决定某对象是否归属继承体系中的某个类型（之后细谈）
          // 唯一无法由旧式语法执行的动作

static_cast<T>(expr); // 强迫隐式转换（implicit conversions）
          // 将non-const转换为const，反向操作不能，只能用const_cast
          // 或将int转成double，或相反
          // 将void*转成type*
          // 将ptr-to-base转为ptr-to-derived

reinterpret_cast<T>(expr); // 企图进行低级转型，实际动作和结果取决于编译器
          // 所以它不可移植。将一个long或int转成指针都可以。
```

新式转型比旧式：

- （1）更加容易辨认，易读
- （2）转型动作的目标窄化，编译器容易判断出错误

1. 尽量避免转型，在注重效率的代码中，避免dynamic_cast，
    最好试着发展无须转型的替代设计。
2. 如转型是必要的，试着将它隐藏于某个函数背后。
    客户可以调用该函数，使其不用将转型过程置于其代码中。
3. 宁可使用新式转型语法，不要使用旧式转型。清晰。

## 条款28：避免返回handles指向对象内部成分

avoid returning "handles" to object internals.

避免返回handles（包括references、ptr、iterator迭代器）指向对象内部，
保证封装性，帮助const成员函数的行为像个const，
并将“虚吊号码牌”（dangling handles）的可能性降至最低。
（虚吊号码牌，即是野指针，对象已被销毁，但是指向这个地方的指针还在）

## 条款29：为“异常安全”而努力是值得的

strive for exception-safe code.

exception-safe 异常安全 的两个条件：
当异常抛出时，
（1）不泄露任何资源。
不会代码的出错中断，导致没有delete或者释放掉资源、互斥锁等。
（2）不允许数据败坏。
因为new失败，可能导致一个指针成为野指针。
内部的变量、状态，非原子性，不一致。

异常安全函数——提供以下三个保证之一：

- （1）基本承诺。
    若异常被抛出，程序内的任何事物仍然保持在有效状态下。
- （2）强烈保证。
    若一场抛出，程序状态不改变。（即是变化都是原子性的。）
    要不是成功执行的状态，要不处于函数调用前的状态。
- （3）不抛掷（throw）保证。
    绝不抛出异常。总是能够完成承诺的功能。

条款29给了我很大震动，这个条款很长，还是从原书重读较好。

因为没有想到，这个代码的严谨性超过了我以前的想象！
以下给出最好的那个代码版本：

```cpp
struct PMImpl{
     std::tr1::shared_ptr<Image> bgImage;
     int imageChanges;
}; // 为了swap-and-copy而设计的（之前的条款有说）
class PrettyMenu{
     ...
private:
     Mutex mutex; // 互斥量
     std::tr1::shared_ptr<PMImpl> pImpl; // 为了swap-and-copy而设计的
};
void PrettyMenu::changeBackground(std::istream& imgSrc){
     using std::swap;
     Lock ml(&mutex);
     std::tr1::shared_ptr<PMImpl> pNew(new PMImpl(*pImpl));
     pNew->bgImge.reset(new Image(imgSrc));
     ++pNew->imageChanges;
     swap(pImpl, pNew);
}
```

“强烈保证”往往能够以copy-and-swap实现出来，
但强烈保证并非对所有函数都可实现或具有现实意义。

## 条款30：透彻了解inlining的里里外外

understand the ins and outs of inlining

在class声明处，就定义函数过程的，都会隐喻为inline。

virtual函数不能够被inline。
千万别将构造和析构函数inline！

调试器，无法对inline函数设置断点。

将大多数inlining限制在小型、被频繁调用的函数身上。
这可使日后的调试过程和二进制升级（binaryupgradability）更容易，
也可使潜在的代码膨胀问题最小化，使程序速度提升的机会最大化。

不要只因为function template出现在头文件，就将它们声明为inline。
