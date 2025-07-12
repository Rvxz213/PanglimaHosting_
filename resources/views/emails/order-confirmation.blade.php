<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - PanglimaHosting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .order-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #06b6d4;
        }
        .product-info {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .status-badge {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background: #06b6d4;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Pesanan Berhasil!</h1>
        <p>Terima kasih telah memilih PanglimaHosting</p>
    </div>
    
    <div class="content">
        <h2>Halo {{ $order->customer_name }},</h2>
        
        <p>Pesanan Anda telah berhasil diproses dan pembayaran telah dikonfirmasi. Berikut adalah detail pesanan Anda:</p>
        
        <div class="order-details">
            <h3>📋 Detail Pesanan</h3>
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Status:</strong> <span class="status-badge">Dibayar</span></p>
            <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Total Pembayaran:</strong> <strong>{{ $order->formatted_total }}</strong></p>
        </div>
        
        <div class="product-info">
            <h3>🛒 Produk yang Dipesan</h3>
            <p><strong>{{ $order->product->name }}</strong></p>
            <p><strong>Tipe:</strong> {{ strtoupper($order->product->type) }}</p>
            <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
            <p><strong>Harga Satuan:</strong> {{ $order->product->formatted_price }}</p>
            
            @if($order->product->description)
                <p><strong>Deskripsi:</strong> {{ $order->product->description }}</p>
            @endif
            
            @if($order->product->features && count($order->product->features) > 0)
                <p><strong>Fitur:</strong></p>
                <ul>
                    @foreach($order->product->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        
        <h3>🚀 Langkah Selanjutnya</h3>
        <p>Tim kami akan segera memproses pesanan Anda dan menghubungi Anda dalam waktu 1-2 jam kerja untuk memberikan informasi akses ke layanan yang telah Anda pesan.</p>
        
        <h3>📞 Butuh Bantuan?</h3>
        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi tim support kami:</p>
        <ul>
            <li>📧 Email: support@panglimahosting.com</li>
            <li>📱 WhatsApp: +62 812-3456-7890</li>
            <li>🌐 Website: www.panglimahosting.com</li>
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('home') }}" class="button">Kunjungi Website Kami</a>
        </div>
    </div>
    
    <div class="footer">
        <p><strong>PanglimaHosting</strong> - #1 Hosting Provider di Indonesia</p>
        <p>© {{ date('Y') }} PanglimaHosting. All rights reserved.</p>
        <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
    </div>
</body>
</html> 