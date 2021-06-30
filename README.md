

## Setup

* Compose install :
```
docker run --rm -v $(pwd):/app composer/composer install
```

* Set permissions for development
```
chmod -R 777 ./bootstrap/cache
chmod -R 777 ./storage
```

* Run docker container with specified service in docker-compose.yml
```
docker-compose up
```

* Environment file :
`cp .env-example .env`

* Generate key:
```
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan cache:clear
```

* Create database `homestead` and give permissions to user `homestead` with password `secret` in database container 

* Migrate database
`docker-compose exec app php artisan migrate --seed`

* Run tests 
`docker-compose run app /var/www/vendor/phpunit/phpunit/phpunit --configuration /var/www/phpunit.xml`

4. Laravel should be available http://0.0.0.0:8080

## Assigment information
* There is no time limit, except duration of our recruitment process (which is until we find someone we like)
* We will send you a feedback even if you won't meet out requirements as thank you for taking the time to do this assigment
* Bootstrap configuration should work out-of-the box in any environment capable running docker 
* If any problems arise, there will be bonus points for getting it to run correctly and explaining what went wrong

## Assigment requirements 
* Finished project will expose endpoints for `cart` & `product` adhering to REST principles, both allowing all CRUD operations
* Each `product` have to specify it's price and currency
* Each `cart` have to specify it's currency
* We have to be able to add `product` to `cart`
* `cart` will accept only products with matching currency
* Endpoints for `cart` have to return total value of products in the cart and average price of products in cart
* We expect that provided requirements will be covered by tests 
* There is no need to provide any kind of authorization/authentication
* There is no need to provide any kind of UI for this project 
* We will be checking your assigment using Insomia/Postman
 