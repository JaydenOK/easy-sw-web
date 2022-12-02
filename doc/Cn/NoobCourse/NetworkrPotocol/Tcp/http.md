---
title: http协议
meta:
  - name: description
    content: 超文本传输协议（HTTP，HyperText Transfer Protocol)是互联网上应用最为广泛的一种网络协议。
  - name: keywords
    content: swoole|swoole 拓展|swoole 框架|easyswoole|http协议|http|技术架构
---
## http协议

超文本传输协议（HTTP，HyperText Transfer Protocol)是互联网上应用最为广泛的一种网络协议。所有的WWW文件都必须遵守这个标准。设计HTTP最初的目的是为了提供一种发布和接收HTML页面的方法。1960年美国人Ted Nelson构思了一种通过计算机处理文本信息的方法，并称之为超文本（hypertext）,这成为了HTTP超文本传输协议标准架构的发展根基。Ted Nelson组织协调万维网协会（World Wide Web Consortium）和互联网工程工作小组（Internet Engineering Task Force ）共同合作研究，最终发布了一系列的RFC，其中著名的RFC 2616定义了HTTP 1.1。 

### 技术架构
HTTP是一个客户端和服务器端请求和应答的标准（TCP）。客户端是终端用户，服务器端是网站。通过使用Web浏览器、网络爬虫或者其它的工具，客户端发起一个到服务器上指定端口（默认端口为80）的HTTP请求。（我们称这个客户端）叫用户代理（user agent）。应答的服务器上存储着（一些）资源，比如HTML文件和图像。（我们称）这个应答服务器为源服务器（origin server）。在用户代理和源服务器中间可能存在  

多个中间层，比如代理，网关，或者隧道（tunnels）。尽管TCP/IP协议是互联网上最流行的应用，HTTP协议并没有规定必须使用它和（基于）它支持的层。 事实上，HTTP可以在任何其他互联网协议上，或者在其他网络上实现。HTTP只假定（其下层协议提供）可靠的传输，任何能够提供这种保证的协议都可以被其使用。  

通常，由HTTP客户端发起一个请求，建立一个到服务器指定端口（默认是80端口）的TCP连接。HTTP服务器则在那个端口监听客户端发送过来的请求。一旦收到请求，服务器（向客户端）发回一个状态行，比如"HTTP/1.1 200 OK"，和（响应的）消息，消息的消息体可能是请求的文件、错误消息、或者其它一些信息。  

HTTP使用TCP而不是UDP的原因在于（打开）一个网页必须传送很多数据，而TCP协议提供传输控制，按顺序组织数据，和错误纠正。  

通过HTTP或者HTTPS协议请求的资源由统一资源标示符（Uniform Resource Identifiers）（或者，更准确一些，URLs）来标识。  

![http](/Images/Passage/NoobCourse/NetworkrPotocol/tcp/http.jpg)


### 过程解析  
http一次请求的过程大概如下:
 * 用户在浏览器输入www.easyswoole.com
 * dns服务器解析/或者本机hosts,路由器hosts对比 获得ip
 * 浏览器访问默认端口80,则访问的tcp地址为  ip:80
 * tcp协议3次握手,建立连接
 * 发送一个http request请求头
 * 服务器获得http request请求头,表明该次访问为http访问,解析http请求头,获得请求类型,请求格式,以及请求数据(cookie,get,post数据)
 * 服务器发送response响应数据,主动断开
 * 浏览器接收response响应数据,解析响应文本类型,解析数据,断开连接
>https协议中,在请求以及响应时多了一层tls,ssl加密解密协议,默认端口从80变为了443 
 
 
### phper中的http
由于php大部分时候都是用于web服务器,所以php开发者接触最多的协议也就是基于tcp/ip协议的http协议了  
在php初级程序员中,其实没有详细的了解过http协议,但是可以通过浏览器的f12->network去查看http协议具体的请求头,以及服务端发送的响应头
