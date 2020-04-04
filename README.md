# _PHP SIMPLE ROUTING_
---
## Server Requirements

* PHP >= 7.1.*
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension


## Getting this up and running

### 1. _Cloning the project_
* CD into your working directory
* Open Terminal and run : git clone https://github.com/ascodelab/php-simple-routing
* cd php-simple-routing
### 2. Installing Project
* composer dump-autoload
### 4. Database Configuration
edit /config/Config.php and set database credentials ( Create database named usrt)

    host=localhost
    user=anil
    password=123456
    dbname=usrt


### 5. Importing Database ( We must use migrations/seeding but this is just a POC)

    Import : collection.sql

### 6. Run The project

    $ php -S 127.0.0.1:8000

### APIs

###### 1. Get All Posts

    GET /get HTTP/1.1
    Host: localhost:8000
    Content-Type: application/x-www-form-urlencoded
    Cache-Control: no-cache
    Postman-Token: 758386ca-c46f-6ca6-7d03-920a2e7f1fde

###### 2. Create New Post

    POST /create HTTP/1.1
    Host: localhost:8000
    Content-Type: application/x-www-form-urlencoded
    Cache-Control: no-cache
    Postman-Token: f3ea5732-d513-21c6-e53b-6d2817a7b061

    title=my+title&description=my+description

###### 3. Update Post

    PUT /update HTTP/1.1
    Host: localhost:8000
    Content-Type: application/x-www-form-urlencoded
    Cache-Control: no-cache
    Postman-Token: 850594a6-4faa-d2d7-7c52-c31741a21f5c

    title=my+title&description=my+description&id=1

###### 4. Delete Post

    DELETE /delete HTTP/1.1
    Host: localhost:8000
    Content-Type: application/x-www-form-urlencoded
    Cache-Control: no-cache
    Postman-Token: c567dc6f-220d-4639-8f4e-60ba37b4d406

    id=1









