<?php


namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\ORM\DbManager;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\Db\Config;


class EasySwooleEvent implements Event
{
    //实际服务类exe()方法，执行前执行，然后再执行具体的方法 $this->start();
    //Core::getInstance()->initialize();
    //return $this->$action();
    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');
    }

    //Core->createServer()方法，执行 $ret = EasySwooleEvent::mainServerCreate(ServerManager::getInstance()->getEventRegister());
    //swoole服务器启动前执行
    public static function mainServerCreate(EventRegister $register)
    {
        //注册数据库连接配置
        $config = new Config();
        $config->setDatabase('yibai_account_manage');
        $config->setUser('appuser');
        $config->setPassword('adf2FASFAS');
        $config->setHost('192.168.92.209');
        $config->setTimeout(15); // 超时时间

        DbManager::getInstance()->addConnection(new Connection($config));

        // 设置指定连接名称 后期可通过连接名称操作不同的数据库
        //DbManager::getInstance()->addConnection(new Connection($config), 'write');


        // 给 server 注册相关事件，在 WebSocket 服务模式下 message 事件必须注册
        /** @var \EasySwoole\EasySwoole\Swoole\EventRegister $register * */
//        $register->set($register::onMessage,function (\Swoole\WebSocket\Server $server, \Swoole\WebSocket\Frame $frame){
//        });

        //================= 创建自定义进程 start =================
        $processConfig = new \EasySwoole\Component\Process\Config([
            'processName' => 'AsyncMessageProcess', // 设置 进程名称
            'processGroup' => 'AsyncMessageProcess', // 设置 进程组名称
            'arg' => [
                'arg1' => '123',
            ],
            // 传递参数到自定义进程中
            'enableCoroutine' => true, // 设置 自定义进程自动开启协程环境
        ]);
        // 【推荐】使用 \EasySwoole\Component\Process\Manager 类注册自定义进程
        $asyncMessageProcess = (new \App\Process\AsyncMessageProcess($processConfig));
        // 【可选操作】把 tickProcess 的 Swoole\Process 注入到 Di 中，方便在后续控制器等业务中给自定义进程传输信息(即实现主进程与自定义进程间通信)
        \EasySwoole\Component\Di::getInstance()->set('AsyncMessageProcess', $asyncMessageProcess->getProcess());
        // 注册进程
        \EasySwoole\Component\Process\Manager::getInstance()->addProcess($asyncMessageProcess);
        //================= 创建自定义进程 end =================

        // 实现 onRequest 事件
        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_GLOBAL_ON_REQUEST, function (\EasySwoole\Http\Request $request, \EasySwoole\Http\Response $response): bool {
            ###### 对请求进行拦截 ######

            ###### 处理请求的跨域问题 ######
            $response->withHeader('Access-Control-Allow-Origin', '*');
            $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            $response->withHeader('Access-Control-Allow-Credentials', 'true');
            $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
            if ($request->getMethod() === 'OPTIONS') {
                $response->withStatus(\EasySwoole\Http\Message\Status::CODE_OK);
                return false;
            }
            return true;
        });


        // 实现 afterRequest 事件
        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_GLOBAL_AFTER_REQUEST, function (\EasySwoole\Http\Request $request, \EasySwoole\Http\Response $response): void {

            // 示例：获取此次请求响应的内容
//            TrackerManager::getInstance()->getTracker()->endPoint('request');
//            $responseMsg = $response->getBody()->__toString();
//            Logger::getInstance()->console('响应内容:' . $responseMsg);
//            // 响应状态码：
//            // var_dump($response->getStatusCode());
//
//            // tracker 结束，结束之后，能看到中途设置的参数，调用栈的运行情况
//            TrackerManager::getInstance()->closeTracker();
        });


    }


}