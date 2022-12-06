<?php

namespace App\Crontab;

use EasySwoole\Crontab\JobInterface;

class CustomCrontab implements JobInterface
{
    public function jobName(): string
    {
        // 定时任务的名称
        return 'CustomCrontab';
    }

    public function crontabRule(): string
    {
        // 定义执行规则 根据 Crontab 来定义
        // 这里是每分钟执行 1 次
        return '*/1 * * * *';
    }

    public function run()
    {
        // 定时任务的执行逻辑

        // 相当于每分钟打印1次时间戳，这里只是参考示例。
        echo time();
    }

    public function onException(\Throwable $throwable)
    {
        // 捕获 run 方法内所抛出的异常
    }
}
