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
     * Const Success
     */
    const SUCCESS = 1;

    /**
     * Const Faild
     */
    const FAILD = 0;

    /**
     * Constructor
     *
     * @param string $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Obtain data of specified Id or list item
     *
     * @param string|null $id data ID
     * @param array $options
     * @return array
     */
    public function get($id = null, $options = [])
    {
        $uri = ($id) ? $this->getSpecifiedUri($id) : $this->getUri();

        $filter = [];
        if (!empty($options)) {
            $filter = ['filter' => json_encode(['where'=>$options])];
        }
        
        $request = new Request('GET', (string)$uri, $filter);

        try {
            return json_decode((new HttpClient)->send($request)->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Save data of specified id
     *
     * @param array $data
     * @param string|null $id data ID
     * @return integer 1: OK 0: FAILD
     */
    public function post(array $data, $id = null)
    {
        $uri = ($id) ? $this->getSpecifiedUri($id) : $this->getUri();

        $response = (new HttpClient)->request($id ? 'PUT' : 'POST', $uri, ['json' => $data]);

        return $response->getStatusCode() !== 200 ? self::FAILD : self::SUCCESS;
    }

    /**
     * Get URI
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
}
