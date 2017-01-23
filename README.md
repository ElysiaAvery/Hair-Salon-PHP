# Hair Salon
A web app that will allow the addition of stylists and clients who belong to those stylists.

#### By _[**Elysia Avery Nason**](https://github.com/elysiaavery)_

## Specs

Input Behavior | Input | Output
---------------|-------|--------
Can set a stylist's name and ID | Stylist (name, id); | "Siouxsie Sioux", 1
Can save a stylist to the DB | "Siouxsie Sioux", 1 | n/a
Can retrieve all stylists  | Stylist::getAll() | "Siouxsie Sioux", "Cyndi Lauper"
Can find a stylist based on ID | "Siouxsie Sioux", 1 | localhost:8080/stylists/1, "Siouxsie Sioux"
Can set a client's name, ID, and stylist ID | Client (name, id, stylist id); | "Rose McDowell", 1, 1
Can save a client to the DB | "Rose McDowell", 1, 1 | n/a
Can retrieve all clients  | Client::getAll() | "Rose McDowell", "Selena Quintanilla"
All of a stylist's clients can be retrieved | getClients(); | "Rose McDowell", "Selena Quintanilla"
Can find a client based on ID | "Selena Quintanilla", 2 | localhost:8080/clients/2, "Siouxsie Sioux"
A stylist's name can be updated | old name: "Siouxsie Sioux", new name: "Siouxsie S." | "Siouxsie S."
A client's name can be updated | old name: "Selena Quintanilla", new name: "Selena Quintanilla-Perez" | "Selena Quintanilla-Perez"
A stylist can be deleted from the DB | "Siouxsie S." delete() | n/a
When a stylist is deleted their clients are also deleted from the DB | stylist: "Siouxsie S.", 1 client: "Rose McDowell", 1, 1 delete(); | n/a

## Setup/Installation Requirements

* In your terminal window:
  * `$ git clone https://github.com/ElysiaAvery/Hair-Salon-PHP` to your Desktop.
* navigate to the project directory: `$ cd Hair-Salon-PHP`
* In a new terminal window enter: `$ composer install`
* In a separate terminal window, navigate to the web folder: `$ cd web`
  * `$ php -S localhost:8080`
* In a separate terminal window (from the top of the project directory), enter: `$ mysql.server start`
  * `$ mysql -uroot -proot`
  * `$ apachectl start`
  * Navigate to http://localhost:8080/phpmyadmin and login using root as the username and password.
  * Then click the Import tab at the top.
* Navigate to localhost:8000 in the browser of your choice. (This app was tested in Chrome).

## MySQL Commands

* `CREATE DATABASE hair_salon;`
* `USE hair_salon;`
* `CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));`
* `CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id int);`


## Known Bugs

None

## Support and contact details

Elysia Nason: _elysia.avery@gmail.com_

## Technologies Used

_PHP,
Silex,
Twig,
PHPUnit,
MySQL,
Apache_

### License

This webpage is licensed under the GPL license.

Copyright &copy; 2017 **_Elysia Avery Nason_**
