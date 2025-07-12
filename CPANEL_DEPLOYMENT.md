# cPanel Deployment Guide for PanglimaHosting

This guide will help you deploy your Laravel PanglimaHosting application on cPanel hosting.

## Prerequisites

- cPanel hosting with PHP 8.2+ support
- MySQL database access
- SSH access (recommended) or File Manager access
- Composer support

## Method 1: Using cPanel File Manager (Manual Upload)

### Step 1: Prepare Your Application Locally

1. **Build assets locally:**
   ```bash
   npm install
   npm run build
   ```

2. **Install production dependencies:**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Create .env file:**
   - Copy `env.example` to `.env`
   - Update with your cPanel credentials

### Step 2: Upload to cPanel

1. **Access cPanel File Manager**
2. **Navigate to `public_html`** (or your subdomain directory)
3. **Upload all files** except:
   - `node_modules/` (not needed in production)
   - `.git/` directory
   - Development files

### Step 3: Set Up Database

1. **Create MySQL database in cPanel:**
   - Go to cPanel → MySQL Databases
   - Create a new database
   - Create a database user
   - Assign user to database with all privileges

2. **Update .env with database credentials:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_cpanel_db_name
   DB_USERNAME=your_cpanel_db_user
   DB_PASSWORD=your_cpanel_db_password
   ```

### Step 4: Configure Web Server

1. **Set document root** to `public_html/public` (not `public_html`)
2. **The .htaccess files are already configured** for cPanel

### Step 5: Run Deployment Commands

Use cPanel Terminal or SSH to run:

```bash
cd public_html

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Clear and cache configurations
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Create storage symlink
php artisan storage:link
```

## Method 2: Using SSH (Recommended)

### Step 1: SSH into your cPanel server

```bash
ssh username@yourdomain.com
```

### Step 2: Navigate to your domain directory

```bash
cd public_html
```

### Step 3: Clone or upload your project

```bash
# Option A: Git clone (if you have a repository)
git clone https://github.com/yourusername/panglima-hosting.git .

# Option B: Upload via SCP/SFTP from local
# (Upload files from your local machine)
```

### Step 4: Run the deployment script

```bash
# Make script executable
chmod +x cpanel-deploy.sh

# Run deployment
./cpanel-deploy.sh
```

## Method 3: Using cPanel Terminal

1. **Open Terminal in cPanel**
2. **Navigate to your domain directory**
3. **Follow the same steps as SSH method**

## Important cPanel-Specific Configuration

### 1. PHP Version
- Go to cPanel → MultiPHP Manager
- Set PHP version to 8.2 or higher
- Enable required extensions:
  - `fileinfo`
  - `openssl`
  - `pdo`
  - `mbstring`
  - `tokenizer`
  - `xml`
  - `ctype`
  - `json`

### 2. Database Configuration
- Use the database credentials provided by your cPanel host
- Database host is usually `localhost`
- Make sure the database user has all privileges

### 3. Email Configuration
Update your `.env` with cPanel email settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="PanglimaHosting"
```

### 4. Midtrans Configuration
Update your `.env` with production Midtrans settings:

```env
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

## Post-Deployment Checklist

### 1. Test the Application
- Visit your domain
- Test admin login: `/admin/login`
- Test product browsing
- Test checkout process

### 2. Configure SSL
- Enable SSL certificate in cPanel
- Update APP_URL to use HTTPS in `.env`

### 3. Set up Email
- Configure SMTP settings in `.env`
- Test order confirmation emails

### 4. Monitor Logs
- Check `storage/logs/laravel.log` for errors
- Monitor cPanel error logs

## Troubleshooting Common cPanel Issues

### 1. 500 Internal Server Error
- Check file permissions
- Verify .htaccess configuration
- Check PHP version compatibility
- Enable error reporting temporarily

### 2. Database Connection Issues
- Verify database credentials
- Check if database exists
- Ensure database user has proper permissions
- Test connection from cPanel phpMyAdmin

### 3. Asset Loading Issues
- Ensure `public/build` folder is uploaded
- Check if Vite assets are built correctly
- Verify file permissions on assets

### 4. Payment Callback Issues
- Ensure your domain is accessible from Midtrans
- Check callback URL configuration
- Verify server key is correct
- Test callback URL manually

### 5. Permission Issues
```bash
# Set proper permissions for cPanel
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
chmod 644 public/.htaccess
chmod 644 .htaccess
```

## Default Access Credentials

After deployment, you can access:
- **Admin Panel**: `https://yourdomain.com/admin/login`
- **Admin Email**: `admin@panglimahosting.com`
- **Admin Password**: `admin123`

**⚠️ Important**: Change these default credentials after first login for security!

## Security Recommendations

1. **Change default admin credentials**
2. **Enable SSL certificate**
3. **Set proper file permissions**
4. **Keep Laravel and dependencies updated**
5. **Regular backups of database and files**
6. **Monitor error logs regularly**

## Support

If you encounter issues:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Check cPanel error logs
3. Verify all configuration settings
4. Contact your hosting provider for server-specific issues 