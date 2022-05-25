<h3>Integrasi Xendit Laravel</h3>

<hr>

<h5>Lakukan sebelum digunakan : </h5>
<pre>
    1. Download Projeknya dari Github
    2. Extract
    3. Masuk ke folder projek, lalu buka commandline di folder tersebut, bisa juga dengan menggunakan
        > "cd C:\your_project"
    4. Lalu tuliskan pada commandline dibawah ini :
        > "copy .env.example .env", pengguna windows
        > "cp .env.example .env", pengguna linux
        > composer install, tunggu hingga selesai
        > php artisan key:generate
    5. Buat database bernama "xendit", lalu tulis pada commandline dibawah ini :
        > php artisan migrate
        > php artisan serve
    6. Tinggal digunakan
</pre>

<p>
    <strong>NOTE : </strong> Disini saya menyediakan core api dengan EWALLET, Virtual Account, dan QR Code/QRIS. Nanti saya akan menambahkannya lagi.
</p>
