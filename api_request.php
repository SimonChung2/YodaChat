<?php
$api_key = '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'; 

$data = array(
    'model' => 'gpt-3.5-turbo',
    'messages' => array(
        array('role' => 'user', 'content' => 'Respond to this in the voice of Yoda:' . $_POST['user_input'])
    ),
    'temperature' => 0.7
);

$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\nAuthorization: Bearer $api_key",
        'method' => 'POST',
        'content' => json_encode($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents('https://api.openai.com/v1/chat/completions', false, $context);

if ($result === FALSE) {
    echo 'Error';
}

$response_data = json_decode($result, true);
echo $response_data['choices'][0]['message']['content'];
?>
