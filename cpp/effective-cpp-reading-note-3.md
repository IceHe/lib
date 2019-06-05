# Effective C++ 3

> C++ Advanced - Note: complilation dependencies 编译依存关系降至最低；public->is-a 关系。Interface、Inheritance 接口与继承；绝不重新定义继承而来的 non-virtual 函数；has-a 关系；多重继承；Implict Interface、Polymorphism 隐式接口和编译期多态；typename；学习处理模板化基类内的名称。

- Created on 2014-05

## 条款31：将文件间的编译依存关系降至最低

minimize complilation dependencies between files.

该条款十分复杂，最好阅读原书。以下仅是部分摘录：

前置声明 class Date；
包含头文件 #include "date.h"

handle class和implementation class分开，
一个类只提供接口，另一个负责实现该借口（桥接模式）。
把对象实现细目隐藏于一个指针背后。
class Person{
     ...
private:
     std::tr1::shared_ptr<PersonImpl> pImpl; // 借口与实现的分离
};

分离的关键在于以“声明的依存性”，替换“定义的依存性”，
正是编译依存性最小化的本质——现实中让头文件尽可能自我满足：

- （1）如果使用object references或object ptr可以完成任务，就别使用objects。
    可以仅用类型的声明式，就可以定义该类型的renference或ptr；
    但是如果定义某个类型的objects，就需要用到该类型的定义式。
- （2）如果能够，尽量以class声明式替换class定义式。
- （3）为声明式和定义式提供不同的头文件。

```cpp
#include "datefwd.h" // 这个头文件内声明（但未定义）class Date
#include <iosfwd> // 类同上。
```

abstract base class抽象基类，称为interface class。
但C++的抽象类比java、.net的interface灵活，可以有成员变量或成员函数。

支持“编译依存性最小化”的一般构想是：相依于声明式，不要相依于定义式。
基于此构想的两个手段是Handle classes和Interface classes。

程序库头文件应该以“完全且仅有声明式”（full and declaration-only forms）
的形式存在。此做法无论是否涉及templates都适用。

## 条款32：确定你的public继承塑模出is-a关系

make sure public inheritance model is "is-a"

谨记，继承应该是一种is-a关系！

## 条款33：避免遮掩继承而来的名称

avoid hiding inherited names.

derived classes内的名称base classes内的名称。
在public继承下，从来没有人希望如此。

为了让被遮掩的名称在见天日，可用using声明式或转交函数（forwarding functions）。

using声明式：

```cpp
class Derived : public Base{
public:
     using Base::mf1; // 让Base class内名为mf1和mf3的所有东西
     using Base::mf3; // 在Derived作用于内都可见（并且public）
     virtual void mf1();
     void mf3();
     void mf4();
};
```

转交函数：

```cpp
class Derived : public Base{
public:
     virtual void mf1()｛
          Base::mf1();
     ｝
};
```

## 条款34：区分接口继承和实现继承

differenitiate between inheritance of interface and inheritance of implementation

1. 接口继承和实现继承不同。在public继承下，derived class总是继承base class的接口。
2. pure virtual 函数，只是为了让derived class只继承函数接口。
3. 简朴的（非纯）impure virtual函数，继承函数接口，以及省缺实现继承。
4. non-virtual函数，继承函数接口，以及强制性实现继承。

更好的virtual做法：

```cpp
class Airplane{
public:
     virtual void fly(const Airport& destination) = 0;
     ...
protected:
     void defaultFly(const Airport& destination);
}
void Airplane::defaultFly(const Airport& destination){
     // 真正的省缺实现放这里
}
```

继承时：

```cpp
class ModelA : public Airplane{
public:
     virtual void fly(const Airport& destination){
          defaultFly(destination); // 更加安全
     }
} // 避免有些飞机有着迥然不同的飞行方式，
// 而程序员偷懒或忘记，于是错误继承省缺实现，导致飞机失事！
```

## 条款35：考虑virtual函数意外的其他选择

consider alternatives to virtual functions.

1.藉由non-virtual interface手法实现Template手法
该流派的拥护者，主张virtual函数应该几乎总是private的。

```cpp
class GameCharacter{
public:
     int healthValue() const{
          ...// 可以做一些事前工作（该手法的优点）
          int retVal = doHealthValue();
          ...// 可以做一些事后工作（该手法的优点）
          return retVal;
     }
private:
     virtual int doHealthValue() const {...}
};
```

令客户通过public non-virtual成员函数间接调用private virtual函数，
称为“non-virtual interface(NVI)”手法，是Template Mothed设计模式的一个特殊表现形式。
（设计模式的Template Method和C++ templates并无关联！）

2.藉由function ptr 实现 Strategy模式

```cpp
class GameCharacter;
int defaultHealthCalc(const GameCharater& gc);
class GameCharacter{
public:
     typedef int (*HealthCalcFunc)(const GameCharater&);
     explicit GameCharater(HealthCalcFunc hcf = defaultHealthCalc)
          : healthFunc(hcf)
     {...}
     int healthValue() const{
          return healthFunc(*this);
     }
private:
     HealthCalcFunc healthFunc;
};
```

3.藉由tr1::function 实现 Strategy模式

```cpp
class GameCharacter;
int defaultHealthCalc(const GameCharater& gc);
class GameCharacter{
public:
     typedef std::tr1::fucntion<int (const GameCharater&)> HealthCalcFunc;
     explicit GameCharater(HealthCalcFunc hcf = defaultHealthCalc)
          : healthFunc(hcf)
     {...}
     int healthValue() const{
          return healthFunc(*this);
     }
private:
     HealthCalcFunc healthFunc;
};
```

