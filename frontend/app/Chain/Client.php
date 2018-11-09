<?php

namespace App\Chain;

use Aws\Signature\SignatureV4;
use Aws\Credentials\Credentials;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var string uri path
     */
    protected $path;

    /**
     * Constructor
     *
     * @param string $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Obtain private data of specified Id or list item
     *
     * @param int|null $id private data ID
     * @param array $options
     * @return array
     */
    public function get($id = null, $options = [])
    {
        $uri = ($id) ? $this->getSpecifiedUri($id) : $this->getUri();
        
        $request = new Request('GET', (string)$uri, ['json' => $options]);

        return json_decode((new HttpClient)->send($request)->getBody(), true);
    }

    /**
     * Save data of specified id
     *
     * @param string $id data ID
     * @param array $data
     * @return integer 1: OK 0: FAILD
     */
    public function post(array $data, $id = null)
    {
        $uri = ($id) ? $this->getSpecifiedUri($id) : $this->getUri();

        $request = new Request('POST', (string)$uri, [], json_encode($data));

        return (new HttpClient)->send($request)->getBody();
    }

    /**
     * Get List URI
     *
     * @return string
     */
    protected function getUri()
    {
        return (new Uri($this->domain . $this->path));
    }

    /**
     * Get specified URI by ID
     *
     * @param  int    $id
     * @return string
     */
    protected function getSpecifiedUri($id)
    {
        return (new Uri($this->domain . $this->path . '/' . $id));
    }

    /**
     * Get open URI
     *
     * @return string
     */
    protected function getOpenUri()
    {
        return (new Uri($this->domain . 'Open' . $this->path));
    }
}
