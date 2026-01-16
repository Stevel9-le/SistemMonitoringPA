<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Monitoring PA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Sistem Monitoring PA</h1>
        <p>Silakan login untuk masuk ke sistem</p>
        <a href="/login">Login</a>
    </div>
    <script src="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets-admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets-admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>

</html>
