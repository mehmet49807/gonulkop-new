# Windows → GitHub → Web sunucu

FTP doğrulandı: `web@gonulkoprusu.com` hesabının kökü = site dosyaları (`app`, `artisan`, …).

## GitHub Secrets (bir kez)

https://github.com/mehmet49807/gonulkop-new/settings/secrets/actions

| Secret adı | Değer |
|------------|--------|
| `FTP_SERVER` | `ftp.gonulkoprusu.com` |
| `FTP_USERNAME` | `web@gonulkoprusu.com` |
| `FTP_PASSWORD` | *(FTP parolanız — sadece Secret alanına yazın, sohbete/repoya değil)* |

Workflow `server-dir: /` kullanır (hesap kökü).

## Windows günlük kullanım

```powershell
cd C:\Yol\gonulkop-new
git add .
git commit -m "Açıklama"
git push origin main
```

Actions: https://github.com/mehmet49807/gonulkop-new/actions

## Notlar

- `.env` yüklenmez; sunucudaki `.env` kalır.
- İlk kurulumda secrets’ı ekledikten sonra **Actions → FTP Deploy → Run workflow** ile test edin.
