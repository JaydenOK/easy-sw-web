# 回调事件

### 针对全局 onQuery

针对全局设置回调事件方式如下:

```php
// 注册ORM时, 调用回调函数
public static function mainServerCreate(EventRegister $register)
{
    ...

    DbManager::getInstance()->addConnection(new Connection($config));
    DbManager::getInstance()->onQuery(function ($res, $builder, $start) {
        // 打印参数 OR 写入日志
    });
}
```

onQuery回调会注入三个参数

- `res`查询结果对象, 类名为`EasySwoole\ORM\Db\Result`

可以参考 [执行结果](../lastResult.html) 文档, 以获取更多的结果内容

- `builder`查询语句对象, 类名为`EasySwoole\Mysqli\QueryBuilder`

- `start`开始查询时间戳, 单位为`s`, 类型为`float`

::: tip
如果查询过程中调用`withTotalCount()`方法, 那么还会产生第二个回调结果
:::

::: warning
需要注意的是, 此回调方法务必在注册ORM时调用, 否则不会产生任何结果
:::

### 针对特定模型 onQuery

如果不想使用全局性的onQuery, 我们可以在执行操作的时候调用onQuery方法, 以此来实现针对特定模型的回调

```php
$res = User::create()->onQuery(function ($res, $builder, $start) {
    // 打印参数 OR 写入日志
})->get(1);
```

::: tip
回调注入的三个参数与全局性onQuery相同
:::

### 记录慢日志

我们可以通过手动判断执行时间, 来实现一个记录慢日志的功能
```php
public static function mainServerCreate(EventRegister $register)
{
    ...

    DbManager::getInstance()->addConnection(new Connection($config));
    DbManager::getInstance()->onQuery(function ($res, $builder, $start) {
        $queryTime = 查询时间阈值;
        if (bcsub(time(), $start, 3) > $queryTime) {
            // 写入日志
        }
    });
}
```
