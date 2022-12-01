<?php

namespace App\Utility;

use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\RabbitMq\MqQueue;
use EasySwoole\RabbitMq\MqJob;

class MqQueueProcess extends AbstractProcess
{
    protected function run($arg)
    {
        go(function () {
            $MqQueue = MqQueue::getInstance()->refreshConnect();
            $MqQueue->consumer()->setConfig($exchange = 'kd_sms_send_ex', $routingKey = 'hello', $mqType = 'direct', $queueName = 'hello')->listen(function (MqJob $obj) {
                echo " [x] Received ", $obj->getJobData(), "\n";
                Logger::getInstance()->log('log level info' . var_export($obj->getJobData(), true), Logger::LOG_LEVEL_INFO, 'DEBUG');//记录info级别日志//例子后面2个参数默认值
                var_dump($obj->getJobData(), 'MqQueueProcess');
                //return;   //使用return 终止执行下面的代码
                //return true;   //使用return true终止执行下面的代码
                echo 11111;
                //return false;  //return false消息回滚,所以请注意，不要随意使用return false
            });
        });
    }
}