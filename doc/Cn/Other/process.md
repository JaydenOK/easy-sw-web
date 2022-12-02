---
title: easyswoole队列消费/自定义进程问题
meta:
  - name: description
    content: easyswoole,队列消费/自定义进程问题
  - name: keywords
    content: easyswoole队列消费/自定义进程问题
---
## 如何实现队列消费/自定义进程
可能我们会经常遇见需要不断消费队列内内容的场景，我们以EasySwoole中自定义进程的方式，来实现这一功能。
## 实现代码
### 定义消费进程逻辑
```php
<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2018/10/18 0018
 * Time: 9:43
 */

namespace App\Process;

use EasySwoole\Component\Process\AbstractProcess;
use Swoole\Process;

class Consumer extends AbstractProcess
{
    private $isRun = false;
    public function run($arg)
    {
        // TODO: Implement run() method.
        /*
         * 举例，消费redis中的队列数据
         * 定时500ms检测有没有任务，有的话就while死循环执行
         */
        $this->addTick(500,function (){
            if(!$this->isRun){
                $this->isRun = true;
                $redis = new \redis();//此处为伪代码，请自己建立连接或者维护redis连接
                while (true){
                    try{
                        $task = $redis->lPop('task_list');
                        if($task){
                            // do you task
                        }else{
                            break;
                        }
                    }catch (\Throwable $throwable){
                        break;
                    }
                }
                $this->isRun = false;
            }
            var_dump($this->getProcessName().' task run check');
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

### 注册消费进程
在EasySwoole的全局事件中，注册消费进程。
```php
<?php
use App\Process\TestProcess;
use EasySwoole\Component\Process\Manager;
use EasySwoole\EasySwoole\Swoole\EventRegister;

public static function mainServerCreate(EventRegister $register)
{
  
    $allNum = 3;
    for ($i = 0 ;$i < $allNum;$i++){
        $processConfig= new \EasySwoole\Component\Process\Config();
        $processConfig->setProcessName('testProcess'.$i);//设置进程名称
        Manager::getInstance()->addProcess(new TestProcess($processConfig));
    }
}
```


::: warning 
 爬虫例子：https://github.com/HeKunTong/easyswoole3_demo
:::

