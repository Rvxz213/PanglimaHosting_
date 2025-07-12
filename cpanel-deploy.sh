#!/bin/bash

# PanglimaHosting cPanel Deployment Script
# This script helps deploy the application to cPanel hosting

echo "🚀 Deploying PanglimaHosting to cPanel..."

# Check if .env exists
if [ ! -f .env ]; then
    echo "❌ .env file not found. Please create one from env.example"
    echo "📝 Copy env.example to .env and update the configuration"
    exit 1
fi

# Install/Update dependencies
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
echo "📊 Running migrations..."
php artisan migrate --force

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions for cPanel
echo "🔐 Setting permissions for cPanel..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
chmod 644 public/.htaccess
chmod 644 .htaccess

# Build assets (if using Vite)
if [ -f "package.json" ]; then
    echo "🎨 Building assets..."
    npm install
    npm run build
fi

# Create storage symlink if needed
if [ ! -L "public/storage" ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link
fi

echo "✅ cPanel deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "   1. Ensure your cPanel document root points to the 'public' folder"
echo "   2. Verify your .env configuration with cPanel database credentials"
echo "   3. Test the application at your domain"
echo "   4. Set up SSL certificate in cPanel"
echo "   5. Configure email settings in cPanel"
echo ""
echo "🌐 Admin panel: https://yourdomain.com/admin/login"
echo "   Default admin: admin@panglimahosting.com / admin123"
echo ""
echo "⚠️  Important cPanel notes:"
echo "   - Make sure PHP version is 8.2+ in cPanel MultiPHP Manager"
echo "   - Ensure mod_rewrite is enabled"
echo "   - Check file permissions if you encounter issues" 