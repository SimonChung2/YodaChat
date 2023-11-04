# Yoda Chat Web Application

Yoda Chat is a web application that allows users to engage in conversations with the wise Jedi Master, Yoda, and receive responses in his distinctive style. This README provides an overview of the two main files that make up the application: `api_request.php` and `index.php`.

## `api_request.php`
This PHP file is responsible for making requests to the OpenAI GPT-3.5 Turbo model to obtain Yoda's responses. Here's a breakdown of the key components in `api_request.php`:


<?php
$api_key = 'API_Key'; // Replace with your OpenAI API key

// Data array with model, user message, and temperature
$data = array(
    'model' => 'gpt-3.5-turbo',
    'messages' => array(
        array('role' => 'user', 'content' => 'Respond to this in the voice of Yoda:' . $_POST['user_input'])
    ),
    'temperature' => 0.7
);

// HTTP options for the request
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\nAuthorization: Bearer $api_key",
        'method' => 'POST',
        'content' => json_encode($data)
    )
);

// Create a context and make the request to OpenAI
$context = stream_context_create($options);
$result = file_get_contents('https://api.openai.com/v1/chat/completions', false, $context);

if ($result === FALSE) {
    echo 'Error';
}

$response_data = json_decode($result, true);
echo $response_data['choices'][0]['message']['content'];

?>

Replace 'API_Key' with your actual OpenAI API key to enable communication with the GPT-3.5 Turbo model.

## index.php
The index.php file serves as the frontend of the Yoda Chat application. It allows users to input their messages and receive responses from Yoda. Here's a summary of the main features in index.php:

HTML structure and user interface elements for the chat.
JavaScript code to handle user interactions and make API requests to api_request.php.
Please note that this README provides an overview, and it's important to set up a web server with PHP support to host and run this web application successfully.

## Usage
To use the Yoda Chat web application:

Set up a web server with PHP support.
Replace 'API_Key' in api_request.php with your actual OpenAI API key.
Open the application in your web browser by visiting the index.php file.
Type your messages in the chatbox and click "Send" to converse with Yoda.
May the Force be with you in your chats with the wise Yoda!
