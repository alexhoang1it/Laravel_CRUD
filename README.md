# init project
composer install

# setup project
cp .env.example

# gen project key
php artisan key:generate
# run migrate
php artisan migrate
# run seeder
php artisan db:seed --class=CartSeeder 
php artisan db:seed --class=ImageSeeder 
php artisan db:seed --class=ProductImageSeeder 
php artisan db:seed --class=ProductSeeder
# run project

php artisan serve

# api list
POST localhost:8000/api/products/ -> create product
PUT localhost:8000/api/products/1 -> update product
GET localhost:8000/api/products/1 -> detail product
GET localhost:8000/api/products -> list product
GET localhost:8000/api/products/search -> search product
DELETE localhost:8000/api/products/1 -> delete product
