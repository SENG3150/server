# SENG3150 Assignment - Server

To clone the server run this command in the terminal:

	git clone https://github.com/SENG3150/server.git

## Requirements
* Install [Composer](https://getcomposer.org/).

* Install a web server with at least PHP 5.6 and setup a virtual host for the website to run in. An example httpd-vhosts.conf entry is below for Apache, which assumes you have mod_rewrite and mod_headers running:

		<VirtualHost *:80>
            ServerAdmin admin@localhost
            DocumentRoot "C:\server\public"
            ServerName seng3150.api.local
            ErrorLog "C:\seng3150-api-error.log"
            CustomLog "C:\seng3150-api-common.log" common     
            RewriteEngine on
            RewriteOptions inherit
            RewriteCond %{HTTP:Authorization} ^(.*)
            RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
            
            <IfModule mod_headers.c>
                Header set Access-Control-Allow-Origin: "*"
                Header set Access-Control-Allow-Methods: "GET, POST, DELETE, OPTIONS"
                Header set Access-Control-Allow-Headers: "Origin, X-Requested-With, Content-Type, Accept, Authorization"
                Header set Access-Control-Request-Headers: "Origin, X-Requested-With, Content-Type, Accept, Authorization"
            </IfModule>
            
            <Directory "C:\server\public">
                Options Indexes FollowSymLinks
                AllowOverride All
                Order Deny,Allow
                Deny from all
                Allow from 127.0.0.1
                Allow from ::1
                Allow from localhost
            </Directory>
        </VirtualHost>
    
    A more complete guide that our team used to get the web server (Apache through Wamp) working is as follows:
    
    - Open ```Wamp/bin/apache/apache[version]/conf/httpd.conf```
    - Ctrl+F for ```'onlineoffline'```
    - Remove the ```'Require local'``` line below it and replace it with:
    
        ```
        Require all granted
        Order Deny,Allow
        Allow from all
        ```
	        
    - Scroll a page above it and find this section:
    
        ```
        <Directory />
            AllowOverride none
            Require all granted
        </Directory>
        ```
	        
    - Comment this out by adding hashes to the front of each line:
    
        ```
        #<Directory />
        #    AllowOverride none
        #    Require all granted
        #</Directory>
        ```
    
    - Open ```Wamp/bin/apache/apache[version]/conf/extra/httpd-vhosts.conf```
    - Add this to the end of the file:
    
        ```
        <VirtualHost *:80>
            ServerAdmin admin@localhost
            DocumentRoot "<full path to server/public folder>"
            ServerName seng3150.api.local
            ErrorLog "<full path to one folder above the server folder>\seng3150-api-error.log"
            CustomLog "<full path to one folder above the server folder>\seng3150-api-common.log" common
            RewriteEngine on
            RewriteOptions inherit
		    RewriteCond %{HTTP:Authorization} ^(.*)
		    RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
		    
		    <IfModule mod_headers.c>
		        Header set Access-Control-Allow-Origin: "*"
		        Header set Access-Control-Allow-Methods: "GET, POST, DELETE, OPTIONS"
		        Header set Access-Control-Allow-Headers: "Origin, X-Requested-With, Content-Type, Accept, Authorization"
		        Header set Access-Control-Request-Headers: "Origin, X-Requested-With, Content-Type, Accept, Authorization"
		    </IfModule>
            
            <Directory "<full path to server/public folder>">
                Options Indexes FollowSymLinks
                AllowOverride All
                Order Deny,Allow
                Deny from all
                Allow from 127.0.0.1
                Allow from ::1
                Allow from localhost
            </Directory>
        </VirtualHost>
        ```
    
    - Left click on WAMP in the notifications tray, go to Apache > Apache modules > Check headers_module
    - WAMP will restart and should have a green icon
    - Open ```C:\Windows\System32\drivers\etc\hosts```
    - Add this line to the end of the file:
        
        ```
        127.0.0.1       seng3150.api.local
        ```

## Dependencies
After cloning the repository go into the directory and run the following commands in the terminal:
	
	composer install
	composer run-script setup

This will setup the project's dependencies, however you will still need to setup the database. You must first create a MySQL database, and then store its details in the .env file like so:

	DB_DATABASE=seng3150
    DB_USERNAME=root
    DB_PASSWORD=

To begin with a populated database import the SQL in the [database/sql/init.sql](https://github.com/SENG3150/server/tree/master/database/sql/init.sql) file (which assumes you named your database ```seng3150```), or to begin with a clean database run the following command in the terminal:

	php artisan doctrine:schema:create
	
The system is now ready to receive requests made against it.

## Developing The Server
As you make changes to the entities, you need to generate proxies for your entities, so that the system can load quickly for each request. To do this, run the following command in the terminal:

	php artisan doctrine:generate:proxies

This will not be necessary unless you modify the entities as their proxies are already generated and committed.

If your changes to an entity modify its database structure, you can persist this to the database by running the following command in the terminal:

	php artisan doctrine:schema:update
	
## Logging In
Make a POST request to ```/auth/authenticate``` with ```Content-Type``` set to ```application/json```. The JSON structure should look like the following:
	
	{
		type: 'administrator',
		username: 'administrator',
		password: 'password'
	}

If the response is successful, you will receive a token which you can use to make subsequent requests to the server, while remaining authenticated as the given user. To send through the token value send it in the ```Authorization``` header as follows:

	Authorization: Bearer {token}

You can use the following credentials to login successfully.

|                      | Type          | Username      | Password      |
|----------------------|---------------|---------------|---------------|
| Administrator        | administrator | administrator | administrator |
| Domain Expert        | domainexpert  | domainexpert  | domainexpert  |
| Technician           | technician    | technician    | technician    |
| Temporary Technician | technician    | temp          | technician    |

To retrieve the user details make a GET request to ```/auth/me``` and you will receive a request similar to the following:

	{
      "id": "administrator-administrator",
      "type": "administrator",
      "primary": {
        "id": 2,
        "username": "administrator",
        "name": "Administrator Administrator",
        "firstName": "Administrator",
        "lastName": "Administrator",
        "email": "administrator@example.com",
        "emailHash": "768aa9757e70b9ac63928cd3f8893ce2"
      },
      "administrator": {
        "id": 2,
        "username": "administrator",
        "name": "Administrator Administrator",
        "firstName": "Administrator",
        "lastName": "Administrator",
        "email": "administrator@example.com",
        "emailHash": "768aa9757e70b9ac63928cd3f8893ce2"
      }
    }

Other routes are available by looking at the [routes file](https://github.com/SENG3150/server/blob/master/app/Http/routes.php) and [controllers](https://github.com/SENG3150/server/tree/master/app/API/V1/Controllers).