
1.Web ini dibuat dengan menggunakan laravel 9
2.Download / clone repository
3.Jalankan composer install --ignore-platform-reqs
4.Jalankan php artisan jwt:secret
5.Cek .env , pastikan konfigurasi raja ongkir sudah ada , jika tidak ada silahkan ditambahkan seperti konfigurasi dibawah ini . CALL_API_FROM merupakan swapable implementation jika CALL_API_FROM=online maka akan memanggil data provinsi dan city secara online (raja ongkir) , namun jika CALL_API_FROM=database maka akan memanggil data dari database
    RAJAONGKIR_API_KEY=0df6d5bf733214af6c6644eb8717c92c
    RAJAONGKIR_PACKAGE=starter
    CALL_API_FROM=online
6.Jalakan php artisan serve
7.Panggil api melalui software postman
8.Login terlebih dahulu melalui http://localhost:8000/api/auth/login . Jika login berhasil maka user akan mendapatkan token aksesnya bertipe Bearer
9.Gunakann token tersebut ketika memanggil api provinsi,city,logout, dan refresh token yaitu dengan menambahkan Headers berupa Autorization : Bearer $token disetiap requestnya

URL HIT API
-[POST]Login=http://localhost:8000/api/auth/login
-[GET]Logout=http://localhost:8000/api/auth/logout
-[GET]Refresh_token=http://localhost:8000/api/auth/refresh_token
-[GET]Provinsi=http://localhost:8000/api/search/province / http://localhost:8000/api/search/province?province_id=1
-[GET]City=http://localhost:8000/api/search/cities / http://localhost:8000/api/search/cities?city_id=1
