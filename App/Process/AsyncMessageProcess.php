<?php

namespace App\Process;

use App\Utils\RabbitMQClient;
use EasySwoole\Component\Process\AbstractProcess;
use Swoole\Process;

class AsyncMessageProcess extends AbstractProcess
{
    protected function run($arg)
    {
        $processName = $this->getProcessName();
        $processPid = $this->getPid();
        // TODO: Implement run() method.
        echo '进程start:' . $processName . PHP_EOL;
        //  获取 注册进程名称; 获取 当前进程 Pid; 获取 注册进程时传递的参数
        //easyswoole 异步消息服务
        go(function () {
            $rabbitMQClient = new RabbitMQClient();
            $queueName = 'aaa';
            $callback = function ($body) {
                echo date('[Y-m-d H:i:s]') . print_r($body, true) . PHP_EOL;
                \Swoole\Coroutine::sleep(1);
                //确认消息
                return true;
            };
            try {
                //阻塞消费消息
                $rabbitMQClient->consume($callback, $queueName);
            } catch (\Exception $e) {
                echo date('[Y-m-d H:i:s]') . 'exception:' . $e->getMessage() . PHP_EOL;
            }
        });
        echo '进程 end:' . $processName . PHP_EOL;
    }

    protected function onPipeReadable(Process $process)
    {
        // 该回调可选
        // 当主进程对子进程发送消息的时候 会触发
        $recvMsgFromMain = $process->read(); // 用于获取主进程给当前进程发送的消息
        var_dump('收到主进程发送的消息: ');
        var_dump($recvMsgFromMain);
    }

    protected function onException(\Throwable $throwable, ...$args)
    {
        // 该回调可选
        // 捕获 run 方法内抛出的异常
        // 这里可以通过记录异常信息来帮助更加方便地知道出现问题的代码
        echo '进程 onException:' . $throwable->getFile() . ':' . $throwable->getMessage() . PHP_EOL;
    }

    protected function onShutDown()
    {
        // 该回调可选
        // 进程意外退出 触发此回调
        // 大部分用于清理工作
        echo '进程 onShutDown:' . PHP_EOL;
    }

    protected function onSigTerm()
    {
        // 当进程接收到 SIGTERM 信号触发该回调
        echo '进程 onSigTerm:' . PHP_EOL;
    }
}