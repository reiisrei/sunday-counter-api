# Sunday Counter API

## Project Overview
The Sunday Counter API is a Laravel-based web service that calculates the number of Sundays between two given dates, excluding any Sundays that fall on or after the 28th of each month.

## Features
- Input date validation
- Calculation of Sundays within a date range
- Exclusion of specific Sundays based on date conditions

## Installation
To set up the project locally, follow these steps:

1. Clone the repository:

git clone https://github.com/reiisrei/sunday-counter-api.git

2. Navigate to the project directory:

cd sunday-counter-api

3. Install dependencies:

composer install

4. Copy the `.env.example` file to `.env` and modify according to your environment:

cp .env.example .env

5. Generate an application key:

php artisan key:generate

6. Serve the application:

php artisan serve


## Usage
Make a POST request to the endpoint with the start and end dates:

### Endpoint

POST /api/count-sundays


### Request Body
```json
{
  "start_date": "YYYY-MM-DD",
  "end_date": "YYYY-MM-DD"
}

### Successful Response

```json
{
  "number_of_sundays": 5
}
