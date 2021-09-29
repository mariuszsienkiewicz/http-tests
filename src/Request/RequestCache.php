<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

class RequestCache
{
    private array $cache = [];

    public function add(Request $request)
    {
        if (!array_key_exists($request->getUrl()->getUrl(), $this->cache)) {
            $newCache = [
                $request->getUrl()->getUrl() => $request->getResponse(),
            ];

            $this->cache = array_merge($this->cache, $newCache);
        }
    }

    /**
     * @return null
     */
    public function get(Url $url)
    {
        if (array_key_exists($url->getUrl(), $this->cache)) {
            return $this->cache[$url->getUrl()];
        } else {
            return null;
        }
    }

    public function isInCache(Url $url)
    {
        return array_key_exists($url->getUrl(), $this->cache);
    }
}
