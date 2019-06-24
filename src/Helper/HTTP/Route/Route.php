<?php
namespace App\Helper\HTTP\Route;

class Route
{
    /**
     * @var string
     */
    private $pattern = '';
    /**
     * @var string
     */
    private $controller = '';
    /**
     * @var string
     */
    private $action = '';
    /**
     * @var array
     */
    private $methods = [];

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return Route
     */
    public function setPattern(string $pattern): Route
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return Route
     */
    public function setController(string $controller): Route
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     * @return Route
     */
    public function setMethods(array $methods): Route
    {
        $this->methods = array_map('strtoupper', $methods);

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return Route
     */
    public function setAction(string $action): Route
    {
        $this->action = $action;
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
     * @return Route
     */
    public function setParameters(array $parameters): Route
    {
        $this->parameters = $parameters;
        return $this;
    }


}