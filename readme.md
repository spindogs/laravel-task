# Spindogs Laravel Task

This task will give you a chance to showcase your ability to deliver a workable system based on (ficticious) client requirements in an MVC manner. You will be able to demonstrate your understanding of the following key concepts:

* Routing
* Controllers
* Models & Relationships
* Migrations
* Query Builder & Collections
* Views & Templating

## Brief

A design agency needs a system built so they can manage all the support requests made by each of their customers. When a customer submits a request, a ticket will be created in the system detailing what the issue is. Anyone using the system will be able to add additional comments to each ticket which are displayed in a list on each ticket view.

> For the purposes of this task, there is no need to consider user access or authentication

To complete the task you will be required to deliver a system that contains the following things:

1. Migrations to create all required database schema
1. Interface to add new tickets to the system
1. Interface to view ticket and related comments
   1. Ability to add additional comments to each tickets
4. Interface to list all tickets added to the system
   1. Ability to filter tickets list by customer name
   1. Ability to sort tickets list by date created or date updated

## Tech stack

You will build this system in PHP using the Laravel framework and utilising MVC (model-view-controller) principles. Any frontend interfaces will be built using the Blade templating language and can use design elements from the Twitter Bootstrap framework to avoid time being spent on HTML/CSS.

https://getbootstrap.com

## Installation

Please clone this repository to your dev environment and then install the dependencies using the following command from your project root:

    composer install

You will need to create a `.env` file in your project root which will contain the details for your database connection. The quickest way of doing this is by running the following commands:

    cp .env.example .env
    php artisan key:generate

Don't forget to modify the `.env` file with your actual database connection details.

## Completion

Once you have completed the 4 deliverables described above, please commit your code to your GitHub repository and send us a link to let us know!
