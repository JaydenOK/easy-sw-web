<?php

namespace App\Pool;

use EasySwoole\Pool\AbstractPool;
use EasySwoole\Pool\Config;

//EasySwoole\ORM\Db\MysqlPool 已实现此类，直接使用即可

class TempMysqlPool extends AbstractPool
{

    public function __construct(Config $conf)
    {

    }

    protected function createObject()
    {

    }

}
