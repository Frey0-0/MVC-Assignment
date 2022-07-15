# MVC-Assignment
This is a simple Library Management System built on MVC architecture written in PHP(7.4.3).

## Requirements
You need to have a PHP interpreter, MySQL server and composer installed to run this web application.
The database connections and database queries have been handled with the help of PHP data objects.

## Dependencies
It is built on the ToroPHP web framework and the templating engine used is twig version 3.0.
It usses Composer verison 2.3.10, MySQL version 8.0.29 and Apache2 version 2.4.41 on a Linux OS Ubuntu 20.04.
The version of PHP used is 7.4.3.

You can refer its documentation on the following links:
    1. ToroPHP - https://github.com/anandkunal/ToroPHP
    2. Twig - https://twig.symfony.com/doc/

## Setup
Run ```setup.sh script``` and the application will automatically setup for you and start server on PORT ```5000``` . It will also install the required dependencies and load the database schema.To run it on any other port ```cd``` into the public folder of the repo and use the command ```php -S localhost:PORT```.

## VHost
Make a new file named `<Domain Name>.conf` in `/etc/apache2/sites-allowed`.
Paste the content from `sample-vhost.conf` into the file created earlier and change DocumentRoot and Directory as your choice.
Add `127.0.0.1    <Domain Name>` to `/etc/hosts`. 
Run the following commands 
```bash
sudo a2ensite <Domain Name>
sudo service apache2 reload
```
*The site should be running now
## Usage
* There are separate dashboards for users and admins. Each user can see the available books and the books issues by them.
* The admin approves all the checkin and checkout of books. They can also add or remove books from the library which are present in the available lot.
* The registration of user is simple but to become an admin, the request must be approved by an existing admin.
* An Admin is created automatically when you run the ```setup.sh``` whose username is ```Thor``` and the password is ```Asgard123```.