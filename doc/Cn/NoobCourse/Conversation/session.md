---
title: session
meta:
  - name: description
    content: Session 对象存储特定用户会话所需的属性及配置信息
  - name: keywords
    content: swoole|swoole 拓展|swoole 框架|easyswoole|session|会话|php session
---
## Session
在计算机中，尤其是在网络应用中，称为“会话控制”。Session 对象存储特定用户会话所需的属性及配置信息。这样，当用户在应用程序的 Web 页之间跳转时，存储在 Session 对象中的变量将不会丢失，而是在整个用户会话中一直存在下去。  

当用户请求来自应用程序的 Web 页时，如果该用户还没有会话，则 Web 服务器将自动创建一个 Session 对象。当会话过期或被放弃后，服务器将终止该会话。  

注意 会话状态仅在支持 cookie 的浏览器中保留。  

### 会话实现原理
session会话的实现原理大概如下所示:
 * 用户A第一次进入,没有附带任何标识信息(通常是cookie)
 * 服务端接收请求,给与用户A一个会话标识(通常是set_cookie,cookie值将加密)
 * 服务端根据会话标识,在服务器本地存储用户信息
 * 用户A端获取到会话标识,存储到用户端本地
 * 用户A第二次请求,附带会话标识(通常是cookie)
 * 服务端通过会话标识,找到服务端相应的用户信息
 
 
### php中的session
php已经内置封装好了一个功能完整的会话管理,基础用法为:
```php
<?php
session_start();//启动新会话或者重用现有会话,发送set-cookie的响应头,告诉浏览器设置一个php_session的cookie 会话,会话id为php随机产生,并在服务器端临时目录产生一个对应的session文件
$_SESSION['a'] = 1;//存储一个关于该会话id的值
session_destroy();//销毁会话数据
//当在脚本结束时,会将超全局变量$_SESSION中的值存储进对应的session文件
```
可自行搜索了解详细内容(如自定义session_id,自定义存储方式,自定义启用会话方式等)

