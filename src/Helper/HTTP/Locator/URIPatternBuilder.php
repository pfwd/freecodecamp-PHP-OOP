<?php
namespace App\Helper\HTTP\Locator;

class URIPatternBuilder
{
    /**
     * @var string
     */
    private $raw = '';

    /**
     * @var string
     */
    private $cleaned = '';

    /**
     * @var array
     */
    private $parameters = [];

    const DELIMITER = '#';

    public function __construct(string $raw = '', array $parameters = [])
    {
        $this->raw = $raw;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }

    /**
     * @param string $raw
     * @return URIPatternBuilder
     */
    public function setRaw(string $raw): URIPatternBuilder
    {
        $this->raw = $raw;
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
     * @return URIPatternBuilder
     */
    public function setParameters(array $parameters): URIPatternBuilder
    {
        $this->parameters = $parameters;
        return $this;
    }



    /**
     * @return string
     */
    public function build(): string
    {
        $this->cleaned = $this->raw;
        foreach($this->parameters as $parameter => $pattern) {
            $this->cleaned = str_replace('{'.$parameter.'}', $pattern, $this->cleaned);
        }
        return self::DELIMITER . '^' .$this->cleaned .'$' . self::DELIMITER;
    }

}