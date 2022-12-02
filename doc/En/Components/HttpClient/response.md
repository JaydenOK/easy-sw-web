---
title: Response
meta:
  - name: description
    content: EasySwoole Coroutine HTTPClient component
  - name: keywords
    content: swoole|swoole extension|swoole framework|easyswoole|Coroutine HTTPClient|Curl component|coroutine curl|Response
---

## Response
```php
<?php
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();
//::: warning 
//>=3.3.7,initialize:`EasySwoole\EasySwoole\Core::getInstance()->initialize()->globalInitialize();`
//:::
go(function () {
    $client = new \EasySwoole\HttpClient\HttpClient();
    $client->setUrl('http://www.baidu.com');//Set the url, note that you need http and https, https
    $client->addCookie('a','1');
    $response = $client->get();
    var_dump($response->getBody());//Get response body
    var_dump($response->getErrCode());//Get the error code
    var_dump($response->getErrMsg());//Get error message
    var_dump($response->getStatusCode());//Get response status code
    var_dump($response->getSetCookieHeaders());//Get the cookie that the response header wants to set
    var_dump($response->getCookies());//Get the cookie you sent yourself and the cookie that the response header wants to set
});

```
