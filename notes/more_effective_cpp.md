title: More effective C++
---

条款1：仔细区别pointers和references
distinguish between pointers and references.

references引用必须总是代表一个对象，必须在声明时初始化。
pointer就有可能不指向（代表）任何对象。

当你知道你需要指向某个东西，而且绝不会改变指向其他东西，
或是你实现一个操作符，而其语法需求无法由pointer达成，就该选择references。
否则采用pointers。


条款2：最好使用C++转型操作符
prefer C++-style casts.

const_cast：用来去除表达式中的常量性constness或变易性volatileness。旧式转换做不到。

dynamic_cast：用来执行继承体系中“安全的向下转型或跨系转型动作”。
无法应用在缺乏虚函数的类型身上（条款24）。

static_cast：不涉及继承机制的类型执行转型。

reinterpret _cast：此操作符的转换结果几乎总是与编译平台息息相关，所以它不具有移植性。

向下转型：父类对象指向子类。
向上转型：将子类对象转为父类对象。


条款3：绝对不要以多态（polymorphically）方式处理数组
nver treat arrays polymorphically.

C++也允许通过base class 的 pointers 和 references 来操作 derived class objects 所形成的数组。

derived classes通常比base classes有更多的data members，所以其object比基类的大。
当你声明base class 的 array，编译器按照 i * sizeof(base class object) 来分配内存，或按照这个大小来处理它。
当void func(const BaseClass ary[])函数传入的参数是DerivedClass ary[] 时，处理的结果就无法预期了。

delete [] ary 时，调用的是ary的声明类型对应的析构函数，而非调用其实际类型的析构函数。
因为C++语言规范中说，通过base class pointer去删除一个由derived classes objects组成的数组，其结果未定义！

绝对不要以多态（polymorphically）方式处理数组，会产生你意想不到的结果！


条款4：非必要不提供default constructor
avoid gratuitous default constructors.

它意味着在没有外来信息的情况下初始化对象，有时这样的对象是没有意义的！
所以别提供default constructor了，
因为这还影响classes的效率，让调用者测试其行为而付出空间代价（程序库和执行文件变大）。

不提供default constructor的问题：
（1）初始化数组
OneClass *p = new OneClass[c]; // 错误！无法调用默认构造函数
可以这样解决
OneClass p[] = {
     OneClass(param1),
     OneClass(param2),
     ...
};
但只用于non-heap数组，无法用于heap数组。

所以，更一般化的解决方法是使用“指针数组”，而非“对象数组”。
OneClass *ary[10];
for(...){ // 然后这样初始化
     ary[i] = new OneClass(param);
}
但必须记得：
a. 删除数组的所有对象，否则内存泄漏；
b. 需要存放指针，有结构开销，内存消耗大一些。

避免以上b点关于“用太多内存”的问题，可以避免：
先为该数组分配raw memory，然后使用placement new在这块内存上构造OneClass objects。
void *rawMemory = operator new[](10 * sizeof(OneClass));
OneClass *array = static_cast<OneClass*>(rawMemory);
for(int i = 0; i < 10; ++i){
     new (&array[i])  OneClass(ID Number); // 没看懂！
} // 说是，利用placement new 构造这块内存中的OneClass objects
而且在数组内的对象结束生命时，以手动方式调用其destructors，
最后还得以调用operator detele[]的方式释放raw memory：
for(int i = 9; i >= 0; --i){ // 以其构造顺序的相反顺序析构掉
     array[i].~OneClass();
}
operator delete[](rawMemory); // 释放rawMemory

（不提供default constructor的问题：）
（2）classes不提供default constructor，它们将不适用于许多template-based container classes。

此条款的其它论述有点麻烦，其它部还是直接看原书较好。


条款5：对定制的“类型转换函数”保持警觉
be wary of user-defined conversion functions.

C++允许编译器在不同类型之间执行隐式转换implicit conversions。
最好不要提供任何类型转换函数。

因为它们的出现可能导致错误（非预期）的函数被调用。

解决办法：
以功能对等的另一个函数取代类型转换操作符。如，toDouble()。
或者
将构造函数声明为explicit的——编译器不能因隐式类型转换的需要而调用他们。


条款6：区别increment/decrement操作符的前置（prefix）和后置（postfix）形式
distinguish between prefix and postfix forms of increment and decrement operators.

++increment和--decrement操作符的前置式或后置式都没有参数。
为了填平语言上的漏洞，只能让后置式有一个int参数，并且在它被调用时，编译器默默地为该int指定一个0值。

C时代，++前置式的含义：increment and fetch（累加然后取出）；
++后置式：fetch and increment（取出然后累加）。--decrement操作符类同。
这些就是++、--操作符如何实现的正式规范。


条款7：千万不要重载&&，||和“,”（逗号）操作符
never overload && , || , or "," .

重载了它们之后，就无法判断这些操作符左边的还是右边的expression表达式更早执行了！
&&、||的短路功能丢失，逗号操作符的从左到右的执行顺序不能被保证。


条款8：了解各种不同意义的new和delete
understand the different meanings of new and delete.




条款9:利用destructors避免泄漏资源
use destructors to prevent resource leaks.

条款10:在constructors内阻止资源泄漏
prevent resource leaks in constructors.

条款11:禁止异常（exceptions）流出destructors之外
prevent exceptions from leaving destructors.

条款12:了解“抛出一个exception”与“传递一个参数”或“调用一个虚函数”之间的差异
understand how throwing an exception differs from passing a parameter or calling a virtual function.

条款13:以by reference方式捕捉exceptions
catch exceptions by reference.

条款14:明智运用exception specifications
use exception specifications judiciously.

条款15:了解异常处理（exception handling）的成本
understand the costs of exception handling.

条款16:谨记80-20法则
remember the 80-20 rule.

条款17:考虑使用lazy evaluation（缓式评估）
consider using lazy evaluation.

条款18:分期摊还预期的计算成本
amortize the cost of experted computations.

条款19:协助完成“返回值优化（RVO）”
facilitate the return value optimization.
