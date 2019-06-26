<?php
namespace App\Helper\HTTP\URI;

class URIBuilder
{
    /**
     * @param string $URI
     * @param array  $parameters
     *
     * @return string
     */
    public static function build(string $URI, array $parameters = []): string
    {
        foreach($parameters as $parameter => $pattern) {
            $URI = str_replace('{'.$parameter.'}', $pattern, $URI);
        }
        return '#^' .$URI.'$#';
    }

}
