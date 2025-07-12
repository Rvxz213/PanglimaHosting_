#!/bin/bash

# PanglimaHosting Deployment Script
# This script helps deploy the application to production

echo "🚀 Deploying PanglimaHosting..."

# Check if .env exists
if [ ! -f .env ]; then
    echo "❌ .env file not found. Please create one from .env.example"
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

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Build assets (if using Vite)
if [ -f "package.json" ]; then
    echo "🎨 Building assets..."
    npm install
    npm run build
fi

echo "✅ Deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "   1. Ensure your web server is configured correctly"
echo "   2. Verify your .env configuration"
echo "   3. Test the application"
echo "   4. Set up SSL certificate"
echo ""
echo "🌐 Admin panel: https://yourdomain.com/admin/login"
echo "   Default admin: admin@panglimahosting.com / admin123" 