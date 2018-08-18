# Effective C++ 4

> C++ Advanced - Note: parameter-independent 参数无关的代码抽离 templates；member function templates 运用成员函数模板接受所有兼容类型；请使用 traits class 表现类型信息；template metaprograming；new-handler；placement new，placement delete；不要轻忽编译器的警告；Boost，TR1。

- Created on 2014-05

## 条款44：将参数无关的代码抽离templates

factor parameter-independent code out of templates.

1. Templates生成多个classes和多个函数，所以
    任何template代码都不该与某个造成膨胀的template参数产生相依关系。
2. 因非类型模板参数（non-type template parameters）而造成的代码膨胀，
    往往可以消除，做法是以函数参数或class成员变量替换template参数。
3. 因类型参数（type parameters）而造成的代码膨胀，往往可降低，
    做法是让带有完全相同二进制表述（binary representations）的具现类型
    （instantiation type）共享实现码。

```cpp
template<typename T, std::size_t n> // n就是非类型参数
class SquareMatrix{
public:
     void invert();
};
```

## 条款45：运用成员函数模板接受所有兼容类型

use member function templates to accept "all compatible types".

1. 请使用member function templates（成员函数模板）
    生成“可接受所有兼容类型”的函数。
2.如果你声明member templates用于“泛化copy构造”或“泛化ssignment操作”，
    你还是需要声明正常的copy构造函数和copy assignment操作符。

```cpp
template<typename T>
class SmartPtr{
public:
     template<typename U>
     SmartPtr(const SmartPtr<U>& other)
          : heldPtr(other.get()) {
          ...
     }
private:
     T* heldPtr;
};
```

## 条款46：需要类型转换时请为模板定义非成员函数

define non-member functions inside templates when type conversion are desired.

此条目相当复杂，所以最好查看原书。

当我们编写一个class template，而它所提供之“与此template相关的”函数支持“所有参数值之隐式类型转换”时，
请将那些函数定义为“class template内部的friend函数”。

## 条款47：请使用traits class表现类型信息

use traits classes for information about types.

traits广泛应用于标准程序库。
但是，平时使用很少，导致看得不深入，难懂。
最好，看原书的条款。此处不详述太多。

如何设计并实现一个traits class：

- （1）确认若干你希望将来可取得的类型相关信息。如迭代器的种类。
- （2）为该信息选择一个名称。如iterator_category。
- （3）提供一个template和一组特化版本（如iterator_traits），内含你希望支持的类型相关信息。

```cpp
// 对于5种迭代器种类，C++标准程序库分别提供专属的卷标结构（tag struct）
struct input_iterator_tag {};
struct output_iterator_tag {};
struct forward_iterator_tag : public input_iterator_tag {};
struct bidirectional_iterator_tag : public forward_iterator_tag {};
struct random_access_iterator_tag : public bidirectional_iterator_tag {};

template<...> // 略而未写的template参数
class deque{
public:
     class iterator{
     public:
          typedef random_access_iterator_tag iterator_category;
          ...
     };
};

template<...> // 略而未写的template参数
class list{
public:
     class iterator{
     public:
          typedef bidirectional_iterator_tag iterator_category;
          ...
     };
};

template<typename IterT>
struct iterator_traits{
     typedef typename IterT::iterator_category iterator_category;
     ...
}; // 它对用户自定义类型行得通，但对指针（另一种迭代器）行不通。
// 因为指针不可能嵌套typedef。

template<typename IterT>
struct iterator_traits<IterT*>{ // 利用偏特化解决，支持了指针迭代器
     typedef random_access_iterator_tag iterator_category;
     ...
}

// advance函数用于移动迭代器
// 以下代码是，利用重载技术，在编译期对类型执行取代if...else测试
template<typename IterT, typename DistT>
void doAdvance(IterT& iter, DistT d, std::random_access_iterator_tag){
     iter += d;
}

template<typename IterT, typename DistT>
void doAdvance(IterT& iter, DistT d, std::bidirectional_iterator_tag){...}

template<typename IterT, typename DistT>
void doAdvance(IterT& iter, DistT d, std::input_iterator_tag){...}

template<typename IterT, typename DistT>
void advance(IterT& iter, DistT d){
     doAdvance(iter, d, typename std::iterator_traits<IterT>::iterator_category();
     // 这里就不用if...else去测试用那种方式去移动迭代器了！
}
```

1. Traits classes使得“类型相关信息”在编译期可用。
    它们以templates和“templates特化”完成实现。
2. 整合重载技术（overloading）后，
    traits classes有可能在编译期对类型执行if...else测试

## 条款48：认识template元编程

be aware of template metaprograming.

1. Template metaprograming（TMP，模板元编程）可将工作由运行期移往编译期，
    因而得以实现早期错误侦测，和更高的执行效率！
