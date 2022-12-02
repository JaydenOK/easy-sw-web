# 关联预查询

在普通关联中，我们在Model类文件中定义了关系后，即可快速关联查询数据。

但在此时仍然需要我们手动获取该关联名才会执行。

预查询提供了一种主数据查询后，马上自动查询关联数据的用法。

orm版本需要`>= 1.2.0`

## with方法

with方法传入一个数组，内容为已经在类文件中定义好的关联名

```php
$res = Model::create()->with(['user_list', 'user_store'])->get(1);

var_dump($res); // 此时已经有user_list,user_sotre两个关联字段的数据，不再需要先手动调用一次。
```

支持传参数操作：
`orm >= 1.4.25`

```php

$res = Model::create()->with(['user_list' => ['a' => 1, 'b' => 2]])->get(1);
$res = Model::create()->with(['user_list' => 'test'])->get(1);

// 伪代码
function user_list($data){
    var_dump($data); // a => 1 b=> 2 or test
}
```