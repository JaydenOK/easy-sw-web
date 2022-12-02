---
title: lnmp
meta:
  - name: description
    content: Linux系统下Nginx+MySQL+PHP这种网站服务器架构。  
  - name: keywords
    content: swoole|swoole 拓展|swoole 框架|easyswoole|lnmp|nginx|mysql|php
---
## LNMP
LNMP代表的就是：Linux系统下Nginx+MySQL+PHP这种网站服务器架构。  

Linux是一类Unix计算机操作系统的统称，是目前最流行的免费操作系统。代表版本有：debian、centos、ubuntu、fedora、gentoo等。  

Nginx是一个高性能的HTTP和反向代理服务器，也是一个IMAP/POP3/SMTP代理服务器。  

Mysql是一个小型关系型数据库管理系统。    

PHP是一种在服务器端执行的嵌入HTML文档的脚本语言。  

这四种软件均为免费开源软件，组合到一起，成为一个免费、高效、扩展性强的网站服务系统。  


## 安装
lnmp环境安装有以下几种方法:
* yum,apt-get 软件包安装
* 编译安装
* 集成一键安装

由于软件包安装步骤较多,可自行搜索了解详细

### 编译安装
编译安装主要步骤为(需要有编译器):
* 下载软件源码,cd 目录
* ./configure 参数解析,配置安装位置参数,以及其他绑定参数
* make 一般情况下，只需要直接用make即可，但是有时候，生成的Makefile文件中并没有指定C编译器或者C++编译器，那么就需要手动指定了，不然就有可能出现编译错误。
* make install 
>安装php时最为复杂,需要根据需要使用的扩展,预先安装一系列的软件支持,然后在./configure中配置软件目录,配置需要开启的扩展等

可自行搜索了解详细
### 集成一键安装
集成一键安装是通过预先写好的shell脚本,里面包含了安装lnmp所有的命令(编译或软件包安装命令),以及包含了所需扩展的软件包.
集成一键安装可使用以下几种:
* lnmp集成环境:https://lnmp.org/   
* 宝塔:http://www.bt.cn/  
可自行搜索了解详细

