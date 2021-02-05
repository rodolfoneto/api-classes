<?php

namespace ApiClasses\Includes;

/**
 * Description of DisableRestAPI
 *
 * @author rodolfoneto
 */
class DisableRestAPI
{
    public function disableRESTAPI( string $namespace, string $rest_name, array $endUrls)
    {
        $disableUsersRestAPI = new DisableRestAPIController( $namespace, $rest_name, $endUrls);
        $disableUsersRestAPI->register_routes();
    }
}
