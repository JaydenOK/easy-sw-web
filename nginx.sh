#http代理

# 配置EasySwoole节点 至少需要一个
upstream easyswoole {
    server 127.0.0.1:9501;
    server 127.0.0.1:9502;
    server 127.0.0.1:9503;
}

server {
    # nginx所监听端口
    listen 80;
    # 域名
    server_name proxy.easyswoole.com;

    location / {
        # 将客户端host及ip信息转发到对应节点
        proxy_set_header Host $http_host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;

        # 转发Cookie，设置 SameSite
        proxy_cookie_path / "/;";

        # 代理访问真实服务器
        proxy_pass http://easyswoole;
    }
}


##################################################################
#websocket代理

# 配置EasySwoole节点 至少需要一个
upstream easyswoole {
    # 将负载均衡模式设置为IP hash，作用：不同的客户端每次请求都会与同一节点进行交互。
    ip_hash;
    server 127.0.0.1:9501;
    server 127.0.0.1:9502;
    server 127.0.0.1:9503;
}

server {
    listen 81;
    server_name websocket.easyswoole.com;

    location / {
        # websocket的header
        proxy_http_version 1.1;

        # 升级http1.1到websocket协议
        proxy_set_header Upgrade websocket;
        proxy_set_header Connection "Upgrade";

        # 将客户端host及ip信息转发到对应节点
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_pass_request_body on;
        proxy_pass_request_headers on;

        # 客户端与服务端60s之内无交互，将自动断开连接。
        proxy_read_timeout 60s ;

        # 代理访问真实服务器
        proxy_pass http://easyswoole;
    }
}
