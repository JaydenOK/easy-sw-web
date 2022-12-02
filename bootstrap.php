<?php
//全局bootstrap事件
date_default_timezone_set('Asia/Shanghai');

//注册自定义命令，Test实现了CommandInterface
//\EasySwoole\Command\CommandManager::getInstance()->addCommand(new \App\Command\Test());