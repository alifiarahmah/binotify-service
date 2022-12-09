# binotify-rest

Dibuat oleh:
  * Diky Restu Maulana (13520017)
  * Alifia Rahmah (13520122)
  * Andika Naufal Hilmy (13520098)

## Deskripsi singkat aplikasi
REST API untuk aplikasi [Binotify App](https://gitlab.informatika.org/if3110-2022-k02-02-58/binotify-app) dan [Binotify Premium](https://gitlab.informatika.org/if3110-2022-k02-02-58/react) menggunakan [Express.js](https://expressjs.com/), [MySQL](https://www.mysql.com/), serta [ORM Prisma](https://www.prisma.io/).

## Requirements

1. [Node.js](https://nodejs.org/en/)
2. [pnpm](https://pnpm.io/)
3. [MySQL](https://www.mysql.com/)

## Cara menjalankan
1. Clone repository ini
2. Masuk ke direktori repository
3. Jalankan perintah `pnpm install`
4. Copy file `.env.example` menjadi `.env` dan sesuaikan dengan konfigurasi database
5. Jalankan migrasi database dengan `pnpm migrate`
6. Jalankan perintah `pnpm dev` untuk menjalankan aplikasi secara _development_ atau `pnpm start` untuk menjalankan aplikasi secara _production_

## Skema Basis Data

![](/public/db.png)
```sql
CREATE TABLE `User` (
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `isAdmin` BOOLEAN NOT NULL DEFAULT false,

    PRIMARY KEY (`user_id`)
)
CREATE UNIQUE INDEX `User_email_key` ON `User`(`email`);
CREATE UNIQUE INDEX `User_username_key` ON `User`(`username`);

CREATE TABLE `Song` (
    `song_id` INTEGER NOT NULL AUTO_INCREMENT,
    `song_title` VARCHAR(255) NOT NULL,
    `penyanyi_id` INTEGER NOT NULL,
    `audio_path` VARCHAR(255) NOT NULL,

    UNIQUE INDEX `Song_penyanyi_id_key`(`penyanyi_id`),
    PRIMARY KEY (`song_id`)
)
CREATE UNIQUE INDEX `Song_song_id_key` ON `Song`(`song_id`);
```

## Endpoint, payload, dan response API
Contoh request dan response dapat dilihat pada [Dokumentasi Postman binotify-rest](https://documenter.getpostman.com/view/21666063/2s8YzL46EC)

```
GET    /artist
GET    /artist_song?artist_id=:artist_id&user_id=:user_id
POST   /
POST   /login
GET    /song/:artist_id
POST   /song/:artist_id
PATCH  /song/:artist_id/:song_id
DELETE /song/:artist_id/:song_id
GET    /subscriptions
```

## Pembagian Tugas

* Backend Binotify Premium Fungsi Login: 13520098, 13520122
* Backend Binotify Premium Fungsi Register: 13520098
* Backend Binotify Premium Fungsi Tambah lagu: 13520017, 13520122
* Backend Binotify Premium Fungsi Update lagu: 13520017, 13520122
* Backend Binotify Premium Fungsi Menghapus lagu: 13520017
* Backend Binotify Premium Fungsi Fetch list penyanyi: 13520122
* Backend Binotify Premium Fungsi Fetch lagu dari penyanyi: 13520122
* Fetch subscription dari [SOAP API](https://gitlab.informatika.org/if3110-2022-k02-02-58/soap): 13520122
* Setup database dan ORM: 13520122