# PHP

## Magic Methods

References

- http://php.net/manual/zh/language.oop5.magic.php

Common

- `__construct([ mixed $args [, $… ]]): void`
    - 勿忘 `parent::__construct(…)`
- `__destruct(void): void`
    - 勿忘 `parent::__destruct(…)`
- `__call(string $name, array $args): mixed`
    - 访问一个对象的一个不可访问的动态方法时，被调用
- `__callStatic(string $name, array $args): mixed`
    - 访问一个类的一个不可访问的静态方法时，会被调用。
- `__set(string $name, mixed $value): void`
    - 修改（复制）一个不可访问的变量时，被调用
- `__get(string $name): mixed`
    - 访问一个不可访问的变量时，被调用
- `__isset(string $name): bool`
    - 对一个对象使用 `isset/empty` 函数时，被调用
- `__unset(string $name): void`
    - 对一个对象使用 `unset` 函数时，被调用
- `__clone(void): void`
    - `$copy_of_object = clone $object;`
    - 当复制完成时，如果定义了 __clone() 方法，则新创建的对象（复制生成的对象）中的 __clone() 方法会被调用，可用于修改属性的值（如果有必要的话）。

Seldom

- `__sleep(void): string` 序列化 serialize()
- `__wakeup(void): void` 反序列化 unserialize()
- `__toString(void): string`
    - Warning : 不能在 __toString() 方法中抛出异常。这么做会导致致命错误。
- `__invoke([ $… ]): mixed` 以函数方式来调用对象，就会调用它
    - e.g. `CallableClass($params);`
- `static __set_state(array $properties): object` for var_export()（不是特别理解）
- `__debugInfo(void): array` for var_dump()

Autoload

- PHP: 类的自动加载 - Manual : http://php.net/manual/zh/language.oop5.autoload.php
- PHP: spl_autoload_register - Manual : http://php.net/manual/zh/function.spl-autoload-register.php
- Basic usage #autoloading - Composer : https://getcomposer.org/doc/01-basic-usage.md#autoloading

## Others

### Shared Memory Functions

References

- http://php.net/manual/en/ref.shmop.php

### Process Control

References

- http://php.net/manual/en/book.pcntl.php
    - ZH : http://php.net/manual/zh/book.pcntl.php

### php-rdkafka

References

- https://github.com/arnaud-lb/php-rdkafka

### Life Cycle 生命周期

References

- PHP的生命周期 : https://segmentfault.com/a/1190000013321594

PHP 的启动

- MINIT - Module Init
    - 模块初始化：拓展、常量、类、资源等 PHP 脚本需要用到的东西，常驻内存
- RINIT - Request Init
    - PHP 调用所有模块的 RINIT 函数，执行相关操作
    - 初始化跟本次请求相关的变量
- RSHUTDOWN - Request Shutdown
    - PHP 调用已加载拓展的 RSHUTDOWN
    - die / exit 时，PHP 会启动回收本次请求使用的资源
        - 变量、内存
- MSHUTDOWN - Module Shutdown
    - PHP 调用所有拓展的 MSHUTDOWN 函数，释放资源

PHP 的生命周期

（CGI/CLI）

暂从略

- extensions -> MINIT()
    - while (requests)
        - request index.php
        - extensions -> RINIT()
        - run index.php
        - extensions -> RSHUTDOWN()
        - finish cleaning up index.php
    - end while
- extensions -> MSHUTDOWN

即

- extensions -> MINIT()
    - extensions -> RINIT()
    - SCRIPT
    - extensions -> RSHUTDOWN()
- extensions -> MSHUTDOWN

### 深拷贝 & 浅拷贝

References

- PHP中对象的深拷贝与浅拷贝 : https://www.cnblogs.com/taijun/p/4208008.html

### PHP 使用的内存量

```php
<php?

$startMemSize = memory_get_usage();
// ...
$endMemSize = memory_get_usage();

echo $startMemSize." bytes \n";
echo $endMemSize." bytes \n";
echo ($endMemSize - $startMemSize)." bytes \n";

// output:
// ……
// 363088 bytes
// 373784 bytes
// 10696 bytes
```