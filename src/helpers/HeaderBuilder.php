<?php

namespace App\helpers;

class HeaderBuilder
{
    private $headers ;
    private $components;

    public function __construct()
    {
        $this->headers = [
            'css' => [
                'bootstrap' => '<link rel="stylesheet" href="/css/bootstrap.css">',
                

            ],
            'js' => [
                'jquery'        => '<script src="/js/jquery-3.5.0.min.js"></script>',
                'bootstrap'     => '<script src="/js/bootstrap.min.js"></script>',
                'react_dev'     => '<script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>',
                'react_dom_dev' => '<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>',
                'babel_jsx'     => '<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>'
            ]
        ];

        $this->read_js_list();
    }

    /**
     * reads all react components from the folder (will later be changed to load only necessary components)
     */
    private function read_js_list()
    {
        $handle = '';
        $file = '';

        if($handle = opendir(ROOTDIR . '/js/react_app'))
        {
            while(false !== ($file = readdir($handle)))
            {
                if(is_file(ROOTDIR . '/js/react_app/'. $file))
                {
                    $this->components['js'][substr($file, 0 ,-3)] = '<script src="/js/react_app/'.$file.'"></script>';
                }
            }
        }
    }

    public function get_headers()
    {
        return $this->headers;
    }

    public function get_components()
    {
        return $this->components;
    }

    public function add_to_headers(string $type, string $name, string $link)
    {
        $this->headers[$type][$name] = $link;
    }
}