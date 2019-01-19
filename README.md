[See the result here:](todo.bellinder.se)
This is a Todo-list in the form of a web-application.
The Point of this is to get an understanding of th MVC concept in PHP and also get som practise in writing PHP code.
How users can get started with the project
Any questions can be directed to fred.bellinder [@] chasacademy.se
The template for this project is based on a PHP interpretation of: [TodoMVC](http://todomvc.com/examples/vanillajs/#/)
#
#
#
#
#
#
04-todo-app
A todo app in PHP.

Quickstart (vagrant)
Download and install Vagrant and Virtualbox for your operating system.
Clone this project to your machine.
cd /path-to/where/you/cloned/this.
composer install.
composer dump-autoload.
vagrant up.
Browse to adminer on http://192.168.33.10/admin/index.php.
Open up the contents of data/init.sql in your editor.
Copy the contents of data/init.sql to your clipboard.
Paste the contents of your clipboard into the SQL-command window in adminer.
Click the "Execute" button, this will create the table with three example todo items.
Now browse to http://192.168.33.10, you should see three todo-items in your list.
How to proceed
Start by familiarizing yourself with the codebase. Look inside the src/ folder. Some things to consider:

All of the routes needed to pass are already defined. You don't need to add any more.

The UI and some JS-magic is already implemented. Don't change this.

(Hint: to edit a todo-item you can double-click the title of it, this will show an input field that you can then submit using the Enter key, if you hit Escape, the changes will be reverted the same is true if you click outside the input.)

The MVC structure is also pre-defined, no need to add new files to pass this assignment.

There doesn't need to be any more separate view-files to pass this assignment.

Here's what you need to do:
You need to complete TodoController and TodoItem in order for the app to work properly.
Inside TodoController start by completing the delete() action. The corresponding model method is called deleteTodo(). In the app, when you hover over a todo item, a small "x"-symbol appears. This is an anchor-text element that will trigger the corresponding route to delete that specific todo-item.
Continue along with the other actions in TodoController and their corresponding methods in TodoItem until you're done.
When it's time to deploy to Binero
To make life easier, we'll be creating a subdomain for this hand-in on Binero. Follow along with the steps below:

Login to your Binero account.

Go to "Domän och Webbplats" > "Webbplatser"

You should have one named something along the lines of firstnamelastname.chas.academy

Press "Lägg till"

Under "Domäntyp" select "Subdomän"

In the dropdown menu select the firstnamelastname.chas.academy item.

In the box to the left of the dropdown input todo.

In the "Typ av webbplats" section, select the Linux/Apache radio-button.

In the "E-poststöd" section, select Avaktivera.

Click the Lägg till webbplats button.

Wait until the process is finished.

Now use your FTP-client of choice (e.g. FileZilla) and connect with your Binero credentials. If you've forgotten them you can create new ones under Filer > FTP.

Now, upload the contents of the public folder only, into the todo.firstnamelastname.chas.academy/public_html/ folder on Binero.

Next, in the todo.firstnamelastname.chas.academy/ folder, upload the following:

config/
src/
vendor/
composer.json
composer.lock
If you've done it correctly you should have the following structure: 

After having done this you should get an error message if you browse to http://todo.firstnamelastname.chas.academy.

To get it working you need to create a MySQL database on Binero and run the SQL to create the todos table. Here's how you do that:

Go to your Binero panel and navigate to Databaser > MySQL.
Press the Lägg till databas button.
In the Namn på databas input, simply write todo-app-db.
In the Lösenord input fields, put down a password that you'll remember.
Make sure to copy the Standardanvändare text and save that for later. It should read something like 226706_aj66261.
Press the Lägg till button.
Wait until the process in finished.
When the database is created, the table should now contain an item, for that item there should be three buttons Ändra/Visa, PHPMYADMIN and X. Press the PHPMYADMIN one.
Login with the credentials you put in from steps 4. and the username from step 5.
After login click the SQL tab.
In the input field, write the following SQL-query:
CREATE TABLE `todos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `completed` enum('false', 'true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `todos` (`title`, `created`, `completed`)
VALUES
  ('create a todo', now(), 'false'),
  ('do laundry', now(), 'false'),
  ('finish todo app', now(), 'false');
Press the Go button.
Now that you've successfully created the database and the todos table with some sample data, make sure you update the config/credentials.php file on Binero to contain the values for the setup there. Here's an example of what it could look like:

<?php
    define('DB_HOST', 'my03b.sqlserver.se');
    define('DB_USER', '226706_hs24585');
    define('DB_PASS', 'passwordgoeshere');
    define('DB_NAME', '226706-todo-app-db');
If you've folloed the steps carefully you should now be able to see the working app live at your domain http://todo.firstnamelastname.chas.academy
