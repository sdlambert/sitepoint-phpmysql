# PHP & MySQL intro

This repo contains code I worked on through the a premium course on Sitepoint entitled [PHP & MySQL Web Development for Beginners][1], by [Kevin Yank][KY].

## Lesson Breakdown

### Lesson 1
* [Today][2] - A simple example of the echo command and the built-in date function

### Lesson 3
* [Name][3] - An example of how to pass parameters and read them using the $_GET variable
* [First/Last][4] - Passing and reading two parameters
* [Form Get][5] - Passing two parameters by using the get method from within a form
* [Form Post][6] - Passing two parameters by using the post method from within a form
* [Form Pass][7] - Pass two variables to a page, then pass one of them again to a third page.

### Lesson 4

* [Ifname][8] - A simple if/else statement
* [Iffirstlast][9] - A simple if/else statement that checks two variables with 'a
* [Count10][10] - A simple if/else statement that checks two variables with 'and'
* [Count10][11]-for - A simple program that counts to ten using a while and for loop
* [Count10][12]-template - Count10 example using a PHP template with include
* [Welcome][13] - Simple controller file that loads a different template based on whether or not the input has been entered.

### Lesson 6

* [Connect][14] - Connect to the MySQL DB using mysqli.
* [Create table][15] - Connect to the database and create a table using CREATE command in an SQL query
* [Update chicken][16] - Make a single update to a row using UPDATE command in an SQL query
* [List Jokes][17] - List all the jokes using a SELECT command in an SQL query and displaying the results using a PHP template and a foreach loop

### Lesson 7
* [Add Joke][18] - Added the ability to add a joke to the DB
* [Delete Joke][19] - Added the ability to delete a joke from the DB

### Lesson 8
* [Jokes][20] - Added a second table *authors* and added the primary key as a foreign key in the *jokes* table.

### Lesson 11
* [Calculate Area][21] - A simple function example
* [Jokes][22] - The jokes database app, but now utilizing a global includes folder and functions

### Lesson 12
* [Admin Page][23] - Added general CMS administration page
* [Author Admin Page][24] - Added an administrative interface for author adds, deletes and updates
* [Categories Admin Page][25] - Added an administrative interface for category adds, deletes and updates

### Lesson 13
* [Jokes Admin Page][26] - Added new Jokes admin page

### Lesson 14
* [Joke Database CMS Interface][27] - Enhcanced the CMS page further by adding in passwords and role permissions through the use of PHP Sessions.

### Lesson 15
* [Joke Database - Final][28] - Revisited the user-facing jokes page to change the ways users can enter new jokes and introduced a new visibility feature to assist in moderating submitted jokes.

[KY]: https://github.com/sentience
[1]: https://www.sitepoint.com/premium/courses/php-mysql-web-development-for-beginners-13
[2]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson1/today.php
[3]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson3/name.html
[4]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson3/firstlast.html
[5]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson3/formget.html
[6]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson3/formpost.html
[7]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson3/formpass.html
[8]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/ifname.html
[9]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/iffirstlast.html
[10]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/count10.php
[11]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/count10-for.php
[12]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/count10
[13]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson4/welcome
[14]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson6/connect
[15]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson6/createtable
[16]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson6/updatechicken
[17]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson6/listjokes
[18]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson7/addjoke
[19]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson7/deletejoke
[20]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson8/jokes
[21]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson11/calculate-area
[22]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson11/jokes
[23]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson12/admin/
[24]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson12/admin/authors
[25]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson12/admin/categories
[26]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson13/admin/jokes
[27]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson14/admin/
[28]: https://github.com/sdlambert/sitepoint-introphp/blob/master/lesson15/