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
