<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Enable CORS for cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (!isset($_GET['number']) || !is_numeric($_GET['number'])) {
    
    http_response_code(400); // Bad Request
    echo json_encode(["error" => true, "message" => "alphabet"]);
    exit;
}

$number = (int) $_GET['number'];

// Function to check if a number is prime
function isPrime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

// Function to check if a number is a perfect number
function isPerfect($num) {
    $sum = 0;
    for ($i = 1; $i < $num; $i++) {
        if ($num % $i == 0) $sum += $i;
    }
    return $sum == $num;
}

// Function to check if a number is an Armstrong number
function isArmstrong($num) {
    $sum = 0;
    $digits = str_split($num);
    $power = count($digits);
    foreach ($digits as $digit) {
        $sum += pow($digit, $power);
    }
    return $sum == $num;
}

$properties = [];
if (isArmstrong($number)) $properties[] = "armstrong";
$properties[] = ($number % 2 === 0) ? "even" : "odd";


$digitSum = array_sum(str_split($number));

// Get a fun fact from the Numbers API (math-related fact)
$funFact = file_get_contents("http://numbersapi.com/$number/math");

// Prepare JSON response
$response = [
    "number" => $number,
    "is_prime" => isPrime($number),
    "is_perfect" => isPerfect($number),
    "properties" => $properties,
    "digit_sum" => $digitSum,
    "fun_fact" => $funFact
];

// Set response code to 200 (Success)
http_response_code(200);

// Send the JSON response
echo json_encode($response);

?>
