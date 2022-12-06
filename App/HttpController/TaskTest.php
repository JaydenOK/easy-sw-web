<?php


namespace App\HttpController;


use App\Task\CustomTask;
use EasySwoole\Http\AbstractInterface\Controller;

class TaskTest extends Controller
{
    public function test()
    {
        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
        // 投递异步任务
        $task->async(new CustomTask(['user' => 'custom']));
        // 投递同步任务
        $data = $task->sync(new CustomTask(['user' => 'custom']));
    }

}