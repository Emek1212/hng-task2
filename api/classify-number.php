<?php

// Set the response header to JSON (before any output)
header("Content-Type: application/json");

// Handle CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Function to check if the number is prime
function isPrime($n)
{
    if ($n <= 1) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// Function to check if the number is perfect
function isPerfect($n)
{
    $sum = 0;
    for ($i = 1; $i < $n; $i++) {
        if ($n % $i == 0) {
            $sum += $i;
        }
    }
    return $sum == $n;
}

// Function to check if the number is Armstrong
function isArmstrong($n)
{
    $digits = str_split($n);
    $numDigits = count($digits);
    $sum = 0;
    foreach ($digits as $digit) {
        $sum += pow((int)$digit, $numDigits);
    }
    return $sum == $n;
}

// Function to get the sum of digits
function getDigitSum($n)
{
    return array_sum(str_split($n));
}

// Function to get a fun fact about the number
function getFunFact($n)
{
    $response = file_get_contents("http://numbersapi.com/{$n}?json");
    $fact = json_decode($response, true);
    return isset($fact['text']) ? $fact['text'] : "No fun fact available.";
}

// Check if the 'number' parameter is set in the query string
if (isset($_GET['number'])) {
    $number = $_GET['number'];

    // Validate if the number is a valid integer
    if (!is_numeric($number)) {
        // Set the response code first before output
        http_response_code(400);  // Return Bad Request status
        echo json_encode([
            'number' => $number,
            'error' => true
        ]);
        exit;
    }

    $number = (int)$number;

    // Calculate number properties
    $isPrime = isPrime($number);
    $isPerfect = isPerfect($number);
    $isArmstrong = isArmstrong($number);
    $digitSum = getDigitSum($number);
    $funFact = getFunFact($number);

    // Determine number properties (Armstrong, Odd, Even)
    $properties = [];
    if ($isArmstrong) {
        $properties[] = "armstrong";
    }
    if ($number % 2 == 0) {
        $properties[] = "even";
    } else {
        $properties[] = "odd";
    }

    // Set response code to OK (200) first before output
    http_response_code(200);  // 200 OK

    // Return the response in JSON format
    echo json_encode([
        'number' => $number,
        'is_prime' => $isPrime,
        'is_perfect' => $isPerfect,
        'properties' => $properties,
        'digit_sum' => $digitSum,
        'fun_fact' => $funFact,
    ]);
} else {
    // If 'number' parameter is not provided
    http_response_code(400);  // Return Bad Request status

    // Set response body
    echo json_encode([
        'error' => true,
        'message' => 'Alphabet'
    ]);
}
