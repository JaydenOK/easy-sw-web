<?php


namespace EasySwoole\WeChat\OfficialAccount\CustomerService;


use EasySwoole\WeChat\Kernel\ServiceContainer;
use EasySwoole\WeChat\OfficialAccount\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app[Application::CustomerService] = function (ServiceContainer $app) {
            return new Client($app);
        };

        $app[Application::CustomerServiceSession] = function (ServiceContainer $app) {
            return new SessionClient($app);
        };
    }
}