2. TMP可被用来生成“基于政策选择组合”（based on combinations of policy choices）
    的客户定制代码，也可用来避免生成对某些特殊类型并不合适的代码。

TMP已被证明是个“图灵完全”（turing-complete）机器，意思是它的威力大到足以计算任何事物。

TMP没有循环构件，循环效果由递归完成recursion。
但其递归非递归函数调用，而是“递归模板具现化”（recursive template instantiation）。
如下的阶乘例子（factorial）：

```cpp
template<unsigned n>
struct Factorial{
     enum { value = n * Factorial<n - 1>::value }; // enum hack
};
template<>
struct Factorial<0>{ // 模板特化
     enum { value = 1 };
};
```

只要你指涉Factorial<n>::value就可以得到n阶乘值。

为什么TMP值得学习？

- （1）确保度量单位正确。使用它，就可以确保（在编译期）程序中所有度量单位的组合都正确，
    不论计算多复杂。所以它能用于早期侦测。
- （2）优化矩阵运算。
    - 用高级与TMP相关的template技术，即expression templates，
    - 就可能消除那些计算中临时产生的对象，并合并循环。
    - 使其使用较少的内存，执行速度有大提升。

```cpp
Matrix m1, m2, m3;
Matrix res = m1 * m2 * m3;
```

- （3）可以生成客户定制之设计模式（custom design pattern）实现品。
    - 设计模式如Strategy、Ovserver、Visitor等等都可以多种方式实现出来。
    - 运用policy-based design之TMP-based技术，可能产生一些templates用来表述的独立设计选项，
    - 可任意组合他们，导致模式实现品带着客户定制的行为。
    - 例如智能指针。

## 条款49：了解new-handler的行为

understand the behavior of the new-handler.

STL容器所使用的heap内存是由容器所拥有的分配器对象（allocator objects）管理，
不是被new和delete直接管理。

当operator new抛出异常以反映一个未获满足的内存需求之前，
它会先调用一个客户制定的错误处理函数，即new-handler。

```cpp
namespace std{
     typedef void (*new_handler)();
     new_handler set_new_handler(new_handler p) throw();
} // 其返回值也是一个指针，指向set_new_handler被调用前正在执行
// （但马上就要被替换）的那个new-handler函数。
```

当operator new无法满足内存申请时，会不断调用new-handler函数函数，直到找到足够内存。

设计良好的new-handler必须做以下事情：

- （1）让更多内存可被使用。
- （2）安装另一个new-handler。
    如果目前这个new-handler无法取得更多可用内存，或许它直到另外哪个new-handler有此能力。
- （3）卸载new-handler。
    也就是将null指针传给set_new_handler。
    一旦没有安装任何new-handler，operator new会在内存分配不成功时抛出异常。
- （4）抛出bad_alloc（或派生自bad_alloc）的异常。
    这样的异常不会被operator new捕捉，因此会被传播到内存索求处。
- （5）不返回，通常调用abort或exit。

C++不支持class专属的new-handler，其实也不需要。
可令每个class提供自己的operator new和new-handler即可。

```cpp
template<typename T>
class NewHandlerSupport{
public:
     static std::new_handler set_new_handler(std::new_handler p) throw();
     static void* operator new(std::size_t size) throw(std::bad_alloc);
     ...
private:
     static std::new_handler currentHandler;
};

template<typename T>
std::new_handler NewHandlerSupport<T>::set_new_handler(std::new_handler p) throw(){
     std::new_handler oldHandler = currentHandler;
     currentHandler = p;
     return oldHandler;
}

template<typename T>
void* NewHandlerSupport<T>::operator new(std::size_t size) : throw(std::bad_alloc){
     NewHandlerHolder h(std::set_new_handler(currentHandler));
     return ::operator new(size);
}
// 1.调用set_new_handler，告知Widget的错误处理函数。
// 2.调用global operator new，执行实际的内存分配。
// 如果失败，operator new会调用Widget专属的new-handler。
// 若最终还是无法分配足够内存，会抛出bad_alloc异常。
// 然而之后，还要恢复原本的global new-handler，
// 然后再传播该异常。为了将原来的handler安装回去，
// 使用了资源管理对象，实例即是以下的NewHandlerHolder，防止资源泄漏。
// 3.global operator new能够分配足够的内存，operator new会返回一个指针，指向分配所得。
// Widget的析构函数会管理global new-handler，
// 自动将Widget's operator new被调用之前的那个new-handler恢复回来~！

template<typename T>
std::new_handler NewHolderSupport<T>::currentHandler = 0;

class NewHandlerHolder{
public:
     explicit NewHandlerHolder(std::new_handler nh)
          : handler(nh){}
     ~newHandlerHolder(){
          std::set_new_handler(handler);
     }
private:
     std::new_handler handler;
     NewHandlerHolder(const NewHandlerHolder&);
     NewHandlerHolder& operator=(const NewHandlerHolder&);
};
```

