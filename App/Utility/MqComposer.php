<?php

namespace App\Utility;

use EasySwoole\RabbitMq\MqQueue;
use EasySwoole\RabbitMq\MqJob;

class MqComposer
{

    public static function push()
    {
        $job = new MqJob();
        $job->setJobData('composer hello word' . date('Y-m-d H:i:s', time()));
        $res = MqQueue::getInstance()->producer()->setConfig($exchange = 'kd_sms_send_ex', $routingKey = 'hello', $mqType = 'direct', $queueName = 'hello')->push($job);
        if ($res) {
            var_dump('发布成功');
        } else {
            var_dump('发布失败');
        }
        //主动关闭链接
        /* MqQueue::getInstance()->closeConnection(function (\Exception $e){
            //这边是主动关闭异常处理
           });  */
    }
}