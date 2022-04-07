<?php 

// send POST request
function sigbro_send_post($url, $params, $timeout = 3) {
    $res = @file_get_contents($url, false, stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($params),
            'timeout' => $timeout,
        ),
    )));
    return json_decode( $res, true );
}

// send POST JSON request 
function sigbro_send_post_json($url, $params, $timeout=3, $token='anonymous') {
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $params ),
			'header'=>  "Content-Type: application/json\r\n" .
									"Accept: application/json\r\n" .
									"X-Sigbro-Token: " . $token . "\r\n" .
									"User-Agent: sigbro-auth2\r\n",

			'timeout' => $timeout
			)
	);
	
	$context  = stream_context_create( $options );
	$result = file_get_contents( $url, false, $context );
	$response = json_decode( $result, true );

	return $response;
}

// generate unique UUID
function sigbro_generate_uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

?>