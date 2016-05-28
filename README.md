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

## Explanation / Comments
Rather than comment each individual class (which I feel is largely unnecessary due to the naming conventions I have followed), an explanation is below for each type of class in the [API/V1](https://github.com/SENG3150/server/blob/master/app/API/V1) folder.

### Controllers
Controllers perform the main logic for each request. Most of the controllers follow a standard structure of having ```getList```, ```get```, ```create```, ```update``` and ```delete``` methods. Some notable controllers are:

- [AuthenticateController](https://github.com/SENG3150/server/blob/master/app/API/V1/Controllers/AuthenticateController.php): This controller performs all of the logic for authentication.
- [InspectionController](https://github.com/SENG3150/server/blob/master/app/API/V1/Controllers/InspectionController.php): This controller contains methods to help load in inspection data, and also to facilitate generation of the inspection report PDF.
- [PhotoController](https://github.com/SENG3150/server/blob/master/app/API/V1/Controllers/PhotoController.php): This controller serves photos for inspections.

### Entities
Entities are the classes that map to the database, and contain all of the information that the Doctrine ORM needs to generate and read from the database. The entities have proxies generated for them to help make the system faster on each request.

### Parsers
Parsers are the classes that convert a JSON request into an entity. Each parser maps to an Entity class, and provide abstraction for the Controller classes. Some notable parsers are:

- [PhotoParser](https://github.com/SENG3150/server/blob/master/app/API/V1/Parsers/PhotoParser.php): This parser accepts and saves to file the photo data which is sent in base64 encoding.

### Providers
Providers help setup the different Laravel features that are used throughout the rest of the server. 

- [APIServiceProvider](https://github.com/SENG3150/server/blob/master/app/API/V1/Providers/APIServiceProvider.php): This is the first class loaded by the API and adds the Repositories that are used later on in Controllers through direct injection.
- [DateTimeTypeProvider](https://github.com/SENG3150/server/blob/master/app/API/V1/Providers/DateTimeTypeProvider.php): This class overrides the default Doctrine datetime column type to ensure that all datetimes are converted to the system's timezone before and after database calls.

### Repositories
Repositories add extra methods to the standard Doctrine repository, which can be helpful throughout the rest of the server. Some notable repositories are:

- [AdministratorRepository](https://github.com/SENG3150/server/blob/master/app/API/V1/Repositories/AdministratorRepository.php): This repository contains a method to find an Administrator by their username.

### Transformers
Transformers are used to convert Entities to JSON when output by a Controller. Transformers make use of [Fractal](http://fractal.thephpleague.com/transformers/)'s ```include``` feature, which allows the requester to include subentities in a single request. These includes are defined in each Transformer class, and some transformers provide a set of default includes which the requester then does not need to specifically include. Some notable transformers are:

- [CommentTransformer](https://github.com/SENG3150/server/blob/master/app/API/V1/Transformers/CommentTransformer.php): This transformer contains a lot of includes which shows how transformers are used to pull in subentities.

### Others
Some other files of note are as follows:

- [app/Http/routes.php](https://github.com/SENG3150/server/blob/master/app/Http/routes.php): This file contains all of the routes that comprise the API.
- [app/Providers/UserProvider.php](https://github.com/SENG3150/server/blob/master/app/Providers/UserProvider.php): This file contains the required methods to get the authenticated user from a token.
- [app/helpers.php](https://github.com/SENG3150/server/blob/master/app/helpers.php): This file contains a few helper methods to make development easier.

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

## Routes
Routes are available by looking at the [routes file](https://github.com/SENG3150/server/blob/master/app/Http/routes.php) and [controllers](https://github.com/SENG3150/server/tree/master/app/API/V1/Controllers).

| Method    | URI                             | Action                                                           | Protected | Version(s) |
|-----------|---------------------------------|------------------------------------------------------------------|-----------|------------|
| POST      | /auth/authenticate              | App\API\V1\Controllers\AuthenticateController@authenticate       | No        | v1         |
| GET, HEAD | /auth/refresh                   | App\API\V1\Controllers\AuthenticateController@refresh            | No        | v1         |
| GET, HEAD | /auth/me                        | App\API\V1\Controllers\UserController@me                         | Yes       | v1         |
| GET, HEAD | /actionItems                    | App\API\V1\Controllers\ActionItemController@getList              | Yes       | v1         |
| GET, HEAD | /actionItems/{id}               | App\API\V1\Controllers\ActionItemController@get                  | Yes       | v1         |
| POST      | /actionItems                    | App\API\V1\Controllers\ActionItemController@create               | Yes       | v1         |
| POST      | /actionItems/{id}               | App\API\V1\Controllers\ActionItemController@update               | Yes       | v1         |
| DELETE    | /actionItems/{id}               | App\API\V1\Controllers\ActionItemController@delete               | Yes       | v1         |
| GET, HEAD | /administrators                 | App\API\V1\Controllers\AdministratorController@getList           | Yes       | v1         |
| GET, HEAD | /administrators/{id}            | App\API\V1\Controllers\AdministratorController@get               | Yes       | v1         |
| POST      | /administrators                 | App\API\V1\Controllers\AdministratorController@create            | Yes       | v1         |
| POST      | /administrators/{id}            | App\API\V1\Controllers\AdministratorController@update            | Yes       | v1         |
| DELETE    | /administrators/{id}            | App\API\V1\Controllers\AdministratorController@delete            | Yes       | v1         |
| GET, HEAD | /comments                       | App\API\V1\Controllers\CommentController@getList                 | Yes       | v1         |
| GET, HEAD | /comments/{id}                  | App\API\V1\Controllers\CommentController@get                     | Yes       | v1         |
| POST      | /comments                       | App\API\V1\Controllers\CommentController@create                  | Yes       | v1         |
| POST      | /comments/{id}                  | App\API\V1\Controllers\CommentController@update                  | Yes       | v1         |
| DELETE    | /comments/{id}                  | App\API\V1\Controllers\CommentController@delete                  | Yes       | v1         |
| GET, HEAD | /domainExperts                  | App\API\V1\Controllers\DomainExpertController@getList            | Yes       | v1         |
| GET, HEAD | /domainExperts/{id}             | App\API\V1\Controllers\DomainExpertController@get                | Yes       | v1         |
| POST      | /domainExperts                  | App\API\V1\Controllers\DomainExpertController@create             | Yes       | v1         |
| POST      | /domainExperts/{id}             | App\API\V1\Controllers\DomainExpertController@update             | Yes       | v1         |
| DELETE    | /domainExperts/{id}             | App\API\V1\Controllers\DomainExpertController@delete             | Yes       | v1         |
| GET, HEAD | /inspections                    | App\API\V1\Controllers\InspectionController@getList              | Yes       | v1         |
| GET, HEAD | /inspections/incomplete         | App\API\V1\Controllers\InspectionController@getIncompleteList    | Yes       | v1         |
| GET, HEAD | /inspections/{id}               | App\API\V1\Controllers\InspectionController@get                  | Yes       | v1         |
| GET, HEAD | /inspections/{id}/graphs        | App\API\V1\Controllers\InspectionController@graphs               | Yes       | v1         |
| POST      | /inspections                    | App\API\V1\Controllers\InspectionController@create               | Yes       | v1         |
| POST      | /inspections/bulk               | App\API\V1\Controllers\InspectionController@createBulk           | Yes       | v1         |
| POST      | /inspections/{id}               | App\API\V1\Controllers\InspectionController@update               | Yes       | v1         |
| POST      | /inspections/{id}/bulk          | App\API\V1\Controllers\InspectionController@updateBulk           | Yes       | v1         |
| POST      | /inspections/{id}/download      | App\API\V1\Controllers\InspectionController@download             | Yes       | v1         |
| DELETE    | /inspections/{id}               | App\API\V1\Controllers\InspectionController@delete               | Yes       | v1         |
| GET, HEAD | /inspectionMajorAssemblies      | App\API\V1\Controllers\InspectionMajorAssemblyController@getList | Yes       | v1         |
| GET, HEAD | /inspectionMajorAssemblies/{id} | App\API\V1\Controllers\InspectionMajorAssemblyController@get     | Yes       | v1         |
| POST      | /inspectionMajorAssemblies      | App\API\V1\Controllers\InspectionMajorAssemblyController@create  | Yes       | v1         |
| POST      | /inspectionMajorAssemblies/{id} | App\API\V1\Controllers\InspectionMajorAssemblyController@update  | Yes       | v1         |
| DELETE    | /inspectionMajorAssemblies/{id} | App\API\V1\Controllers\InspectionMajorAssemblyController@delete  | Yes       | v1         |
| GET, HEAD | /inspectionSubAssemblies        | App\API\V1\Controllers\InspectionSubAssemblyController@getList   | Yes       | v1         |
| GET, HEAD | /inspectionSubAssemblies/{id}   | App\API\V1\Controllers\InspectionSubAssemblyController@get       | Yes       | v1         |
| POST      | /inspectionSubAssemblies        | App\API\V1\Controllers\InspectionSubAssemblyController@create    | Yes       | v1         |
| POST      | /inspectionSubAssemblies/{id}   | App\API\V1\Controllers\InspectionSubAssemblyController@update    | Yes       | v1         |
| DELETE    | /inspectionSubAssemblies/{id}   | App\API\V1\Controllers\InspectionSubAssemblyController@delete    | Yes       | v1         |
| GET, HEAD | /machines                       | App\API\V1\Controllers\MachineController@getList                 | Yes       | v1         |
| GET, HEAD | /machines/{id}                  | App\API\V1\Controllers\MachineController@get                     | Yes       | v1         |
| POST      | /machines                       | App\API\V1\Controllers\MachineController@create                  | Yes       | v1         |
| POST      | /machines/{id}                  | App\API\V1\Controllers\MachineController@update                  | Yes       | v1         |
| DELETE    | /machines/{id}                  | App\API\V1\Controllers\MachineController@delete                  | Yes       | v1         |
| GET, HEAD | /machineGeneralTests            | App\API\V1\Controllers\MachineGeneralTestController@getList      | Yes       | v1         |
| GET, HEAD | /machineGeneralTests/{id}       | App\API\V1\Controllers\MachineGeneralTestController@get          | Yes       | v1         |
| POST      | /machineGeneralTests            | App\API\V1\Controllers\MachineGeneralTestController@create       | Yes       | v1         |
| POST      | /machineGeneralTests/{id}       | App\API\V1\Controllers\MachineGeneralTestController@update       | Yes       | v1         |
| DELETE    | /machineGeneralTests/{id}       | App\API\V1\Controllers\MachineGeneralTestController@delete       | Yes       | v1         |
| GET, HEAD | /majorAssemblies                | App\API\V1\Controllers\MajorAssemblyController@getList           | Yes       | v1         |
| GET, HEAD | /majorAssemblies/{id}           | App\API\V1\Controllers\MajorAssemblyController@get               | Yes       | v1         |
| POST      | /majorAssemblies                | App\API\V1\Controllers\MajorAssemblyController@create            | Yes       | v1         |
| POST      | /majorAssemblies/{id}           | App\API\V1\Controllers\MajorAssemblyController@update            | Yes       | v1         |
| DELETE    | /majorAssemblies/{id}           | App\API\V1\Controllers\MajorAssemblyController@delete            | Yes       | v1         |
| GET, HEAD | /models                         | App\API\V1\Controllers\ModelController@getList                   | Yes       | v1         |
| GET, HEAD | /models/{id}                    | App\API\V1\Controllers\ModelController@get                       | Yes       | v1         |
| POST      | /models                         | App\API\V1\Controllers\ModelController@create                    | Yes       | v1         |
| POST      | /models/{id}                    | App\API\V1\Controllers\ModelController@update                    | Yes       | v1         |
| DELETE    | /models/{id}                    | App\API\V1\Controllers\ModelController@delete                    | Yes       | v1         |
| GET, HEAD | /oilTests                       | App\API\V1\Controllers\OilTestController@getList                 | Yes       | v1         |
| GET, HEAD | /oilTests/{id}                  | App\API\V1\Controllers\OilTestController@get                     | Yes       | v1         |
| POST      | /oilTests                       | App\API\V1\Controllers\OilTestController@create                  | Yes       | v1         |
| POST      | /oilTests/{id}                  | App\API\V1\Controllers\OilTestController@update                  | Yes       | v1         |
| DELETE    | /oilTests/{id}                  | App\API\V1\Controllers\OilTestController@delete                  | Yes       | v1         |
| GET, HEAD | /photos                         | App\API\V1\Controllers\PhotoController@getList                   | Yes       | v1         |
| GET, HEAD | /photos/{id}                    | App\API\V1\Controllers\PhotoController@get                       | Yes       | v1         |
| GET, HEAD | /photos/{id}/photo              | App\API\V1\Controllers\PhotoController@photo                     | Yes       | v1         |
| POST      | /photos                         | App\API\V1\Controllers\PhotoController@create                    | Yes       | v1         |
| POST      | /photos/{id}                    | App\API\V1\Controllers\PhotoController@update                    | Yes       | v1         |
| DELETE    | /photos/{id}                    | App\API\V1\Controllers\PhotoController@delete                    | Yes       | v1         |
| GET, HEAD | /subAssemblies                  | App\API\V1\Controllers\SubAssemblyController@getList             | Yes       | v1         |
| GET, HEAD | /subAssemblies/{id}             | App\API\V1\Controllers\SubAssemblyController@get                 | Yes       | v1         |
| POST      | /subAssemblies                  | App\API\V1\Controllers\SubAssemblyController@create              | Yes       | v1         |
| POST      | /subAssemblies/{id}             | App\API\V1\Controllers\SubAssemblyController@update              | Yes       | v1         |
| DELETE    | /subAssemblies/{id}             | App\API\V1\Controllers\SubAssemblyController@delete              | Yes       | v1         |
| GET, HEAD | /subAssemblyTests               | App\API\V1\Controllers\SubAssemblyTestController@getList         | Yes       | v1         |
| GET, HEAD | /subAssemblyTests/{id}          | App\API\V1\Controllers\SubAssemblyTestController@get             | Yes       | v1         |
| POST      | /subAssemblyTests               | App\API\V1\Controllers\SubAssemblyTestController@create          | Yes       | v1         |
| POST      | /subAssemblyTests/{id}          | App\API\V1\Controllers\SubAssemblyTestController@update          | Yes       | v1         |
| DELETE    | /subAssemblyTests/{id}          | App\API\V1\Controllers\SubAssemblyTestController@delete          | Yes       | v1         |
| GET, HEAD | /technicians                    | App\API\V1\Controllers\TechnicianController@getList              | Yes       | v1         |
| GET, HEAD | /technicians/{id}               | App\API\V1\Controllers\TechnicianController@get                  | Yes       | v1         |
| POST      | /technicians                    | App\API\V1\Controllers\TechnicianController@create               | Yes       | v1         |
| POST      | /technicians/{id}               | App\API\V1\Controllers\TechnicianController@update               | Yes       | v1         |
| DELETE    | /technicians/{id}               | App\API\V1\Controllers\TechnicianController@delete               | Yes       | v1         |
| GET, HEAD | /wearTests                      | App\API\V1\Controllers\WearTestController@getList                | Yes       | v1         |
| GET, HEAD | /wearTests/{id}                 | App\API\V1\Controllers\WearTestController@get                    | Yes       | v1         |
| POST      | /wearTests                      | App\API\V1\Controllers\WearTestController@create                 | Yes       | v1         |
| POST      | /wearTests/{id}                 | App\API\V1\Controllers\WearTestController@update                 | Yes       | v1         |
| DELETE    | /wearTests/{id}                 | App\API\V1\Controllers\WearTestController@delete                 | Yes       | v1         |