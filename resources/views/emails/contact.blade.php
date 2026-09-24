<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Portofolio</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Halo, Anda mendapat pesan baru dari website Portofolio!</h2>
    
    <p><strong>Detail Pengirim:</strong></p>
    <ul>
        <li><strong>Nama:</strong> {{ $data['name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
    </ul>

    <p><strong>Isi Pesan:</strong></p>
    <div style="padding: 15px; background-color: #f9f9f9; border-left: 4px solid #007BFF;">
        {{ $data['message'] }}
    </div>
    
    <p><br>Balas pesan ini langsung dengan membalas (reply) ke email pengirim.</p>
</body>
</html>