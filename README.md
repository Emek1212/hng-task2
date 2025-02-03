# HNG12 Stage 1 - Number Classification API



A simple RESTful API that classifies a given number by checking if it's prime, perfect, Armstrong, and its odd/even status. It also returns the sum of its digits and a fun fact fetched from the Numbers API.

## Features
- Checks if a number is prime
- Checks if a number is perfect
- Checks if a number is an Armstrong number
- Determines if the number is odd or even
- Returns the sum of the digits
- Provides a fun fact from Numbers API

## Technology Stack
- Language: PHP
- Hosting Platform: InfinityFree

## API Endpoint

**GET** `/api/classify-number?number={number}`

Example Request:
http://hng2-task.free.nf/?number=371


### Success Response (200 OK):
```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is a narcissistic number."
}

Error Response (400 Bad Request):

{
    "error": true,
    "message": "Invalid number"
}


Setup Instructions (Running Locally)

Clone the repository:

git clone https://github.com/Emek1212/hng-task2.git



Start a local PHP server:

php -S localhost:8000


Test the API in your browser or Postman:

http://localhost:8000/api/classify-number?number=371

Deployment

The API is hosted at: http://hng2-task.free.nf/
Expected response time: < 500ms

Backlink
For PHP developers: Hire PHP Developers