还有衍生的酷用法（具体自查）

```cpp
short calcHealth(const GameCharacter&);
struct HealthCalculator{
     int operator() (const GameCharacter&) const
     {...}
};
class GameLevel{
public:
     float health(const GameCharacter&) const;
     ...
};

GameCharater(std::tr1::bind(&GameLevel::health,
     currentLevel, _1));
```

4.古典的Strategy模式

```cpp
class GameCharacter;
class HealthCalcFunc{
public:
      virtual int calc (const GameCharacter& gc) const
     {...}
     ...
};

HealthCalcFunc defaultHealthCalc;
class GameCharacter{
public:
     explicit GameCharater(HealthCalcFunc phcf = &defaultHealthCalc)
          : pHealthFunc(phcf)
     {...}
     int healthValue() const{
          return pHealthFunc->calc(*this);
     }
private:
     HealthCalcFunc *pHealthFunc;
};
```

## 条款36：绝不重新定义继承而来的non-virtual函数

never redefine an inherited non-virtual function.

non-virtual 函数是静态绑定的（dynamically bound），
virtual函数是动态绑定的（statically bound）。
所以virtual根据该对象的实际类型调用相应的函数，
而non-virtual则是根据指针类型去调用相应的函数的。

一个在基类内，声明为non-virtual的函数，它提供的特性
是为了该class建立起一个不变性（质），
凌驾其（继承它的子类的）特异性。
即是，适用于基类父类的该特性，同样适用于其所有子类对象。

不变性（invariant）；特异性（specialization）。

## 条款37：绝不重新定义继承而来的缺省参数值

never redefine a function's inherited default parameter value.

virtual函数是动态绑定（early binding前期绑定）的，
而缺省参数值却是静态绑定（late binding后期绑定）的！

子类virtual函数重新指定缺省值的话，是没有用的，
使用的缺省值还是基类的缺省值。

## 条款38：通过复合塑模出has-a或“根据某物实现出”

model "has-a" or "is-implemented-int-terms of" through composition.

composition复合，其同义词包括：
layering分层、containment内含、aggregation聚合，embedding内嵌。

## 条款39：明智而审慎低使用private继承

use private inheritance judiciously.

private继承意味着is-implemented-in-terms-of（根据某物实现出）。
它通常比符合（composition）的级别低。
但当derived class需要访问protected base class的成员
或需要重新定义继承而来的virtual函数时，这么设计是合理的。

和复合（composition）不同，private继承可以造成empty base最优化。
这对致力于尺寸最小化的程序库开发者而言，可能很重要。

## 条款40：明智而审慎低使用多重继承

use multiple inheritance judiciouly.

virtual继承，防止derived class有多个base classes对象。

```cpp
class File{...};
class InputFile : virtual public File{...};
class OutputFile : virtual public File{...};
clsss IOFile : public InputFile, public OutputFile{...};
```

但，virtual继承比non-virtual继承的兄弟们体积大，
访问virtual base classes的成员变量时，速度也变慢了。

1. 多重继承比单一继承复杂。它可能导致新的歧义性，以及对virtual继承的需要。
2. virtual极成灰增加大小、速度、初始化（及赋值）复杂度等等成本。
    如果virtual base classes不带有任何数据，将是最具实用价值的情况。
3. 多重继承的确有正当用途。
    其中一个情节设计“public继承某个Interface class”
    和“private继承某个协助实现的class”的两两组合。

## 条款41：了解隐式接口和编译期多态

understand implicit interfaces and compile-time polymorphism.

1. classes和interfaces都支持接口和多态。
2. 对classes而言接口是显式的（explicit），以函数签名为中心。
    多态则是通过virtual函数发生于运行期。
3. 对templates参数而言，接口是隐式的（implicit），奠基于有效表达式。
    多态是通过template具现化和函数重载解析（function overloading resolution）
    发生于编译期。

## 条款42：了解typename的双重意义

understand the two meanings of typename.

1. 声明template参数时，前缀关键字class和typename可互换。
2. 请使用关键字typename标识嵌套从属类型名称；
    但不得在base class lists（基类列）或member initialization list（成员初值列）
    内以它作为base class修饰符。

template<typename T>
void func(){
     typename T::const_iterator iter(container.begin());
     ... // 只是以防T类型中有一个static成员也叫const_iterator，
          // typename关键字就说清楚了，这指的是类型，而非其它！
}

## 条款43：学习处理模板化基类内的名称

know how to access names in templatized base classes.

```cpp
template<typename Company>
class LoggingMsgSender : public MsgSender<Company>{
public:
     void sendClearMsg(const MsgInfo& info){
          ...
          sendClear(info);
          ... // 虽然上一句是调用的是基类的函数，但是却无法通过编译！为什么呢？
     }
};
```

因为这是类模板的编程：
首先不知道Company是什么类型。
不到编译期，MsgSender<Company>就还不会生成具体的模板类，
那么该子类就不知道它的父类具体是什么样子的！

解决方法：

1.最好

```cpp
this->sendClear(info);
```

2.次之

```cpp
template<typename Company>
class LoggingMsgSender : public MsgSender<Company>{
public:
     using MsgSender<Company>::sendClear;
     void sendClearMsg(const MsgInfo& info){
          ...
          sendClear(info);
          ... // 虽然上一句是调用的是基类的函数，但是却无法通过编译！为什么呢？
     }
};
```

3.最差

```cpp
MsgSender<Company>::sendClear(info);
```

因为如果该函数是virtual的，它会关闭virtual的绑定行为。

可在derived class templates内通过“this->”指涉base class templates内的成员名称，
或藉由一个明白写出的“base class资格修饰符”完成。
