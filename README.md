# ![Laravel Example App]

> ### Example Laravel codebase containing real world example.
----------

# Getting started

## Installation

Clone the repository

    git clone https://github.com/1987santos/rin2.git

Switch to the repo folder

    cd rin2

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Generate the Twilio Auth id and access token from https://www.twilio.com. Set below keys in .env file from twilio

    TWILIO_AUTH_SID
    TWILIO_AUTH_TOKEN

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)
