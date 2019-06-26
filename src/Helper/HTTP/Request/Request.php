<?php
namespace App\Helper\HTTP\Request;

class Request
{
    /**
     * @var string
     */
    private $path = '';
    /**
     * @var string
     */
    private $method = '';

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * Request constructor.
     *
     * @param string $queryString
     * @param string $method
     */
    public function __construct(string $queryString = '', $method = '')
    {
        if( false === empty($queryString)) {
            $this->setPath($queryString);
        }

        if( false === empty($method)) {
            $this->setMethod($method);
        }
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $queryString
     * @return Request
     */
    public function setPath(string $queryString): Request
    {
        $path = parse_url($queryString, PHP_URL_PATH);
        if(false === empty($path)) {
            $this->path = $path;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function setMethod(string $method): Request
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Request
     */
    public function setParameters(array $parameters): Request
    {
        $this->parameters = $parameters;
        foreach($parameters as $key => $value) {
            $this->addParameter($key, $value);
        }
        return $this;
    }

    /**
     * @param string     $key
     * @param null|mixed $value
     * @return Request
     */
    public function addParameter(string $key, $value = null) :Request
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     *
     * @return mixed
     */
    public function getParameter(string $key, $default = null)
    {
        $value = $default;
        if(isset($this->parameters[$key])) {
            $value = $this->parameters[$key];
        }

        return $value;
    }

}