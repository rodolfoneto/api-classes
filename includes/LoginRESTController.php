<?php

namespace ApiClasses\Includes;

class LoginRESTController extends \WP_REST_Controller
{
    
    public function __construct()
    {
        $this->namespace = 'api/v1';
        $this->rest_base = 'login';
    }
    
    public function register_routes()
    {
        $args = [
            'methods' => \WP_REST_Server::READABLE,
            'args' => [
                'login' => [
                    'description' => 'login of user',
                    'required' => true,
                    'type' => 'string'
                ],
                'password' => [
                    'description' => 'password od user',
                    'required' => 'true',
                    'type' => 'string'
                ],
                '_nonce' => [
                    'required' => true,
                    'type' => 'string',
                ]
            ]
        ];
        
        register_rest_route($this->namespace, '/' . $this->rest_base, [$this, 'login'], $args);
    }
    
    public function login( \WP_REST_Request $request )
    {
        
    }
    
}
