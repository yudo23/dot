<html>
<body>

<h5>===DAFTAR SPRINT 1====</h5>
<ol>
    <li>
        Integrasi dengan API province & city Rajaongkir (paket starter) https://rajaongkir.com/dokumentasi/starter
        <p><b>[TASK DONE]  -> Menggunakan package https://github.com/kavist/rajaongkir</b></p>
    </li>
    <li>
        Membuat artisan command​ yg melakukan fetching API data provinsi & kota dan data disimpan ke dalam database.
        <p><b>[TASK DONE] -> Terdapat di app/database/seeders/WilayahSeeder.php (Fetch data dari rajaongkir kemudian disimpan kedatabase)</b></p>
    </li>
    <li>
        Membuat REST API untuk pencarian provinsi & kota dengan endpoint berikut
        <p><b>[TASK DONE] -> Terdapat di app/Http/Controller/API/WilayahController.php</b></p>
    </li>
</ol>

<h5>===DAFTAR SPRINT 2====</h5>
<ol>
    <li>
        Membuat sumber data pencarian province & cities bisa melalui database​ atau direct API​ raja ongkir (swapable implementation). Proses swap implementasi dapat dilakukan melalui konfigurasi tanpa merubah source code yang sudah dibuat.
        <p><b>[TASK DONE] -> Terdapat di .env dengan konfigurasi CALL_API_FROM=online/database</b></p>
    </li>
    <li>
        Menyediakan API login agar endpoint pencarian hanya bisa diakses oleh authorized user saja
        <p><b>[TASK DONE] -> JWTAuth dan Terdapat di app/Http/Controller/API/AuthController.php</b></p>
    </li>
    <li>
        Membuat unit test / API test agar web service tetap reliable & maintainable</b></p>
        <p><b>[TASK DONE] -> Testing API di POSTMAN
    </li>
</ol>




<h5>==PANDUAN INSTALASI==</h5>

<ol>
    <li>
        1.Web ini dibuat dengan menggunakan laravel 9
    </li>
    <li>
        2.Download / clone repository https://github.com/yudo23/dot.git
    </li>
    <li>
        3.Jalankan composer install --ignore-platform-reqs . Tunggu hingga proses download selesai
    </li>
    <li>
        4.Jalankan php artisan jwt:secret (Ketik yes jika ada "pemberitahuan")
    </li>
    <li>
        5.Buat database mysql dengan nama dot_tes
    </li>
    <li>
        6.Konfigurasi database di file .env seperti dibawah ini .

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=dot_tes
        DB_USERNAME=root
        DB_PASSWORD=
    </li>
    <li>
        7.Cek file .env , pastikan konfigurasi raja ongkir sudah ada , jika tidak ada silahkan ditambahkan seperti konfigurasi dibawah ini . CALL_API_FROM merupakan swapable implementation jika CALL_API_FROM=online maka akan memanggil data provinsi dan city secara online (raja ongkir) , namun jika CALL_API_FROM=database maka akan memanggil data dari database

            RAJAONGKIR_API_KEY=0df6d5bf733214af6c6644eb8717c92c
            RAJAONGKIR_PACKAGE=starter
            CALL_API_FROM=online

        Untuk CALL_API_FROM bisa online/database pilih salah satunya
    </li>
    <li>
        8.Jalankan php artisan migrate
    </li>
    <li>
        9.Jalankan php artisan db:seed
    </li>
    <li>
        10.Jalakan php artisan serve
    </li>
    <li>
        11.HIT api melalui software postman
    </li>
        12.Login terlebih dahulu melalui http://localhost:8000/api/auth/login . Jika login berhasil maka user akan mendapatkan token aksesnya bertipe Bearer

        Akun Login : 
        -Email : admin@gmail.com
        -Password : admin
    <li>
        13.Gunakann token tersebut ketika memanggil api provinsi,city,logout, dan refresh token yaitu dengan menambahkan Headers berupa Autorization : Bearer $token disetiap requestnya
    </li>
<ol>

URL HIT API
-[POST]Login=http://localhost:8000/api/auth/login
-[GET]Logout=http://localhost:8000/api/auth/logout
-[GET]Refresh_token=http://localhost:8000/api/auth/refresh_token
-[GET]Provinsi=http://localhost:8000/api/search/province / http://localhost:8000/api/search/province?province_id=1
-[GET]City=http://localhost:8000/api/search/cities / http://localhost:8000/api/search/cities?city_id=1

</body>
</html>