"""
GönülKop - Otomatik FTP Dağıtım İzleyici (Python + watchdog + ftplib)
"""
import os
import sys
import time
import ftplib
from pathlib import Path
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler

FTP_HOST = "ftp.gonulkoprusu.com"
FTP_USER = "web@gonulkoprusu.com"
FTP_PASS = "Mhmt498071"
REMOTE_BASE_DIR = "/public_html"
LOCAL_WATCH_DIR = r"c:\Users\mehme\Desktop\gonulkop-app"

EXCLUDE_DIRS = {".git", "node_modules", "vendor", "storage/logs",
    "storage/framework/cache", "storage/framework/sessions",
    "storage/framework/views", "storage/framework/testing",
    "bootstrap/cache", ".github", ".vscode", "docker",
    "nginx", "certbot", "__pycache__", ".idea"}

EXCLUDE_FILES = {".env", ".env.example", ".env.production", ".gitignore",
    ".gitattributes", "phpunit.xml", "README.md", "deploy.sh",
    "deploy_ftp.bat", "deploy_ftp.sh", "composer.lock",
    "package-lock.json", "auto_ftp_deploy.py", "gonulkop-deploy.zip"}

INCLUDE_EXTENSIONS = {".php", ".html", ".css", ".js", ".json", ".xml", ".txt",
    ".md", ".ico", ".png", ".jpg", ".jpeg", ".gif", ".svg",
    ".woff", ".woff2", ".ttf", ".eot", ".otf", ".env"}


def should_ignore(path):
    try:
        rel = path.relative_to(LOCAL_WATCH_DIR)
    except ValueError:
        return True
    for part in rel.parts:
        if part in EXCLUDE_DIRS:
            return True
    if path.name in EXCLUDE_FILES:
        return True
    if INCLUDE_EXTENSIONS and path.suffix.lower() not in INCLUDE_EXTENSIONS:
        return True
    return False


def remote_path_for(local_path):
    try:
        rel = local_path.relative_to(LOCAL_WATCH_DIR)
    except ValueError:
        rel = local_path
    rel_posix = rel.as_posix()
    return f"{REMOTE_BASE_DIR.rstrip('/')}/{rel_posix}".replace("//", "/")


def ftp_connect():
    ftp = ftplib.FTP()
    ftp.connect(FTP_HOST, 21, timeout=30)
    ftp.login(FTP_USER, FTP_PASS)
    return ftp


def ensure_remote_dir(ftp, remote_dir):
    dirs = remote_dir.strip("/").split("/")
    current = ""
    for d in dirs:
        current += "/" + d
        try:
            ftp.mkd(current)
        except ftplib.error_perm:
            pass


def upload_file(ftp, local_path, remote_path):
    try:
        remote_dir = os.path.dirname(remote_path)
        ensure_remote_dir(ftp, remote_dir)
        with open(local_path, "rb") as f:
            ftp.storbinary(f"STOR {remote_path}", f)
        print(f"[OK] Yuklendi: {remote_path}")
        return True
    except Exception as e:
        print(f"[HATA] Yuklenemedi: {remote_path} -> {e}")
        return False


def initial_full_upload(ftp):
    print("=" * 60)
    print("  ILK CALISMA: Tum uygun dosyalar yukleniyor...")
    print("=" * 60)
    count = 0
    for root, dirs, files in os.walk(LOCAL_WATCH_DIR):
        dirs[:] = [d for d in dirs if d not in EXCLUDE_DIRS]
        for fname in files:
            local_path = Path(root) / fname
            if should_ignore(local_path):
                continue
            remote_path = remote_path_for(local_path)
            if upload_file(ftp, local_path, remote_path):
                count += 1
    print(f"\nTamamlandi. Toplam {count} dosya yuklendi.")


class FtpDeployHandler(FileSystemEventHandler):
    def __init__(self, ftp):
        self.ftp = ftp
        self.debounce = {}

    def _handle(self, local_path):
        path = Path(local_path)
        if not path.exists() and path.is_file():
            return
        if should_ignore(path):
            return
        now = time.time()
        last = self.debounce.get(str(path), 0)
        if now - last < 2.0:
            return
        self.debounce[str(path)] = now
        remote_path = remote_path_for(path)
        print(f"\n[Degisiklik algılandı]: {path}")
        upload_file(self.ftp, path, remote_path)

    def on_modified(self, event):
        if not event.is_directory:
            self._handle(event.src_path)

    def on_created(self, event):
        if not event.is_directory:
            self._handle(event.src_path)

    def on_deleted(self, event):
        if not event.is_directory:
            print(f"[Silindi]: {event.src_path}")


def main():
    print("=" * 60)
    print("  GönülKop - Otomatik FTP Dağıtım İzleyici")
    print("=" * 60)
    print(f"Izlenen klasor: {LOCAL_WATCH_DIR}")
    print(f"FTP sunucu:     {FTP_HOST}")
    print(f"Uzak dizin:     {REMOTE_BASE_DIR}")
    print("Cikmak icin: Ctrl + C")
    print("-" * 60)
    try:
        ftp = ftp_connect()
        print("[BAGLANTI] FTP'ye baglanildi.")
    except Exception as e:
        print(f"[HATA] FTP baglanilamadi: {e}")
        sys.exit(1)
    try:
        initial_full_upload(ftp)
    except Exception as e:
        print(f"[HATA] Ilk yuklenmede sorun: {e}")
    print("-" * 60)
    print("Gozlem baslatildi. Dosya degisiklikleri bekleniyor...")
    print("-" * 60)
    event_handler = FtpDeployHandler(ftp)
    observer = Observer()
    observer.schedule(event_handler, LOCAL_WATCH_DIR, recursive=True)
    observer.start()
    try:
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
        print("\nDurduruluyor...")
        observer.stop()
    observer.join()
    ftp.quit()
    print("Baglantı kapatildi. Güle güle!")


if __name__ == "__main__":
    main()
