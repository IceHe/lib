# Effective C++ 1

> C++ Advanced - Note: const、enum、inline；先初始化再使用变量；smart pointer 智能指针；virtual 虚函数；Destructor 析构函数；self-assignment 自赋值；new 和 delete；若不想使用编译器自动生成的函数，就该明确拒绝。

* Created on 2014-05

## 基础名词解释

* STL : Standard Template Library
* TR1 : 一份RFC的规范，描述加入C++标准程序库的诸多新机能。
* Boost : 一个网站，一个开源的C++程序库。大多数TR1的机能以它的工作为基础

## 条款2：尽量以const，enum，inline代替\#define

perfer consts, enums, and inlines to \#defines.

宏语言定义的变量名，如 \#define ASPECT\_RATIO 1.653中的ASPECT\_RATIO，不会进入 symbol table，对于编译器不可见。

* Extension：符号表，一种用于语言翻译器（例如编译器和解释器）中的数据结构。
* 在符号表中，程序源代码中的每个标识符都和它的声明或使用信息绑定在一起，比如其数据类型、作用域以及内存地址。
* 如常数表、变量名表、数组名表、过程名表、标号表等等，统称为符号表。

enum hack

* 在类内，声明 enum｛OneConstNum = 5｝
* 用以声明一个常数。而且取enum量的地址，但对const常量可取地址。

## 条款3：尽量使用const

use const whenever possible

基础：

```cpp
char str[] = "test";
char *p = str;               // non-const ptr, non-const data
const char *p = str;      // non-const ptr, const data
char * const p = str;     // const ptr, non-const data
const char * const p = str; // const ptr, const data
char const *p = str;     // the same as "const char *p = str;"
```

迭代器：（注意，与前面常识有悖）

```cpp
std::vector<int> vec;
...
const std::vector<int>::iterator iter = vec.begin();     // iter的作用像个 T* const
*iter = 10;     // 没错，改变的只是它所指向的内容
++iter;          // 出错，iter本身是const
...
std::vector<int>::const_iterator cIter = vec.begin();     // cIter的作用像个 const T*
*iter = 11;     // 出错，*cIter是const
++iter;          // 没错，改变cIter
```

常函数const不能改变任何成员变量，static变量除外。

当const和non-const成员函数有着实质等价的实现时， 令non-const版本调用const版本可避免代码重复。

## 条款4：确定对象使用前已先被初始化

make sure that objects are initialized before they're used.

赋值和初始化不同：

* 用初始化列表来初始化自定义类型，而且效率更高
* 如果初始化的是built-in类型，则效率与赋值一样;
* 在构造函数内是赋值。

```cpp
OneClass::OneClass()
     :theName(),
      theAddress(),
      thePhones(),
      num(0)
{...}
```

* 假如一个自定义类型的成员变量，还可以这样使用nothing"\(\)"，去调用其default constructor。
* 成员变量初始化顺序：其类内声明的顺序，不关于初始化列表的顺序。
* 所以，初始化列表的顺序最好和其类内声明顺序一样。

编译单元

* 产生单一目标文件（single object file）的那些源码
* 单一源码文件加上其所include的头文件。

local static对象：

* 函数内的static对象

不同的编译单元内的non-local static对象的初始化顺序无明确定义。

* 解决方法：用local static 代替non-local static，即是使用Singleton单例模式。

## 条款5：C++默默编写并调用哪些函数

know what functions C++ silently writes and calls.

* 默认构造函数
* 复制构造函数
* 析构函数
* 赋值操作符

编译器产生的析构函数是non-virtual的。

编译器产生的copy构造函数和copy assignment操作符的版本，只是将non-static成员变量拷贝至目标对象而已。

如果你有声明了一个构造函数（无论有无参数），编译器便不会给你创建default的的构造函数了。

若base class的copy assignment操作符被声明为private，那么编译器会拒绝为其derived class生成一个copy assignment操作符。

## 条款6：若不想使用编译器自动生成的函数，就该明确拒绝

* 使用private声明它们，且不给出具体的定义。
* 当客户企图拷贝时，编译器会阻止你；
* 假如是友元或者成员函数试图拷贝的话，
* 因为它们没有具体定义，linker链接器就会组织它们。

可以定义这样一个基类

