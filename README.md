<html>
<body>

<p>Untuk screenshoot juga saya sertakan di folder screenshoot<p>
<p>API ini juga saya deploy ke http://dottes.000webhostapp.com/</p>

<h5>===DAFTAR SPRINT 1====</h5>
<ol>
    <li>
        Integrasi dengan API province & city Rajaongkir (paket starter) https://rajaongkir.com/dokumentasi/starter
        <p><b>[TASK DONE] - Konfigurasi Awal</b></p>
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

<br><br>
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
        <p><b>[TASK DONE] -> Testing API di POSTMAN (Screenshoot saya sertakan difolder screenshoot)
    </li>
</ol>

<br><br>
<h5>==PANDUAN INSTALASI OFFLINE==</h5>

<ol>
    <li>
        API ini dibuat dengan menggunakan laravel 9
        <br><br>
    </li>
    <li>
        Download / clone repository https://github.com/yudo23/dot.git
        <br><br>
    </li>
    <li>
        Jalankan composer install --ignore-platform-reqs . Tunggu hingga proses download selesai
         <br><br>
    </li>
    <li>
        Jalankan php artisan jwt:secret (Ketik yes jika ada "pemberitahuan")
         <br><br>
    </li>
    <li>
        Buat database mysql dengan nama dot_tes
         <br><br>
    </li>
    <li>
        Konfigurasi database di file .env seperti dibawah ini .
        <br><br>
        DB_CONNECTION=mysql
        <br>
        DB_HOST=127.0.0.1
        <br>
        DB_PORT=3306
        <br>
        DB_DATABASE=dot_tes
        <br>
        DB_USERNAME=root
        <br>
        DB_PASSWORD=
        <br><br>
    </li>
    <li>
        Cek file .env , pastikan konfigurasi raja ongkir sudah ada , jika tidak ada silahkan ditambahkan seperti konfigurasi dibawah ini . CALL_API_FROM merupakan swapable implementation jika CALL_API_FROM=online maka akan memanggil data provinsi dan city secara online (raja ongkir) , namun jika CALL_API_FROM=database maka akan memanggil data dari database
        <br><br>
            RAJAONGKIR_API_KEY=0df6d5bf733214af6c6644eb8717c92c
        <br>
            RAJAONGKIR_PACKAGE=starter
        <br>
            CALL_API_FROM=online
        <br><br>
        Untuk CALL_API_FROM bisa online/database pilih salah satunya
        <br><br>
    </li>
    <li>
        Jalankan php artisan migrate
        <br><br>
    </li>
    <li>
        Jalankan php artisan db:seed
        <br><br>
    </li>
    <li>
        Jalakan php artisan serve
        <br><br>
    </li>
    <li>
        HIT api melalui software postman
        <br><br>
    </li>
        Login terlebih dahulu melalui http://localhost:8000/api/auth/login .Data yang dikirim dari body yaitu email dan password . Jika login berhasil maka user akan mendapatkan token aksesnya bertipe Bearer
        <br><br>
        Akun Login :
        <br>
        email : admin@gmail.com
        <br>
        password : admin
        <br><br>
    <li>
        Gunakann token tersebut ketika memanggil api provinsi,city,logout, dan refresh token yaitu dengan menambahkan Headers berupa Authorization : Bearer $token disetiap requestnya
        <br><br>
    </li>
<ol>

<br><br>
<h5>==URL HIT API OFFLINE==</h5>

<ul>
    <li>[POST]Login=http://localhost:8000/api/auth/login</li>
    <li>[GET]Logout=http://localhost:8000/api/auth/logout</li>
    <li>[GET]Refresh_token=http://localhost:8000/api/auth/refresh_token</li>
    <li>[GET]Provinsi=http://localhost:8000/api/search/province / http://localhost:8000/api/search/province?province_id=1</li>
    <li>[GET]City=http://localhost:8000/api/search/cities / http://localhost:8000/api/search/cities?city_id=1</li>
</ul>

<h5>==URL HIT API ONLINE==</h5>

<ul>
    <li>[POST]Login=http://dottes.000webhostapp.com/api/auth/login</li>
    <li>[GET]Logout=http://dottes.000webhostapp.com/api/auth/logout</li>
    <li>[GET]Refresh_token=http://dottes.000webhostapp.com/api/auth/refresh_token</li>
    <li>[GET]Provinsi=http://dottes.000webhostapp.com/api/search/province / http://dottes.000webhostapp.com/api/search/province?province_id=</li>
    <li>[GET]City=http://dottes.000webhostapp.com/api/search/cities / http://dottes.000webhostapp.com/api/search/cities?city_id=</li>
</ul>
</body>
</html>