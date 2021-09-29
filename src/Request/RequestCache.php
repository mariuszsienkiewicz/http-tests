<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

class RequestCache
{
    /** @var array $cache */
    private array $cache = array();

    /**
     * @param Request $request
     */
    public function add(Request $request)
    {
        if (!array_key_exists($request->getUrl()->getUrl(), $this->cache)) {
            $newCache = array(
                $request->getUrl()->getUrl() => $request->getResponse()
            );

            $this->cache = array_merge($this->cache, $newCache);
        }
    }

    /**
     * @param Url $url
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