<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/12/13
 * Time: 11:16
 */

namespace EasySwoole\ElasticSearch\Endpoints;


use EasySwoole\ElasticSearch\Exception\RuntimeException;

class UpdateByQuery extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for update_by_query'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/_update_by_query";
        }
        return "/$index/_update_by_query";
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): UpdateByQuery
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}