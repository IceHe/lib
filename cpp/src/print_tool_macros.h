/**
 *  Maybe you need this file:
 *
 *  ``` CMakeLists.txt
 *  cmake_minimum_required(VERSION 3.7)
 *  project(cpp_test)
 *
 *  set(CMAKE_CXX_STANDARD 14)
 *
 *  set(SOURCE_FILES main.cpp print_tools.h)
 *  add_executable(cpp_test ${SOURCE_FILES})
 *  ```
 */

#ifndef CPP_TEST_PRINT_TOOLS_H
#define CPP_TEST_PRINT_TOOLS_H

using std::cout;
using std::endl;

/**
 * Print Tools
 */

// Print A String & '\n'
// 打印字符串
#define l(str) cout << str << endl;

// Print Variable or Expression : name & value
// 打印变量或表达式，及其结果
#define v(x) cout << '\t' << #x << "  =  " << (x) << endl;

// Print An Empty Line
// 打印一个空行（分隔不同的程序输出）
#define el cout << endl;

#endif //CPP_TEST_PRINT_TOOLS_H
