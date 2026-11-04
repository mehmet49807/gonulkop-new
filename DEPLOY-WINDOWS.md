# Windows → GitHub → Web sunucu (Gönül Köprüsü)

Önerilen akış: **Git + GitHub Actions + FTP**.
Shared hosting (FTP var, SSH yok/zor) için en sağlam yol budur.

```
[Windows klasör]  --git push-->  [GitHub: gonulkop-new]  --Actions-->  [FTP sunucu]
```

## 1) Bir kez: GitHub Secrets

Repo: https://github.com/mehmet49807/gonulkop-new  
**Settings → Secrets and variables → Actions → New repository secret**

| Secret adı | Örnek değer |
|------------|-------------|
| `FTP_SERVER` | `ftp.gonulkoprusu.com` |
| `FTP_USERNAME` | `web@gonulkoprusu.com` (paneldeki FTP kullanıcısı) |
| `FTP_PASSWORD` | FTP parolanız |
| `FTP_SERVER_DIR` | `/public_html/` (opsiyonel, varsayılan bu) |

> `.env` dosyası **yüklenmez**. Sunucudaki `.env` elle kalır (doğru olan budur).

## 2) Bir kez: Windows'ta klasörü bağla

PowerShell veya Git Bash:

```powershell
cd C:\Yol\gonulkop-new
git init
git remote add origin https://github.com/mehmet49807/gonulkop-new.git
git branch -M main
git pull origin main --allow-unrelated-histories
```

Git yoksa: https://git-scm.com/download/win  
İsteğe bağlı GUI: **GitHub Desktop** (daha kolay).

## 3) Her güncellemede (sizin işiniz)

```powershell
cd C:\Yol\gonulkop-new
# dosyaları düzenleyin...
git add .
git status
git commit -m "Açıklayıcı mesaj"
git push origin main
```

Push sonrası: GitHub → **Actions** sekmesinde `FTP Deploy` yeşil olmalı.

## 4) Güvenlik uyarısı (önemli)

Bu repoda daha önce `.env` dosyası commit edilmiş olabilir.  
**Hemen yapın:**

1. GitHub'dan `.env` ve `.env.production` dosyalarını silin (commit ile).
2. Sunucu ve e-posta / DB şifrelerini **değiştirin** (sızmış sayın).
3. Yerelde `.env` tutun; asla `git add .env` yapmayın.

## 5) Alternatifler (ne zaman?)

| Yöntem | Ne zaman |
|--------|----------|
| **GitHub Actions + FTP** (bu repo) | Shared hosting, FTP var → **önerilen** |
| `git pull` sunucuda | SSH / terminal varsa |
| WinSCP / FileZilla elle | Acil tek dosya; günlük iş için değil |
| `auto_ftp_deploy.py` | Yerel script; CI kadar güvenilir değil |

## 6) Deploy sonrası sunucuda (gerekirse)

Hosting panelinden veya SSH ile:

```bash
php artisan migrate --force
php artisan storage:link
php artisan config:clear
```

Document root mümkünse `public/` klasörü olmalı.
