<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/12/10
 * Time: 11:44
 */

namespace EasySwoole\ElasticSearch\Endpoints;


class Count extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($index) && isset($type)) {
            return "/$index/$type/_count";
        }
        if (isset($index)) {
            return "/$index/_count";
        }
        return "/_count";
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Count
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}