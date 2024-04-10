/*THE WEBSITE AND DATABASE ARE ALL RUNNING THROUGH XAMPP Control Panel v3.3.0*/

In the folder of this file are three executable files to install XAMPP (one for each operating system)
*In the installation mySQL, phpmyadmin, and Apache must be installed*

Once XAMPP is installed then launching XAMPP you will see teh option to start both an Apache module and a MySQL module.

If you start MySQL then enter localhost/phpmyadmin into your browser then the MySQL module admin page will open up.

From there on the left click the new option and enter a name for the database *This should be named the same as the file "digital_library"* if put in wrong the database connection will not be established in the php code.

Also another note on the connection if there are problems connecting from the webpage to the database the 'db_credentials.php' file has the mySQL user credentials for the db, in the phpmyadmin home page the tob nav bar has a 'User accounts' tab in this tab you can see the users and there privileges. If a proper user with privileges is put in the 'db_credentials.php' file there shouldn't be any issues.

Now you can drag the digital_library folder into the <b>htdocs</b> folder. and start the apache server

Once this is done typing "localhost/digital_library" into the browser should pring up the site starting at the home page where you can log in or look at the database of books.

There is only options to log in meaning that you can't create a profile (out of scope for the project)

There are two profiles 'hunter' and 'hunter2' in order to log in the correct username has to be inputted as well as the password. (sesame in both cases)

Once logged in you can look through the three pages and add or delete from your library.

the edit function in the library page allows for editing the your comment on the book as well as leaving a rating ot of 5.

The book div blocks, also display a rating. In the library page this is your rating and in the discover page it is an average of all users rating.

to log out simply click the log out button at the top right of any three of the pages.

Another note worth feature is the inability to enter into the personal pages unless logged in. This means that the url cannot be copied to bypass the login.

I think that about covers it

THANKS