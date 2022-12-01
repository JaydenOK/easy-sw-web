<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/12/10
 * Time: 9:42
 */

namespace EasySwoole\ElasticSearch\Endpoints;


use EasySwoole\ElasticSearch\Exception\InvalidArgumentException;

class Bulk extends AbstractEndpoint
{

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($index) && isset($type)) {
            return "/$index/$type/_bulk";
        }
        if (isset($index)) {
            return "/$index/_bulk";
        }
        return "/_bulk";
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Bulk
    {
        if (isset($body) !== true) {
            return $this;
        }
        if (is_array($body) === true) {
            foreach ($body as $item) {
                $this->body .= json_encode($item) . "\n";
            }
        } elseif (is_string($body)) {
            $this->body = $body;
            if (substr($body, -1) != "\n") {
                $this->body .= "\n";
            }
        } else {
            throw new InvalidArgumentException("Body must be an array, traversable object or string");
        }
        return $this;
    }


}