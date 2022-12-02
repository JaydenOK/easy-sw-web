---
title: easyswoole辅助类
meta:
  - name: description
    content: easyswoole Str
  - name: keywords
    content: easyswoole Str字符串助手
---
# Str



## 功能介绍

Str字符串助手



## 相关class位置

- Str
    - `namespace`: `EasySwoole\Utility\Str`




## 核心对象方法



#### contains

检查字符串中是否包含另一字符串

- mixed $haystack 被检查的字符串
- mixed $needles 需要包含的字符串
- mixed $strict 是否区分大小写

```php
static function contains($haystack, $needles, $strict = true)
```


#### startsWith

检查字符串是否以某个字符串开头

- mixed $haystack 被检查的字符串
- mixed $needles 需要包含的字符串
- mixed $strict 是否区分大小写

```php
static function startsWith($haystack, $needles, $strict = true)
```



#### endsWith

检查字符串是否以某个字符串结尾

- mixed $haystack 被检查的字符串
- mixed $needles 需要包含的字符串
- mixed $strict 是否区分大小写

```php
static function endsWith($haystack, $needles, $strict = true)
```


#### snake

驼峰转下划线

- mixed $value 待处理字符串
- mixed $delimiter 分隔符

```php
static function snake($value, $delimiter = '_')
```



#### camel

下划线转驼峰 (首字母小写)

- mixed $value 待处理字符串

```php
static function camel($value)
```




#### studly

下划线转驼峰 (首字母大写)

- mixed $value 待处理字符串

```php
static function studly($value)
```


## 基本使用

```php
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19-1-9
 * Time: 上午10:10
 */

require './vendor/autoload.php';

var_dump(\EasySwoole\Utility\Str::contains('hello, easyswoole', 'Swoole', false));

/**
 * 输出结果:
 * bool(true)
 */

var_dump(\EasySwoole\Utility\Str::startsWith('hello, easyswoole', 'Hello', false));

/**
 * 输出结果:
 * bool(true)
 */

var_dump(\EasySwoole\Utility\Str::endsWith('hello, easyswoole', 'Swoole', false));

/**
 * 输出结果:
 * bool(true)
 */

var_dump(\EasySwoole\Utility\Str::snake('EasySwoole'));

/**
 * 输出结果:
 * string(11) "easy_swoole"
 */

var_dump(\EasySwoole\Utility\Str::camel('easy_swoole'));

/**
 * 输出结果:
 * string(10) "easySwoole"
 */

var_dump(\EasySwoole\Utility\Str::studly('easy_swoole'));

/**
 * 输出结果:
 * string(10) "EasySwoole"
 */
```