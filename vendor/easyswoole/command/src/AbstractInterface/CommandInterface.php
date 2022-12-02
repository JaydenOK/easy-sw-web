<?php


namespace EasySwoole\Command\AbstractInterface;


interface CommandInterface
{
    //注册命令
    public function commandName(): string;

    //命令实际执行方法
    public function exec(): ?string;

    public function help(CommandHelpInterface $commandHelp): CommandHelpInterface;

    public function desc(): string;
}