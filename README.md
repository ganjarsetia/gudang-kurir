# Laravel Gudang

Contoh web app menggunakan laravel.

[Demo Gudang](http://gudang.aaganjar.com/)

#Requirement

 - git
 - PHP >= 5.6.4
 - composer

# Instalasi

Clone the repository using command:

    git clone https://github.com/ganjarsetia/gudang-kurir.git

    composer install
    cp .env.example .env 
    php artisan key:generate

Buat database
Edit file .env. Ubah koneksi database

    php artisan migrate
    php artisan db:seed
    chmod -R 700 storage

jalankan:

    php artisan serve

buka [http://localhost:8000/](http://localhost:8000/)

# Login
Login sebagai admin:
	
	user: admin@aaganjar.com
	pass: admin

Login Sebagai kurir

	user: kurir@aaganjar.com
	pass: kurir    


# Created By: Ganjar Setia