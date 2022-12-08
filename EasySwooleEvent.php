<?php


namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\ORM\DbManager;
use EasySwoole\ORM\Db\Connection;


class EasySwooleEvent implements Event
{

    //实际服务类exe()方法，执行前执行，然后再执行具体的方法 $this->start(); 在此时只初始化了配置
    //Core::getInstance()->initialize();
    //return $this->$action();
    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');

        //================= 注册 mysql orm 连接池 =================
        $config = new \EasySwoole\ORM\Db\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        // 【可选操作】我们已经在 dev.php 中进行了配置
        $config->setMinObjectNum(5)->setMaxObjectNum(30); // 配置连接池数量，总连接数 = minObjectNum * SETTING.worker_num
        //DbManager::getInstance()->addConnection(new Connection($config));
        // 设置指定连接名称 后期可通过连接名称操作不同的数据库
        $ormConnection = new Connection($config);
        DbManager::getInstance()->addConnection($ormConnection, 'main');


        //=================  注册redis连接池  =================
        $config = new \EasySwoole\Pool\Config();
        $redisConfig1 = new \EasySwoole\Redis\Config\RedisConfig(Config::getInstance()->getConf('REDIS'));
        // 注册连接池管理对象
        \EasySwoole\Pool\Manager::getInstance()->register(new \App\Pool\RedisPool($config, $redisConfig1), 'redis');


    }

    //Core->createServer()方法，执行 $ret = EasySwooleEvent::mainServerCreate(ServerManager::getInstance()->getEventRegister());
    //swoole服务器启动前执行，在此时已经new \Swoole\Server()，但未 $server->start().
    public static function mainServerCreate(EventRegister $register)
    {

        //================= mysql连接池预热，先初始化连接  =================
        $register->add($register::onWorkerStart, function () {
            // 链接预热
            // ORM 1.4.31 版本之前请使用 getClientPool()
            // __getClientPool : \EasySwoole\ORM\Db\MysqlPool ：实例化pool，真正实例化mysql连接在：keepMin()
            DbManager::getInstance()->getConnection('main')->__getClientPool()->keepMin();
        });


        //================= 创建自定义进程 start =================
        $processConfigArr = [
            'AsyncMessageProcess' => [
                'class' => \App\Process\AsyncMessageProcess::class,
                'processName' => 'EasyAsyncMessageProcess',
                'processGroup' => 'EasyAsyncMessageProcess',
                'processNum' => 3,  //启动进程数
                'arg' => [],
            ],
        ];
        foreach ($processConfigArr as $processName => $item) {
            for ($i = 0; $i < $item['processNum']; $i++) {
                $processConfig = new \EasySwoole\Component\Process\Config([
                    'processName' => $item['processName'] . '_' . $i,
                    'processGroup' => $item['processGroup'],
                    'arg' => $item['arg'],
                    'enableCoroutine' => true,  //自定义进程自动开启协程环境
                ]);
                // 【推荐】使用 \EasySwoole\Component\Process\Manager 类注册自定义进程
                // 【可选操作】把 tickProcess 的 Swoole\Process 注入到 Di 中，方便在后续控制器等业务中给自定义进程传输信息(即实现主进程与自定义进程间通信)
                // 注册进程
                /**
                 * @var $myProcess \EasySwoole\Component\Process\AbstractProcess
                 */
                $myProcess = new $item['class']($processConfig);
                \EasySwoole\Component\Di::getInstance()->set($processName, $myProcess->getProcess());
                \EasySwoole\Component\Process\Manager::getInstance()->addProcess($myProcess);
            }
        }


        //=================   实现 onRequest 事件  =================
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


        //=================   实现 afterRequest 事件  =================
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


        //================= 给 server 注册相关事件，在 WebSocket 服务模式下 message 事件必须注册  =================
        /** @var \EasySwoole\EasySwoole\Swoole\EventRegister $register * */
//        $register->set($register::onMessage,function (\Swoole\WebSocket\Server $server, \Swoole\WebSocket\Frame $frame){
//        });

    }


}