<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/12/16
 * Time: 18:14
 */

namespace EasySwoole\ElasticSearch\Tests;


use EasySwoole\ElasticSearch\RequestBean\Create;
use EasySwoole\ElasticSearch\RequestBean\ExistsSource;

class ExistsSourceTest extends Base
{
    public function test()
    {

        $bean = new Create();
        $time = time();
        $bean->setIndex('my-index');
        $bean->setType('my-type');
        $bean->setId('my-id');
        $bean->setBody(['test-field' => 'abd']);
        $this->getElasticSearch()->client()->create($bean)->getBody();


        $bean = new ExistsSource();
        $bean->setIndex('my-index');
        $bean->setId('my-id');
        $response = $this->getElasticSearch()->client()->existsSource($bean);
        $this->assertEquals(200, $response->getStatusCode());
    }
}