```cpp
class Uncopyable{
protected:
     Uncopyable(){}
     ~Uncopyable(){}
private:
     Uncopyable(const Uncopyable&);
     Uncopyable& operator=(const Uncopyable&);
}

class DerivedClass: private Uncopyable{
     ...
};
```

这样，帮助重用，而且其子类就都不能调用复制构造函数和复制赋值操作符了。

## 条款7：为多态基类声明virtual析构函数

declare destructors virtual in polymorphic base classes.

一个基类指针指向子类对象， 当这个对象析构的时候，如果基类destructor非virtual， 那么只会调用基类的destructor，而子类的则没有被调用， 导致部分销毁对象，内存泄漏。

基类有virtual函数，其子类就必须有相关的函数实现，即使其不重写。

如果一个class不打算成为基类，就不要声明virtual函数。

要实现virtual函数，必须携带vptr（virtual table pointer）虚函数表指针 vptr指向一个有函数指针组成的数组，成为vtbl（virtual table）虚函数表。 每一个带虚函数的class都带有一个相应的virtual table。

当调用虚函数，取决于该对象的vptr虚函数指针所指的virtual table虚函数表， 编译器在其中寻找适当的函数指针。

而且这个虚指针增加了对象的大小，32位系统增加一个4Bytes的vptr，64位则增加8Bytes。 所以类内至少有一个virtual函数，才去声明虚的destructor。

尽量不要集成STL中不含有virtual函数的容器。

总结

* 带有polymorphic多态性质的base classes应该声明virtual destructor。
* 或它带有任何virtual函数，它就该有虚析构函数。
* 若一个class不作为base class使用，或不是为了多态，就别声明虚析构函数。

## 条款8：别让异常逃离析构函数

prevent exceptions from leaving destructors.

析构函数绝对不要吐出异常。 如果一个被析构函数调用的函数可能抛出异常，析构函数应该捕捉任何异常， 然后吞下它们（不传播）或结束程序。

如果客户需要对某个操作函数运行期间抛出的异常作出反应， 那么class应该提供一个普通函数（而非在析构函数中）执行该操作。

C++不欢迎在析构函数中抛出异常。

## 条款9：绝不在构造和析构过程中调用virtual函数

never call virtual function during construction or destruction

在子类的构造函数运行时，子类自身类型被解析为基类， 调用的virtual函数是基类的，而不是子类的； 析构函数一样，子类自身类型被解析为基类……

解决方法： 最好将初始化代码，另外放在一个init初始化函数内。

## 条款10：令 operator= 返回一个reference to \*this

have assignment operators return a reference to \*this.

```cpp
x = y = z;//连锁赋值
```

为了实现连锁赋值，赋值操作符必须返回一个reference指向操作符的左侧实参。

## 条款11：在operator=中处理“自我赋值”

handle assignment to self in operator=.

赋值操作一般会先释放掉左值，再给左值赋值， 假如左值右值是同一个对象，会导致“在停止使用资源之前意外释放了它”！ 所以

```cpp
Widget& Widget::operator=(const Widget &rhs){
     if(this == &rhs) return *this; // 证同测试 identity test
     ...
}
```

还有其它方法的！

确保对象自我赋值时operator=有良好的行为。 有关技术包括：1.证同测试；2.copy-and-swap；3.精心周到的语句顺序。

2.copy-and-swap；

```cpp
Widget tmp(rhs);
swap(temp); // 交换*this和rhs的数据
return *this;
```

3.精心周到的语句顺序。

```cpp
Bitmap *pOrig = pb;
this.pb = new Bitmap(*rhs.pd); // 先创建复本
delete pOrig; // 再delete原本
return *this;
```

## 条款12：复制对象时勿忘其每一个成分

copy all parts of an object

copying函数应该确保复制“对象内的所有成员变量”及“所有base class成分”。

```cpp
PriorityCustomer::PriorityCustomer（const PriorityCustomer& rhs)
     : Customer(rhs),
      priority(rhs.priority){
     ...
}

PriorityCustomer& PriorityCustomer::operator=(const PriorityCustomer& rhs){
     Customer::operator=(rhs);
     priority = rhs.priority; // 其它成员变量的赋值
     return *this;
}
```

## 条款13：以对象管理资源

use objects to manage resources.

```cpp
Investment *pInv = createInvestment();
... // 中间的代码可能抛出异常，可能return，
     // 导致最后无法运行到delete那一行，内存泄漏
delete pInv;
```

