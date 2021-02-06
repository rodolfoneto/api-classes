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
            'callback' => [$this, 'login'],
            'permission_callback' => [$this, 'check_permition_login'],
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

        register_rest_route($this->namespace, '/' . $this->rest_base, $args);
        
        $args_nonce = [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'nonce'],
            'permission_callback' => '__return_true',
            'args' => []
        ];
        register_rest_route($this->namespace, '/' . $this->rest_base . '/nonce', $args_nonce);
    }
    
    public function check_permition_login( \WP_REST_Request $request )
    {
        $_nonce = (json_decode( $request->get_body(), true ))['_nonce'];
        return wp_verify_nonce($_nonce);
        return true;
    }
    
    public function nonce( \WP_REST_Request $request )
    {
        $nonce = wp_create_nonce();
        return new \WP_REST_Response( $nonce, 200 );
    }
    
    public function login( \WP_REST_Request $request )
    {
        $body_raw = $request->get_body();
        $body = json_decode( $body_raw, true );
        
        $result_auth = wp_authenticate( $body['login'], $body['password'] );
        
        return new \WP_REST_Response( $result_auth, 200 );
    }
    
}
