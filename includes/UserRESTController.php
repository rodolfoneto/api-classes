<?php

namespace ApiClasses\Includes;

/**
 * Description of UserRESTController
 *
 * @author rodolfoneto
 */
class UserRESTController extends \WP_REST_Controller
{
    
    public function __construct()
    {
        $this->namespace = 'api/v1';
        $this->rest_base = 'users';
    }
    
    public function register_routes()
    {
        $args = [
            [
                'methods' => \WP_REST_Server::CREATABLE,
                'callback' => [ $this, 'create_item' ],
                'permission_callback' => '__return_true',
                'args' => [
                    'name' => [
                        'description' => __( 'Name of user', 'api-classes' ),
                        'type' => 'string',
                        'required' => 'true'
                    ]
                ],
            ]
        ];
        register_rest_route( $this->namespace, '/' . $this->rest_base, $args, true );
    }
    
    public function create_item ( $request )
    {
        $user_data = json_decode( $request->get_body(), true );
        $user_name = $user_data['user_name'];
        $email = $user_data['email'];
        if ( username_exists( $user_name ) || email_exists( $email )) {
            return new \WP_REST_Response( 'user already exists', 403 );
        }

        $result = wp_insert_user( $user_data );
        
        if( is_wp_error( $result )) {
            return new \WP_REST_Response( $result, 500 );
        }
        
        return new \WP_REST_Response( $user_data, 200 );
    }
}
