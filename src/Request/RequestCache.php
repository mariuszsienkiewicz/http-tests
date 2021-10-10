<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

class RequestCache
{
    private array $cache = [];

    public function add(Request $request)
    {
        if (!array_key_exists($request->getUrl(), $this->cache)) {
            $newCache = [
                $request->getUrl() => $request->getResponse(),
            ];

            $this->cache = array_merge($this->cache, $newCache);
        }
    }

    /**
     * @return null
     */
    public function get(string $url)
    {
        if (array_key_exists($url, $this->cache)) {
            return $this->cache[$url];
        } else {
            return null;
        }
    }

    public function isInCache(string $url): bool
    {
        return array_key_exists($url, $this->cache);
    }
}
