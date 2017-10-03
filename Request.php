<?php

namespace Util;

Class Request {
    public function __construct() {
        $this->cookieFile = sprintf('%s/tmp/cookies', __DIR__);
        $this->userAgent = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0';
    }

    /**
     * Remove cookieFile if exists
     */
    public function __destruct() {
        if (file_exists($this->cookieFile)) {
            unlink($this->cookieFile);
        }
    }

    /**
     * GET request
     * @param  string   $url      Url to submit to request via GET method
     * @param  callable $callback Callback function to call after request
     * @return void
     */
    public function getRequest($url, \Closure $callback = null) {
        $ch = curl_init($url);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_COOKIEJAR      => $this->cookieFile,
                CURLOPT_COOKIEFILE     => $this->cookieFile,
                CURLOPT_USERAGENT      => $this->userAgent,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]
        );
        $this->httpResponse = curl_exec($ch);
        $this->httpInfo = curl_getinfo($ch);
        curl_close($ch);

        if (null !== $callback) {
            call_user_func_array($callback, [$this->httpResponse, $this->httpInfo]);
        }
    }

    /**
     * POST request
     * @param  string   $url      Url to submit to request via POST methods
     * @param  array    $payload  Post payload
     * @param  callable $callback Callback function to call after request
     * @return void
     */
    public function postRequest($url, array $payload, \Closure $callback = null) {
        $ch = curl_init($url);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_COOKIEJAR      => $this->cookieFile,
                CURLOPT_COOKIEFILE     => $this->cookieFile,
                CURLOPT_USERAGENT      => $this->userAgent,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($payload),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]
        );
        $this->httpResponse = curl_exec($ch);
        $this->httpInfo = curl_getinfo($ch);
        curl_close($ch);

        if (null !== $callback) {
            call_user_func_array($callback, [$this->httpResponse, $this->httpInfo]);
        }
    }

    /**
     * Get body raw from last response
     * @return string
     */
    public function getHttpResponse() {
        return $this->httpResponse;
    }

    /**
     * Get info about last response
     * @return [type] [description]
     */
    public function getHttpInfo() {
        return $this->httpInfo;
    }

    /**
     * Cookie file
     * @var string
     */
    protected $cookieFile;

    /**
     * User agent
     * @var string
     */
    protected $userAgent;

    /**
     * Http response
     * @var string
     */
    protected $httpResponse;

    /**
     * Http info
     * @var array
     */
    protected $httpInfo;

    // HTTP responses
    CONST HTTP_OK = 200; // OK
    CONST HTTP_REDIRECT = 302; // REDIRECT
    CONST HTTP_NOT_FOUND = 404; // NOT FOUND
}