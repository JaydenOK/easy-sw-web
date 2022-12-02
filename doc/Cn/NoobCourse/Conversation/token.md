---
title: api/token
meta:
  - name: description
    content: token其实和session原理差不多,服务端通过给用户发送一个token,用户通过该token进行请求服务端
  - name: keywords
    content: swoole|swoole 拓展|swoole 框架|easyswoole|easyswoole token|session|会话
---
## api/token
token其实和session原理差不多,服务端通过给用户发送一个token,用户通过该token进行请求服务端,这种会话验证方式一般用于跨平台开发,以及接口开发,大概步骤为:

 * 用户A第一次进入,通过验证机制(账号密码登陆)请求服务端token
 * 服务端验证成功,给用户发送一个token(针对用户)
 * 服务端根据token,在服务端存储对应的数据(文件,mysql,redis等)
 * 用户A端获取到token,存储到用户端本地
 * 用户A请求某接口,带上token
 * 服务端通过token,验证用户有效性,返回数据
 
这种设计理念和session相差不大(无论如何变换,都是需要用户端存储相应的标识,用于给服务端解析) 

>为了安全,服务端可设定token有效时间,以及加密token,每隔一段时间变动一次token等.
