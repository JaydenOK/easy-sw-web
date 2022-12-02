---
title: easyswoole自定义进程实现redis订阅
meta:
  - name: description
    content: easyswoole,自定义进程实现redis订阅
  - name: keywords
    content: easyswoole redis订阅|swoole redis订阅
---

## 自定义进程实现redis订阅
## 实现代码
```php
<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2018/10/18 0018
 * Time: 10:28
 */

namespace App\Process;


use EasySwoole\Component\Process\AbstractProcess;
use Swoole\Process;

class Subscribe extends AbstractProcess
{
    public function run($arg)
    {
        // TODO: Implement run() method.
        $redis = new \Redis();//此处为伪代码，请自己建立连接或者维护
        $redis->connect('127.0.0.1');
        $redis->subscribe(['ch1'],function (){
            var_dump(func_get_args());
        });
    }

    public function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }

    public function onReceive(string $str, ...$args)
    {
        // TODO: Implement onReceive() method.
    }

}
```

接下来，需要做的事情，就是到EasySwooleEvent.php的主服务创建事件中，注册该进程即可。
```php
use App\Process;
use EasySwoole\Core\Swoole\Process\ProcessManager;

\EasySwoole\Component\Process\Manager::getInstance()->addProcess(new Subscribe('sub'));
```
