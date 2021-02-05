<?php

namespace ApiClasses\Includes;

class DisableRestAPIController extends \WP_REST_Controller
{
    protected $endUrls;
    
    public function __construct($namespace, $rest_base, array $endUrls)
    {
        $this->namespace = $namespace;
        $this->rest_base = $rest_base;
        $this->endUrls = $endUrls;
    }
    
    public function register_routes()
    {
        
        $args = [
            [
                'method' => [\WP_REST_Server::ALLMETHODS],
                'callback' => '__return_false',
                'permission_callback' => '__return_false',
                'args'   => []
            ],
            'schema' => [&$this, 'get_public_item_schema']
        ];
        
        foreach ( $this->endUrls as $url ) {
            register_rest_route( $this->namespace, '/' . $this->rest_base . $url, $args, true );
        }
    }

}
