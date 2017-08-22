# folding poetry

Folding poetry is a website for collaborating on poetry completely randomly together with complete strangers. It's basically the old game of writing a line, folding it down and passing it on. 

Since the whole project is about collaboration, I want to make the development collaborative as well.

Check out the project at [foldingpoetry.com](http://www.foldingpoetry.com), then if you enjoy it and have some ideas on how to improve it, here's how to get started

## Getting started
This project is written in PHP and thus requires a local server to be able to run. 
1. Use something like [MAMP](https://www.mamp.info/en/downloads/#mac) for mac to set up a local apache server. 
2. **Set up a MySQL database named folding_poetry**
3. **Import the database tables** from the SQL file included in the project folder. This will set up the tables and fill them with some test content.
4. In the includes folder, create a file named db.php and enter the following code:

```PHP
<?php
   $dbhost = 'HOST NAME';
   $dbuser = 'DATABASE USERNAME';
   $dbpass = 'DATABASE PASSWORD';
   $db_name = 'folding_poetry';
   $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db_name);
   
   if(! $connection ) {
     	die('Could not connect: ' . mysqli_error());
   } else {
   		mysqli_set_charset($connection,"utf8");
   }
?>
```
Exchange the names in **CAPITAL LETTERS** for the ones corresponding to your MySQL database setup.

Launch the site from your local server (will probably be something like localhost:8888/folding-poetry).


Thanks for taking interest and hope you want to contribute! Also, I'm quite new to github so any tips on how to make this project more accesible is very welcome, thanks!

Best, 
Paul


