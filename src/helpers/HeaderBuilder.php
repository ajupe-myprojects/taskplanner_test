<?php

namespace App\helpers;

class HeaderBuilder
{
    private $headers ;

    public function __construct()
    {
        $this->headers = [
            'css' => [
                'bootstrap' => '<link rel="stylesheet" href="/css/bootstrap.css">',

            ],
            'js' => [
                'jquery'    => '<script src="/js/jquery-3.5.0.min.js"></script>',
                'bootstrap' => '<script src="/js/bootstrap.min.js"></script>'
            ]
        ];
    }

    public function get_headers()
    {
        return $this->headers;
    }

    public function add_to_headers(string $type, string $name, string $link)
    {
        $this->headers[$type][$name] = $link;
    }
}