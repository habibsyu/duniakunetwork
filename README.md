# Duniaku Network Website

![Duniaku Network](https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&w=1200&h=300&fit=crop)

## 📋 Deskripsi Project

Duniaku Network Website adalah platform komunitas gaming Minecraft yang dibangun menggunakan CodeIgniter 4. Website ini menyediakan sistem manajemen pengguna berbasis role, toko online dengan pembayaran QRIS, panel admin yang lengkap, dan integrasi komunitas Discord.

### 🎯 Fitur Utama

- **Sistem Autentikasi Multi-Role** dengan 5 level permission
- **Toko Online** dengan integrasi pembayaran QRIS
- **Panel Admin** untuk manajemen konten dan pembayaran
- **Dashboard User** dengan tracking transaksi
- **Responsive Design** dengan tema dark Minecraft
- **Integrasi Discord** untuk komunitas
- **Upload Bukti Pembayaran** dengan verifikasi admin

## 🛠️ Teknologi yang Digunakan

- **Backend**: CodeIgniter 4 (PHP Framework)
- **Database**: MySQL
- **Frontend**: Bootstrap 5 + Custom CSS
- **Icons**: Font Awesome 6
- **Payment**: QRIS Integration
- **File Upload**: Native PHP

## 📁 Struktur Database

### Tabel Utama

1. **users** - Data pengguna dengan username in-game
2. **roles** - Role sistem (Admin, Staff, Moderator, Helper, User)
3. **permissions** - Daftar permission sistem
4. **role_permissions** - Mapping role ke permission
5. **admin_staff** - Data admin dan staff
6. **features** - Fitur server yang ditampilkan
7. **shop_items** - Item toko (Money Coin, Battle Pass, Gacha Key)
8. **settings** - Pengaturan website (logo, banner, QRIS)
9. **payments** - Transaksi pembayaran dengan status

### Role & Permission System

| Role | Priority | Default Permissions |
|------|----------|-------------------|
| Admin | 1 | All permissions |
| Admin Staff | 2 | manage_shop, approve_payment, edit_features, view_users, view_payments |
| Moderator | 3 | approve_payment, view_users, view_payments |
| Helper | 4 | view_users, view_payments |
| User | 5 | view_shop, upload_payment_proof |

## 🚀 Instalasi & Setup

### Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Web Server (Apache/Nginx)
- Extension PHP: mysqli, gd, intl, json, mbstring

### Langkah Instalasi

#### 1. Clone Repository
```bash
git clone https://github.com/duniaku/network-website.git
cd network-website
```

#### 2. Install Dependencies
```bash
composer install
```

#### 3. Setup Environment
```bash
# Copy file environment
cp .env.example .env

# Edit file .env sesuai konfigurasi Anda
nano .env
```

#### 4. Konfigurasi Database
Edit file `.env` dengan konfigurasi database Anda:
```env
database.default.hostname = localhost
database.default.database = duniaku_network
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

#### 5. Buat Database
```sql
CREATE DATABASE duniaku_network;
```

#### 6. Jalankan Migrasi
```bash
php spark migrate
```

#### 7. Set Permissions
```bash
# Untuk Linux/Mac
chmod -R 755 writable/
chmod -R 755 public/uploads/

# Buat folder uploads jika belum ada
mkdir -p public/uploads/payment_proofs
chmod -R 755 public/uploads/payment_proofs
```

#### 8. Jalankan Development Server
```bash
php spark serve
```

Website akan berjalan di `http://localhost:8080`

## 🔧 Konfigurasi Production

### 1. Web Server Configuration

#### Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/project/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 2. Environment Production
```env
CI_ENVIRONMENT = production
app.baseURL = 'https://your-domain.com'
```

### 3. Security Settings
- Set `app.CSRFProtection = true`
- Configure SSL certificate
- Set proper file permissions (644 for files, 755 for directories)
- Hide `.env` file dari public access

## 👥 Panduan Penggunaan

### Untuk User

#### 1. Registrasi
- Kunjungi `/auth/register`
- Masukkan username in-game yang sesuai dengan Minecraft
- Konfirmasi username sebelum submit
- Login dengan akun yang telah dibuat

#### 2. Berbelanja
- Kunjungi `/shop` setelah login
- Pilih item yang ingin dibeli
- Scan QRIS code dengan aplikasi banking
- Upload bukti pembayaran
- Tunggu verifikasi admin (1-24 jam)

#### 3. Dashboard
- Lihat status transaksi di `/dashboard`
- Monitor news dan events terbaru
- Akses quick links ke fitur lainnya

### Untuk Admin

#### 1. Login Admin
- Login dengan akun role Admin atau Admin Staff
- Akses panel admin di `/admin`

