<!-- resources/views/layouts/app.blade.php atau file blade lain -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DindaSnack' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Jika ingin langsung tempel CSS -->
    <style>
        /* Footer */
        #footer {
            background-color: #2C3E50;
            color: #ffffff;
            padding: 30px 0;
            text-align: center;
            margin-top: 50px;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-container div {
            flex: 1 1 200px;
            margin: 10px;
        }

        .footer-container h5 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .footer-container p,
        .footer-container ul,
        .footer-container a {
            color: #ffffff;
            font-size: 0.9em;
            text-align: left;
        }

        .footer-container ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .footer-container ul li {
            margin: 5px 0;
        }

        .footer-container ul li a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-container ul li a:hover {
            color: #3498DB;
        }

        .footer-social a {
            display: inline-block;
            margin: 5px 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #3498DB;
        }

        .footer-bottom {
            margin-top: 20px;
            border-top: 1px solid #ffffff;
            padding-top: 10px;
            font-size: 0.85em;
        }

        /* Responsif */
        @media screen and (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-container div {
                margin: 20px 0;
            }
        }
        /* End of Footer */
    </style>
</head>

<body>
    <!-- konten lainnya -->

    <!-- Footer -->
    <footer id="footer">
        <div class="container footer-container d-flex flex-wrap justify-content-between">
            <div class="footer-about mb-4">
                <h5 class="fw-bold">Tentang Kami</h5>
                <p>DindaSnack - Nikmati Kelezatan Kami
                Cita Rasa Terbaik di Setiap Gigitan</p>
            </div>
            <div class="footer-contact mb-4">
                <h5 class="fw-bold">Kontak</h5>
                <p>Email: travelpariwisata@gmail.com</p>
                <p>Telepon: +62 812-3456-7890</p>
                <p>Alamat: Jl. Raya Wisata No.123, Jakarta</p>
            </div>
            <div class="footer-links mb-4">
                <h5 class="fw-bold">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#aboutus">Tentang Kami</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-social mb-4">
                <h5 class="fw-bold">Ikuti Kami</h5>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>
        </div>
        <div class="footer-bottom text-center pt-3 border-top mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} Dinda Snack. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
