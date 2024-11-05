<?php

/**
 * This example create a token that could be used for a permanent login to your website.
 */

require_once './jwt.class.php';

// Your private key
define( 'KUMO_KEY', 'dFnAOyDXOgF0kC3hzPFJQ7SVjdJ0qgFv9zBhZI7EQkVIJU0RfI' );

// Target user id
$user_uuid = 'dd2527f3-e936-4971-98d9-252595e7d9cd';

// New JWT instance
$jwt_engine = new JWT( private_key: KUMO_KEY );

// Generate token
$new_token = $jwt_engine->generate_token( array(
    'user' => $user_uuid,
    'ip' => $_SERVER[ 'REMOTE_ADDR' ] // Current client IP
), ( 10 * 365 * 24 * 60 * 60 ) ); // Validity 10 years

echo "Real user generated token : $new_token<br>";

if( ( $payload = $jwt_engine->verify_token( $new_token ) ) ) {
    die( "Hello " . $payload[ 'data' ][ 'user' ] ); // Valid token
} else {
    die( "This token is not valid !" ); // Invalid token
}