可以把资源放到对象里面，利用析构函数自动调用的机制，确保资源释放的问题。 例如智能指针shared\_ptr、unique\_ptr。

```cpp
std::auto_ptr<Investment> pInv(createInvestment());
```

关键：

1. 获得资源后立即放进管理对象内。这个观念被称为“资源取得时机便是初始化时机”。

    （Resource Acquisition Is Initialization——RAII）

   2.管理对象运用析构函数确保资源被释放。

    若资源释放动作可能导致抛出异常，看条款8怎么处理。（另外使用一个普通函数进行该操作）

auto\_ptr和tr1::shared\_ptr、unique\_ptr等都在其析构函数内做delete而不是delete\[\]， 意味着别将动态分配的array数组交给智能指针！会内存泄漏。

C++并没有特别针对“动态分配数组”而设计类似的智能指针， vector、string可以取代动态分配而得的数组。 boost::scored\_array和boost::shared\_array classes，就提供了以上你想要的内容， 可是还没有采纳入C++标准库中。

## 条款14：在资源管理类中小心copying行为

think carefully about copying behaviour in resource-managing classes.

RAII对象被复制，应该怎么处理，有两种方式：

1. 禁止复制。因为这样并不合理。
2. 使用类似于shared\_ptr的引用计数（reference-count）。

而且要注意：

1. 深拷贝底部资源
2. 或者转移底部资源的拥有权，如unique\_ptr

## 条款15：在资源管理类中提供对原始资源的访问

provide access to raw resource in resource-managing classes.

1. APIs往往要求访问原始资源raw resources，所以每个RAII class应该提供一个get\(\)方法，
2. 对原始资源的访问可能经由显式转换或隐式转换。

一般隐式转换较方便，显式转换较安全。

```cpp
class Font(){
     ...
     FontHandle f; // 原始资源
     operator FontHandle() const // 隐式转换
     { return f; }
}
```

## 条款16：成对使用new和delete时要采用相同形式

use the same form in corresponding uses of new and delete.

避免 `typedef std::string AddressLines[4]; // 忘了typedef的用法自己查查！`

因为当你 `std::string* pal = new AddressLines;`

别人不知道该用 `delete pal;` 还是 `delete[] pal;`（这个才正确）。

new时，使用了\[\]，必须在相应的delete表达式中也试用\[\]。

## 条款17：以独立语句将newed对象置入智能指针

store newed objects in smart pointers in standalone statments.

以独立语句将new出的对象储存于（置入）智能指针内。 如果不这样做，一旦有一场被抛出，有可能导致难以察觉的资源泄漏。

processWidget\(std::tr1::shared\_ptr\(new Widget\), priority\(\)\); 不同编译器以何种顺序执行：

* A. new Widget
* B. tr1::shared\_ptr的构造函数
* C. 调用priority\(\)

假如以ACB顺序执行，“调用priority\(\)”时可能抛出异常， 导致new出的Widget没有及时放入智能指针， 还是导致内存泄漏了……

所以分开写成这样： std::tr1::shared\_ptr pw\(new Widget\); processWidget\(pw, priority\(\)\);

## 条款18：让借口容易被正确被使用，不易被误用

make interface easy to use correctly and hard to use incorrectly.

函数调用的时候，参数的顺序可能出错，所以可以通过导入相应的类型预防。 如：

```cpp
Date(const Month& m, const Day& d);
// 而非直接用int指代月份和日，还可以用enum
Investment* createInvestment();
// 这样要求用户记得delete，而且不超过1次
```

不能将责任推给智能指针，因为用户还是可能忘记使用。所以

```cpp
std::tr1::shared_ptr<Investment> createInvestment();
```

强行返回智能指针，先发制人，要求客户使用智能指针。

智能指针可以指定删除器，而非总是使用delete。 std::tr1::shared\_ptr pInv\(0, getRidOfInvestment\); getRidOfInvestment是作为删除器的函数名（函数指针）。 上例并不够好，0只是个int，而非空指针，而智能指针坚持要一个指针，所以

```cpp
std::tr1::shared_ptr<Investment> pInv(static_cast<Investment*>(0), getRidOfInvestment);
```

阻止误用的办法：建立新类型、限制类型上的操作，束缚对象值，以及消除客户的资源管理责任。 tr1：：shared\_ptr支持定制删除器 \(custom deleter\)。 可以防范DLL问题，可被用来自动解除互斥锁（见条款14，原书）。