#### 2. Manajemen Pembayaran
- Kunjungi `/admin/payments`
- Review bukti pembayaran yang diupload user
- Approve atau reject transaksi
- User akan menerima item in-game setelah approved

#### 3. Manajemen Konten
- **Settings**: Edit logo, banner, QRIS image di `/admin/settings`
- **Shop Items**: CRUD item toko di `/admin/shop-items`
- **Features**: CRUD fitur server di `/admin/features`
- **Staff**: CRUD data admin/staff di `/admin/staff`

## 🎨 Kustomisasi Theme

### CSS Variables
```css
:root {
    --minecraft-dark: #1a1a1a;
    --minecraft-darker: #0f0f0f;
    --minecraft-green: #00ff41;
    --minecraft-gold: #ffaa00;
    --minecraft-blue: #5555ff;
    --minecraft-gray: #555555;
    --minecraft-light-gray: #aaaaaa;
    --minecraft-border: #333333;
}
```

### Mengganti Warna Theme
Edit variabel CSS di `app/Views/layouts/main.php` untuk mengubah skema warna.

### Menambah Custom CSS
Tambahkan CSS custom di bagian `<style>` dalam layout utama atau buat file CSS terpisah.

## 📱 Responsive Design

Website menggunakan Bootstrap 5 dengan breakpoints:
- **Mobile**: < 576px
- **Tablet**: 576px - 768px
- **Desktop**: 768px - 992px
- **Large Desktop**: > 992px

## 🔒 Keamanan

### Fitur Keamanan
- Password hashing dengan `password_hash()`
- CSRF protection (dapat diaktifkan)
- SQL injection protection via Query Builder
- File upload validation
- Role-based access control
- Input sanitization dengan `esc()`

### Best Practices
- Selalu validasi input user
- Gunakan prepared statements
- Set proper file permissions
- Regular backup database
- Monitor log files

## 🚀 Deployment

### Shared Hosting
1. Upload semua file ke public_html
2. Import database via phpMyAdmin
3. Edit `.env` dengan konfigurasi hosting
4. Set file permissions yang tepat

### VPS/Dedicated Server
1. Setup web server (Apache/Nginx)
2. Install PHP dan extensions
3. Setup database MySQL
4. Configure domain dan SSL
5. Setup cron jobs jika diperlukan

### Docker (Opsional)
```dockerfile
FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
```

## 🔧 Troubleshooting

### Error Umum

#### 1. Database Connection Error
```
Solution: Periksa konfigurasi database di .env
```

#### 2. File Upload Error
```
Solution: Periksa permissions folder uploads/ dan php.ini settings
```

#### 3. 404 Error pada Routes
```
Solution: Pastikan mod_rewrite aktif dan .htaccess configured
```

#### 4. Permission Denied
```
Solution: Set chmod 755 untuk directories dan 644 untuk files
```

### Debug Mode
Set `CI_ENVIRONMENT = development` di `.env` untuk melihat error detail.

## 📊 Monitoring & Maintenance

### Log Files
- Application logs: `writable/logs/`
- Error logs: Check web server error logs
- Database logs: MySQL slow query log

### Backup Strategy
```bash
# Database backup
mysqldump -u username -p duniaku_network > backup_$(date +%Y%m%d).sql

# File backup
tar -czf website_backup_$(date +%Y%m%d).tar.gz /path/to/website/
```

### Performance Optimization
- Enable OPcache
- Use database indexing
- Optimize images
- Enable gzip compression
- Use CDN untuk static assets

## 🤝 Contributing

### Development Workflow
1. Fork repository
2. Create feature branch
3. Make changes
4. Test thoroughly
5. Submit pull request

### Code Standards
- Follow PSR-4 autoloading
- Use CodeIgniter 4 conventions
- Comment complex logic
- Write meaningful commit messages

## 📞 Support & Contact

### Technical Support
- **Email**: admin@duniaku.net
- **Discord**: [Join our server](https://discord.gg/duniaku)
- **Website**: https://duniaku.net

### Bug Reports
Laporkan bug melalui GitHub Issues dengan informasi:
- PHP version
- Browser dan version
- Steps to reproduce
- Expected vs actual behavior
- Screenshots jika perlu

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- CodeIgniter 4 Framework
- Bootstrap 5 CSS Framework
- Font Awesome Icons
- Pexels untuk stock images
- Minecraft community untuk inspirasi design

## 📈 Roadmap

### Version 2.0 (Planned)
- [ ] API REST untuk mobile app
- [ ] Real-time notifications
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] Payment gateway integration (Midtrans)
- [ ] Automated item delivery system

### Version 1.1 (Current)
- [x] Basic user management
- [x] Shop system dengan QRIS
- [x] Admin panel
- [x] Payment verification
- [x] Responsive design

---

**© 2025 Duniaku Network. All rights reserved.**

*Experience the ultimate Minecraft adventure!*