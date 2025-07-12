# PanglimaHosting - Laravel Hosting Service Application

A complete Laravel-based hosting service application with VPS and shared hosting products, integrated payment processing, and admin management system.

## Features

### 🚀 Core Features
- **Product Management**: VPS and Shared Hosting products with detailed features
- **Shopping Cart**: Session-based cart system for multiple products
- **Payment Integration**: Midtrans payment gateway integration
- **Order Management**: Complete order lifecycle management
- **Admin Panel**: Full admin interface for managing products and orders
- **Email Notifications**: Order confirmation emails
- **Responsive Design**: Modern UI with Tailwind CSS

### 🛒 E-commerce Features
- Product catalog with filtering by type
- Shopping cart functionality
- Secure checkout process
- Payment status tracking
- Order history and management

### 👨‍💼 Admin Features
- Dashboard with analytics
- Product CRUD operations
- Order management and status updates
- Customer information tracking
- Payment status monitoring

## Technology Stack

- **Backend**: Laravel 12.x
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Payment**: Midtrans Payment Gateway
- **Email**: Laravel Mail
- **Authentication**: Laravel's built-in auth system

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/PostgreSQL
- Node.js (for asset compilation)

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd panglima-hosting
```

### Step 2: Install Dependencies
```bash
composer install
npm install
```

### Step 3: Environment Setup
```bash
cp env.example .env
php artisan key:generate
```

### Step 4: Configure Database
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=panglima_hosting
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Configure Midtrans
Add your Midtrans credentials to `.env`:
```env
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### Step 6: Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### Step 7: Build Assets
```bash
npm run build
```

### Step 8: Start the Application
```bash
php artisan serve
```

## cPanel Deployment

### Quick Deployment
1. **Upload files** to your cPanel `public_html` directory
2. **Copy `env.example` to `.env`** and update with your cPanel credentials
3. **Run the deployment script:**
   ```bash
   chmod +x cpanel-deploy.sh
   ./cpanel-deploy.sh
   ```

### Detailed cPanel Guide
See [CPANEL_DEPLOYMENT.md](CPANEL_DEPLOYMENT.md) for complete step-by-step instructions.

### Important cPanel Files
- `.htaccess` - Root directory redirect for cPanel
- `public/.htaccess` - Laravel URL rewriting
- `cpanel-deploy.sh` - Automated deployment script
- `env.example` - cPanel-ready environment template

## Default Credentials

### Admin Account
- **Email**: admin@panglimahosting.com
- **Password**: admin123

### Test User Account
- **Email**: test@example.com
- **Password**: password

## Database Structure

### Tables
- `users` - User accounts (admin)
- `products` - VPS and hosting products
- `orders` - Customer orders
- `payments` - Payment records

### Sample Data
The application comes with sample products:
- **VPS Basic**: 1 Core, 1GB RAM, 20GB SSD
- **VPS Standard**: 2 Core, 4GB RAM, 50GB SSD
- **VPS Premium**: 4 Core, 8GB RAM, 100GB SSD
- **Shared Hosting Basic**: 1GB Storage, 10GB Bandwidth
- **Shared Hosting Pro**: 5GB Storage, 50GB Bandwidth
- **Shared Hosting Business**: 20GB Storage, 200GB Bandwidth

## API Endpoints

### Frontend Routes
- `GET /` - Home page
- `GET /products` - Product catalog
- `GET /products/{product}` - Product detail
- `GET /cart` - Shopping cart
- `POST /cart/add` - Add to cart
- `DELETE /cart/{id}` - Remove from cart
- `GET /checkout` - Checkout page
- `POST /checkout/process` - Process checkout

### Admin Routes
- `GET /admin/login` - Admin login
- `POST /admin/login` - Admin authentication
- `GET /admin` - Admin dashboard
- `GET /admin/products` - Product management
- `GET /admin/orders` - Order management

### Payment Routes
- `POST /payment/callback` - Midtrans callback
- `GET /payment/success` - Payment success page
- `GET /payment/failed` - Payment failed page

## Configuration

### Midtrans Configuration
The application uses Midtrans for payment processing. Configure the following in your `.env`:

```env
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### Email Configuration
Configure your email settings in `.env` for order confirmations:

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@panglimahosting.com
MAIL_FROM_NAME="PanglimaHosting"
```

## Usage

### For Customers
1. Browse products on the homepage
2. Add products to cart
3. Proceed to checkout
4. Complete payment via Midtrans
5. Receive order confirmation email

### For Administrators
1. Login to admin panel at `/admin/login`
2. Manage products (add, edit, delete)
3. View and update order statuses
4. Monitor payment statuses
5. Access customer information

## Security Features

- CSRF protection on all forms
- Input validation and sanitization
- Secure password hashing
- Session-based authentication
- Payment signature verification

## Customization

### Adding New Product Types
1. Update the `type` enum in the products migration
2. Add new product type to the seeder
3. Update the frontend filtering logic

### Customizing Payment Methods
1. Modify the `enabled_payments` array in `config/midtrans.php`
2. Update the payment page UI accordingly

### Styling Changes
- Modify Tailwind CSS classes in Blade templates
- Update the color scheme in `tailwind.config.js`
- Customize the layout files in `resources/views/layouts/`

## Troubleshooting

### Common Issues

1. **Payment Callback Not Working**
   - Ensure your server is accessible from Midtrans
   - Check the callback URL configuration
   - Verify the server key is correct

2. **Email Not Sending**
   - Check SMTP configuration in `.env`
   - Verify email credentials
   - Check server logs for errors

3. **Database Connection Issues**
   - Verify database credentials in `.env`
   - Ensure database server is running
   - Check database permissions

### Logs
Check Laravel logs for detailed error information:
```bash
tail -f storage/logs/laravel.log
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support and questions:
- Check the [CPANEL_DEPLOYMENT.md](CPANEL_DEPLOYMENT.md) for deployment issues
- Review the troubleshooting section above
- Check Laravel logs for detailed error information
