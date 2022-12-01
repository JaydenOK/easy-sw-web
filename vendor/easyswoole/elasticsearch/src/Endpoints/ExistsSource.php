<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/12/11
 * Time: 13:56
 */

namespace EasySwoole\ElasticSearch\Endpoints;


use EasySwoole\ElasticSearch\Exception\RuntimeException;

class ExistsSource extends AbstractEndpoint
{

    public function getURI(): string
    {
        if (isset($this->id) !== true) {
            throw new RuntimeException(
                'id is required for exists_source'
            );
        }
        $id = $this->id;
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for exists_source'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/$id/_source";
        }
        return "/$index/_source/$id";
    }

    public function getMethod(): string
    {
        return 'HEAD';
    }

    public function setId($id): ExistsSource
    {
        if (isset($id) !== true) {
            return $this;
        }
        $this->id = $id;

        return $this;
    }
}