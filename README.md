# Smart.Extension

## Deskripsi Proyek

**Smart.Extension** adalah proyek tugas akhir yang dikembangkan oleh mahasiswa Universitas Indraprasta PGRI. Proyek ini bertujuan untuk menciptakan sistem smart home yang terjangkau dan minimalis menggunakan chip ESP-01. Sistem ini mengintegrasikan lampu pintar dan sensor DHT22 untuk memantau suhu serta kelembaban lingkungan, yang dapat dikontrol melalui aplikasi mobile atau web.

## Fitur Utama

- **Kontrol Lampu Pintar**: Mengontrol lampu melalui aplikasi mobile atau web.
- **Pemantauan Suhu dan Kelembaban**: Menggunakan sensor DHT22 untuk mendapatkan data suhu dan kelembaban secara real-time.
- **Otomatisasi**: Mengatur lampu untuk menyala atau mati berdasarkan kondisi suhu atau kelembaban tertentu.
- **Pengingat dan Notifikasi**: Memberikan notifikasi ketika suhu atau kelembaban mencapai ambang batas tertentu.
- **Integrasi dengan Platform IoT**: Sinkronisasi dengan platform IoT populer untuk analisis data dan manajemen perangkat.

## Komponen Hardware

- **ESP-01**: Chip Wi-Fi yang digunakan untuk menghubungkan sensor dan lampu ke jaringan.
- **Sensor DHT22**: Sensor untuk mengukur suhu dan kelembaban.
- **Relay**: Untuk mengendalikan aliran listrik ke lampu.

## Instalasi

1. Clone repositori ini ke komputer Anda:
    ```sh
    git clone https://github.com/muhamad-fahmi/Smart.Extension.git
    ```
2. Navigasi ke direktori proyek:
    ```sh
    cd Smart.Extension
    ```
3. Instal dependensi yang diperlukan untuk bagian perangkat lunak:
    ```sh
    npm install
    ```
4. Upload kode ke ESP-01:
    - Gunakan Arduino IDE atau alat pemrograman ESP-01 lainnya.
    - Buka file dari folder `microcontroller_code` dan upload ke ESP-01.

## Cara Penggunaan

1. Hubungkan sensor DHT22 dan lampu pintar ke ESP-01 sesuai dengan diagram yang diberikan di folder `hardware_setup`.
2. Buka aplikasi mobile atau web yang telah disediakan di folder `app`.
3. Gunakan antarmuka aplikasi untuk menyalakan/mematikan lampu dan memantau suhu serta kelembaban.

## Diagram Skematik

<img width="527" alt="image" src="https://github.com/user-attachments/assets/a29daf4d-cef3-4da1-89d9-078665dd1291">

## Design PCB

<img width="440" alt="image" src="https://github.com/user-attachments/assets/e3bf77af-5448-4215-9e94-1aa27e3b65c5">

<!-- 
## Kontribusi

Kami menerima kontribusi dari siapa saja yang tertarik untuk meningkatkan proyek ini. Untuk berkontribusi, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat branch baru untuk fitur atau perbaikan Anda (`git checkout -b fitur-anda`).
3. Commit perubahan Anda (`git commit -am 'Menambahkan fitur ABC'`).
4. Push branch ke repositori fork Anda (`git push origin fitur-anda`).
5. Buat Pull Request di GitHub.

## Tim Pengembang

- **Nama Mahasiswa 1** - [GitHub](https://github.com/username1)
- **Nama Mahasiswa 2** - [GitHub](https://github.com/username2)
- **Nama Mahasiswa 3** - [GitHub](https://github.com/username3)
- **Nama Mahasiswa 4** - [GitHub](https://github.com/username4)

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT. Lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.

## Kontak

Untuk informasi lebih lanjut atau pertanyaan, silakan hubungi kami di email@example.com. -->

---
<p align="center">
    <img src="https://seeklogo.com/images/U/universitas-indraprasta-pgri-logo-233C8D8574-seeklogo.com.png" alt="Logo Universitas Indraprasta PGRI" width="100">
</p>
