## SYMFONY API-REST

### INSTALL

Create the containers with this command:
```bash
docker-compose up -d
```

Open php container, go to the project directory and execute:

```bash
composer install
```

(Make sure you have composer 2 -> [download composer](https://getcomposer.org/download/))


Once composer is installed,

To restore the DB schema, go to the php container and execute:

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```


To add an admin user and be able to access the token, load the UserFixture with this comand

```bash
php bin/console doctrine:fixtures:load
```

Change permissions on var/
```bash
chmod -R 777 var/*
```

Once this has been done, the address [http://localhost:8060/](http://localhost:8060/) can be accessed.

JWT

Generate keys
```bash
php bin/console lexik:jwt:generate-keypair
```
Get token 
```bash
curl --location --request POST 'http://localhost:8060/api/login_check' \
--header 'Content-Type: application/json' \
--data-raw '{"username":"admin@localhost.com","password":"querty123456"}'
```

### UNIT TESTS

Add as client URL in the test class the name assigned to the container to correctly resolve the API endpoint call, 
and in the variable $token the token requested with the previous CURL. These steps are necessary as the token is valid 
for a certain period of time.
```php
$this->client = new GuzzleHttp\Client([
'base_uri' => 'http://api-rest-stock-overflow_nginx_1'
]);
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTAwNjk1MzMsImV4cCI6MTY1MDEwNTUzMywicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluQGxvY2FsaG9zdC5jb20ifQ.YL3_0HOeFfVojWqtfVs-q_9OjZdFi_MbVfcSlZL90A6T1HdP1-XEE1ByuBtKuaFCx8CSQMUzBXF6I6Y-JGXCMxqIY7og4pkUwcbpLkoH-xuKSl4RDa4UcY7WLxDerk8Up_pLqfEm6U2-NQPxApPieUblgmSECPE8yJM_Y_qwzbPjmIpN4NkJ-o1xZpAHTaqmYNFOIvShKUVobucS1usUHIeYtmFMcX_t6QcHs9Rjpt3FqhvSHiDRDBuW9e9fmiV3b8h6EPbHpVl9u1OGz_LL1vCCfYPDgpJ58uqyNVVIVgNbY7-ROgM9K7cXtzENAB66TuyoQIUZ6N243uEOgHjyNg';
```    
To run the test launch the command from the PHP container console
```bash
./vendor/bin/simple-phpunit 
```