1. set_new_handler允许客户指定一个函数，在内存分配无法获得满足时被调用。
2. Nothrow new是一个颇为局限的工具，因为它只适用于内存分配；

后继的构造函数调用还是可能抛出异常。

## 条款50：了解new和delete的合理替换时机

understand when it makes sense to replace new and delete.

为什么要替换编译器提供的operator new&delete呢？

- （1）用来检测运用上的错误。
    - 如，new的资源不小心delete掉时，导致内存泄露。
    - 如，多次delete，导致了不确定行为。
    - 这些都容易识别。但各式各样的编程错误导致
    - overruns（写入点在分配区块之后）或underruns（写入点在分配区块起点之前）。
    - 自定义的operator new就可以分配额外空间防止特定byte pattern（即签名，signatures），
    - 检查分配区块在某生命时间点，是否发生了overruns或underruns。
- （2）为了强化效能。
    定制版性能可以优化超过缺省版本。
- （3）为了收集使用上的统计数据。
- （4）为了增加分配和归还的速度。
- （5）为了降低缺省内存管理器带来的空间额外开销。
    针对小型对象而开发的分配器（例如Boost的Pool程序库）本质上消除了这样的额外开销。
- （6）为了弥补却生分配其中的非最佳齐位（suboptimal alignment）。
    如doubles的访问在x86体系结构上的访问是最快速的。
- （7）为了将相关对象成簇集中。
- （8）为了获得非传统的行为。

## 条款51：编写new和delete时需固守常规

adhere to convention when writing new and delete.

详情最好自己重看原书。以下仅给出最后书中的简单概括：

1. operator new应该内含一个无穷循环，
    - 并在其中尝试分配内存，如果它无法满足内存需求，
    - 就应该调用new-handler。它也应该有能力处理0 bytes申请。
    - 专属版本则还应该处理”比正确大小更大的（错误）申请“。
2. operator delete应该在收到null指针时不做任何事。
    - class专属版本则还应该处理”比正确大小更大的（错误）申请“

## 条款52：写了placement new也要写placement delete

write placement delete if you write placement new.

详情最好自己重看原书。以下仅给出最后书中的简单概括：

```cpp
void* operator new(std::size_t) throw(std::bad_alloc); // normal new
void* operator new(std::size_t, void*) throw();        // placement new
                                                       // 从void*指针制定的位置开始分配内存
void* operator new(std::size_t, const std::nothrow_t&) throw(); // nothrow new
```

new和delete如果接受了额外参数，便称为placement的。
如果一个带额外参数的operator new没有”带相同额外参数“的对应版operator delete，
那么当new的内存分配动作需要取消并恢复旧观时就没有人员和operator delete会被调用。

1. 当你写一个placement operator new，请确定也写出了对应的placement operator delete。
    如果没有这样做，你的程序可能因为发生隐微而时断时续的内存泄露。
2. 当你声明placement new和placement delete，请确定不要无意识（非故意）地掩盖了它们的正常版本。

## 条款53：不要轻忽编译器的警告

pay attention to compilere warnings.

1. 严肃对待编译器发出的警告信息。努力在你的编译器的最高（最严苛）警告级别下
    争取”无任何警告“的荣誉。
2. 不要过度倚赖编译器的报警能力，因为不同的编译器对待事情的态度并不相同。
    一旦移植到另一编译器上，你原本倚赖的警告信息有可能消失。

## 条款54：让自己熟悉包括TR1在内的标准程序库

 familiarize yourself with the standard library， including TR1.

STL：容器、迭代器、算法、函数对象、容器适配器、函数对象适配器。
iostream:自定缓冲功能。
国际化支持：wchar_t。
数值处理：复数模板complex、纯数值数组valarray。
异常阶层体系：exception、logic_error、runtime_error……
C89标准程序库：……

智能指针：……
tr1::function、tr1::bind
hash tables
正则表达式Regular expresstions
tuples变量组
tr1::array、tr1::mem_fn、tr1::reference_wrapper
随机数random number
数学特殊函数
c99兼容扩充

Type traits：用以提供类型（types）的编译器信息。
tr1::result_of：是个template，用来推导函数调用的返回类型。

## 条款55：让自己熟悉Boost

Familiarize yourself with Boost

Boost程序库对付的主题非常繁多，区分数十个类目，包括：

1. 字符串与文本处理
2. 容器
3. 函数对象和高级编程（例如lambda）
4. 泛型编程
5. 模板元编程
6. 数学和数值
7. 正确性与测试
8. 数据结构
9. 语言间的支持
10. 内存
11. 杂项

- （1）Boost是一个社群，也是一个网站。
    - 致力于免费、源码开放、同僚复审的C++程序库开发。
    - Boost在C++标准化过程中扮演深具影响力的角色。
- （2）Boost提供许多TR1组件实现品，以及其它许多程序库。
