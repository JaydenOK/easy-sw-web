<?php


namespace EasySwoole\Command;


use EasySwoole\Command\AbstractInterface\CallerInterface;

//命令器，保存执行命令脚本，参数信息

class Caller implements CallerInterface
{
    private $script;
    private $command;
    private $params;

    public function getCommand(): string
    {
        return $this->command;
    }

    public function setCommand(string $command)
    {
        $this->command = $command;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setScript(string $script)
    {
        $this->script = $script;
    }

    public function getScript(): string
    {
        return $this->script;
    }
}