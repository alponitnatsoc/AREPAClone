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

After php5.6 has been installed you need to instal intl, json,xml and zip with the commands:

    sudo apt-get install php5.6-intl
    sudo apt-get install php5.6-zip
    sudo apt-get install php5.6-xml
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

when te secure installation is running, you will be asked if you want to use de **_VALIDATE PASSWORD PLUGGIN_** press ```N```  to   continue, in this step you can change root password, after that press ```Y``` to disable anonimous users and then ```N```  to allow   remote connections, finally press ```Y``` two times to reload privileges and remove test database.  

__to check if mysql service is running, just type:__

```sudo service mysql status```

you should see something like this:

![mysql_server_status](http://i.imgur.com/5WJ0gEy.png)

If service is not running execute the command:

```sudo service mysql start``` 

then check again the service status.

__install mysql php PDO driver__

```sudo apt-get install php5.6-mysql```

__Now is time to install Git and composer__

    sudo apt-get install git

**composer can be a little bit tricky if you want to run it without _```composer_phar```_**

    sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    sudo php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer 
    sudo php -r "unlink('composer-setup.php');"
    
now you can run ```composer -V``` to checkout composer version or ```composer self-update``` to update composer every time you want.

__installing nodejs__

    sudo apt-get update
    sudo apt-get install nodejs
    sudo apt autoremove

__Now its time to clone the repository__

Create or navigate to a new folder that will contain the repository and run from terminal:

    git clone https://alponitnatsnoc@bitbucket.org/arepasoft/arepasoft.git
    
wait for all files been downloaded and navigate to arepasoft folder.

Incide the folder run:

    composer install
    
when asked for server host, database host and database port, you can submit the default values, but you need to specify the database   password previusly used in the mysql installation. Also, when asked for mailer_delivery parameter, you must specify a valid email for   test emails delivery.  

At the end you should get some error messages due that the database doesn't exist, so you need to run:

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force

_You can delete the database any time by running the command_ ```php bin/console doctrine:database:drop --force```

When you get your database ready, run again ```composer install```.

Once the process is finished, we need to install npm and bower running:

    Sudo apt install npm
    Sudo npm install -g bower
    
then you must run ```sudo ln -s /usr/bin/nodejs /usr/bin/node``` in order to rename nodejs command to match only node or the following   command, will not work.

    Bower install
    
_this command will update all the assets, like bootstrap and jquery libraryes_ You also can add more assets to bower.lock or just tipe:

    bower install --save asset_name
    
finally run: 
    
    composer update
    bower update 
    
thats all your proyect is ready to go by running:  ```php bin/console server:run```


Initializing the database
============

To initialize the database you need to download all the reports from javeriana peopleSoft for courses, teachers, students, faculties and classes.  
When everything is downloaded and it's placed in the correct web/Uploads/Files/ directory you can run one by one the next commands:
    
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadPlataformData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadSecurityRolesData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadDocumentTypeData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadOutcomeData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadUserData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadInitialData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadClassCourseData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/loadTeacherData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadCoursesContributesOutcomeData.php --append
  
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadCoursesData.php --append
    php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/LoadTeachersData.php --append

