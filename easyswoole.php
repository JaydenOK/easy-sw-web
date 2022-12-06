<?php
/**
 * easyswoole文件的php副本
 * http服务，启动 web-server，监听端口，注册回调 onRequest 事件，根据路由，dispatcher，再执行具体的路由 （方法逻辑：Code->registerDefaultCallBack()）
 *
 *
 */

use EasySwoole\EasySwoole\Command\CommandRunner;
use EasySwoole\Command\Caller;

$file = __DIR__ . '/vendor/autoload.php';
if (file_exists($file)) {
    require $file;
} else {
    die("include composer autoload.php fail\n");
}

$realCwd = substr(realpath($file), 0, -strlen("/vendor/autoload.php"));

defined('IN_PHAR') or define('IN_PHAR', boolval(\Phar::running(false)));
defined('RUNNING_ROOT') or define('RUNNING_ROOT', $realCwd);
defined('EASYSWOOLE_ROOT') or define('EASYSWOOLE_ROOT', IN_PHAR ? \Phar::running() : $realCwd);

if (file_exists(EASYSWOOLE_ROOT . '/bootstrap.php')) {
    require_once EASYSWOOLE_ROOT . '/bootstrap.php';
}
//[root@ac_web easy_sw_web]# php easyswoole server status
$caller = new Caller();                 //命令及参数通过Caller传给CommandManager执行者
$caller->setScript(current($argv));     //脚本名: easyswoole
$caller->setCommand(next($argv));       //命令：server
$caller->setParams($argv);              //参数：start | stop| status
reset($argv);

$ret = CommandRunner::getInstance()->run($caller);
if ($ret && !empty($ret->getMsg())) {
    echo $ret->getMsg() . "\n";
}
