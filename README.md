AREPAsoft
=========

A Symfony project created on September 12, 2016, 8:06 pm.

Installation
============

First you need to install PHP 5.6 or greater, for this go to terminal and run the following commands:

```sudo add-apt-repository ppa:ondrej/php```

__If you get the__ ```add-apt-repository: command not found``` __run:__

    sudo apt-get install software-properties-common
    sudo apt-get update
__then you can isntall php with:__

```sudo apt-get install php5.6```

you would be asked to continue, so press ```Y```

After php5.6 has been installed you need to instal intl, json and zip with the commands:

    sudo apt-get install php5.6-intl
    sudo apt-get install php5.6-zip
    sudo apt-get install php5.6-json

You may need to restart apache service and check packages installation with:

    sudo service apache2 restart
    php -m

__If everything goes fine you should se something like this:__

![php_installation_example](http://i.imgur.com/cJuI9hK.png" alt="commercial)

Next step, verify server timezone and memory limit in your ```php.ini``` file, to find your php.ini file path just run:

```php --ini```

then you can vim or nano the file and search for memory_limit and set it in something biger than 2Gb.

![memory_limit](http://i.imgur.com/1XzGR5L.png)

normally php5.6 have php tokenizer and PDO, in case you dont find them run:

    sudo apt-get install php5.6-PDO php5.6-tokenizer
    sudo service apache2 restart

__At this point you must have a fully configured php5.6 installation, now you need to install mySQL.__

first make sure your apt is up to date with:

```sudo apt-get update```

then run:

```sudo apt-get install mysql-server``` and press ```Y```

after mysql server installation you must set root password, it's __essential__ that you remeber this password for later  database configuration. 

```sudo mysql_secure_installation```

when te secure installation is running, you will be asked if you want to use de VALIDATE PASSWORD PLUGGIN  
press ```N```  to continue, in this step you can change root password, after that press ```Y``` to disable  
anonimous users and then ```N```  to allow remote connections, finally press ```Y``` two times to reload  
privileges and remove test database.

__to check if mysql service is running, just type:__

```sudo service mysql status```

you should see something like this:

![mysql_server_status](http://i.imgur.com/5WJ0gEy.png)

If service is not running execute the command:

```sudo service mysql start``` 

then check again the service status