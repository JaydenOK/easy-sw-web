---
title: 进程通信
meta:
  - name: description
    content: 进程通信 
  - name: keywords
    content: swoole|swoole 拓展|swoole 框架|easyswoole|进程|进程通信
---
## 进程通信
在各个进程中,内存空间都是不一致的,各个变量都是在不同的内存空间,举个简单的例子  

  >用户A访问服务端,$_SESSION\['user'\]=1;   
  >用户B同时访问服务端,读取$_SESSION\['user'\]是读取不到的,因为进程之间内存不是相同的  

同样,在php多进程中,pcntl_fork之后,虽然能读取到之前的变量,但这个变量是复制出来的一份,和原来那份存储位置根本不同,例如:
```php
<?php
$str = "EasySwoole\n";
$pid = pcntl_fork();
if($pid>0){
    $str="Tioncico\n";//在主进程修改了$str,不会影响到子进程的$str变量
    echo $str;
}elseif ($pid==0){
    echo $str;//$str是pcntl_fork复制出来的
}else{

}
```
所以,多进程中根本无法直接通信,那么,该怎么样才能通信呢?可以使用以下几种方式进行通信

 * 管道通信,分为有名管道,无名管道等,可自行搜索了解详细
 * 消息队列通信,使用linux消息队列,通过sysvmsg扩展,可查看:http://www.php20.cn/article/137
 * 进程信号通信,可查看:http://www.php20.cn/article/134
 * 共享内存通信,映射一段能被其他进程所访问的内存，这段共享内存由一个进程创建，但多个进程都可以访问。共享内存是最快的 IPC 方式，它是针对其他进程间通信方式运行效率低而专门设计的。它往往与其他通信机制，如信号两，配合使用，来实现进程间的同步和通信。
 * 套接字通信
 * 第三方通信,使用文件操作,mysql,redis等方法也可实现通信
 
 
可自行搜索了解详细内容 
