<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

class RequestCache
{
    /** @var array */
    private array $cache = [];

    /**
     * Add response to the cache if it is not already there.
     *
     * @param Request $request
     */
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
     * Get response from cache by url.
     *
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

    /**
     * Check if the response (identified by url) has already been cached.
     *
     * @param string $url
     * @return bool
     */
    public function isInCache(string $url): bool
    {
        return array_key_exists($url, $this->cache);
    }
}
