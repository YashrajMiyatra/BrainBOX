

<!-- // Your OpenAI API key
$apiKey = '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'; // Replace this with your actual API key -->

<?php

$openaiApiKey = "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";

$apiUrl = "https://api.openai.com/v1/chat/completions";

$data = array(
    "model" => "gpt-3.5-turbo",
    "messages" => array(
        array(
            "role" => "system",
            "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair."
        ),
        array(
            "role" => "user",
            "content" => "Compose a poem that explains the concept of recursion in programming."
        )
    )
);

$options = array(
    "http" => array(
        "header" => "Content-Type: application/json\r\n" .
                    "Authorization: Bearer $openaiApiKey\r\n",
        "method" => "POST",
        "content" => json_encode($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($apiUrl, false, $context);

if ($result === FALSE) {
    // Handle error
    die('Error sending request to OpenAI API');
}

// Check for rate limiting (429 Too Many Requests)
$httpResponseCode = $http_response_header[0];
if (strpos($httpResponseCode, '429') !== false) {
    // Handle rate limiting error
    die('Rate limit exceeded. Please wait and try again later.');
}

// Print the result in JSON format
$jsonResult = json_decode($result, true);
echo json_encode($jsonResult, JSON_PRETTY_PRINT);

?>
