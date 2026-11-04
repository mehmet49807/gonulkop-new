# Gönül Köprüsü (`gonulkop-new`)

Laravel tabanlı tanışma platformu.

- Canlı: https://www.gonulkoprusu.com
- Admin: https://www.gonulkoprusu.com/admin/login

## Deploy (Windows → GitHub → FTP)

Adım adım: **[DEPLOY-WINDOWS.md](./DEPLOY-WINDOWS.md)**

`main` dalına push → GitHub Actions → FTP ile `/public_html/`.

## Yerel geliştirme

```bash
composer install
cp .env.example .env   # yoksa
php artisan key:generate
npm install && npm run build
php artisan serve
```

## Admin paneli kapsamı

- Genel bakış (istatistik)
- Kullanıcılar (ara, düzenle, premium/admin, sil)
- Gönderiler (yayınla / taslak, sil)
- Hikâyeler
- Mesajlar
- Süper beğeniler
- Sistem ayarları özeti
