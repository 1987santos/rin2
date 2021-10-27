# ![Laravel Example App]

> ### Example Laravel codebase containing real world example.
----------
# Project description
The first page will show the public welcome page. We show the Login and Register button on this page on top right.

After login we can see the loggedin user dashboard.

We show the two navigations on the top left 
    
	a. User List : In this page we can see the list of users. We can filter the users. We have two buttons on this page:
	 	1. Dashboard : After clicking on this button, the new tab will be open. This will be a user dashboard on which user we have clicked. This page will display the notification of that particular user on which we have clicked which is getting displayed on top right with unread notification count before the name of the logged in user. The notification will be marked as read once we will click on that.
		2. Edit User : After clicking on this button we will be redirect on to the user edit page. From where we can edit the user information as well as notification setting of the user. (We have validated the phone number using "Twilio lookup API")
	
	b. Notification List : In this page we display the list of notifications only for those user whose notification setting is on. In this page we display the Send notification button.
		1. Send notification : After clicking on this button we weill redirect on to the send notification page from where we can send the notification to the selected users.
		
## Notification : We diaplsy the notification on the top right with unread notification count.
	1. On the user dashboard page we show the notification of that particular user on whihc we have clicked from the user list page.
	2. Apart from user dashboard we display the loggedin user notification on the header top right.

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
	
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)	

Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## How to login on the app : Pick the email from the database and the password would be the "password"    

