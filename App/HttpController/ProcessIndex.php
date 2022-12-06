<?php


namespace App\HttpController;


use EasySwoole\Component\Di;
use EasySwoole\Http\AbstractInterface\Controller;

class ProcessIndex extends Controller
{
    public function index()
    {
        // 获取 Di 中注入的 自定义进程
        $customProcess = Di::getInstance()->get('customSwooleProcess');
        // 向自定义进程中传输信息，会触发自定义进程的 onPipeReadable 回调
        $customProcess->write('this is test!');
    }

}