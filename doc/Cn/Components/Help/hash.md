---
title: easysowole辅助类
meta:
  - name: description
    content: Easyswoole Hash
  - name: keywords
    content: easysowole辅助类|php hash|easyswoole hash
---

# Hash



## 功能介绍

用于快速处理哈希密码以及数据完整性校验等场景



## 相关class位置


- Hash
    - `namespace`: `EasySwoole\Utility\Hash`




## 核心对象方法



#### makePasswordHash

从一个明文值生产哈希

- mixed $value 需要生产哈希的原文
- mixed $cost 递归的层数

```php
static function makePasswordHash($value, $cost = 10)
```



#### validatePasswordHash

校验明文值与哈希是否匹配

- mixed $value 原文
- mixed $cost 哈希加密文

```php
static function validatePasswordHash($value, $hashValue)
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

$password = 123456;
$hash = \EasySwoole\Utility\Hash::makePasswordHash($password);
var_dump($hash);
var_dump(\EasySwoole\Utility\Hash::validatePasswordHash($password, $hash));

/**
 * 输出结果:
 * string(60) "$2y$10$ESx0z8TGSJpMI3Hgr6nJJOdbretS2TBqv4d5L0XjlTkSjSiCiq/f6"
 * bool(true) 
 */
```

