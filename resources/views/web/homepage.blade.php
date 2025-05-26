<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DindaSnack' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
</head>

<body>
    @include('components.navbar')

    <div class="hero">
        <img src="https://cdn.pixabay.com/photo/2014/08/26/09/33/indonesia-427784_1280.jpg" alt="Background Coffee" class="hero-image">
        <div class="hero-content">
            <h1>DindaSnack - Nikmati Kelezatan Kami</h1>
            <h3>Cita Rasa Terbaik di Setiap Gigitan</h3>
            <a href="/categories" class="btn btn-custom btn-lg">Lihat Menu</a>
        </div>
    </div>

    <div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-5 d-flex justify-content-center">
            <div class="image-stack-container">
                <img src="{{ asset('image/download.jpg') }}" class="img-fluid custom-stacked-img" alt="Menu Restoran Garuda">
                <img src="{{ asset('image/Buffet Catering Service in North Carolina.jpg') }}" class="img-fluid custom-stacked-img" alt="Restoran Garuda">
            </div>
        </div>

        <div class="col-md-7 text-column">
            <h2>
                <span style="font-family: 'Brush Script MT', cursive; font-size: 3rem; color: #b6895b;">Welcome</span><br>
                <strong>Restoran Garuda</strong>
            </h2>
            <p class="mt-3" style="font-size: 1.1rem; color: #555;">
                Restoran Garuda telah berdiri sejak 1976 hingga saat ini. Kami bergerak di bidang mengelolah makanan yang spesifik yaitu Minang dan Melayu, di mana alasan untuk mendirikan rumah makan ini adalah merupakan hasil survei bahwa masih kurangnya sarana rumah makan terutama yang menyediakan makanan spesifik Minang dan Melayu di kota Medan.
            </p>
        </div>
    </div>
</div>

</div>
    </div>

    </div>

    <section class="services-section py-5">
        <div class="container text-center">
            <h2>
                <span style="font-family: 'Brush Script MT', cursive; font-size: 3rem; color: #b6895b; margin-bottom: 30px;">Service</span><br>
                <strong>Kategori Produk</strong>
            </h2>
            <div class="row justify-content-center">
                @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 80px;">
                    <h5 class="mt-3 text-warning fw-semibold">
                        <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
                    </h5>
                    <p class="text-secondary">{{ $category->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('components.footer')

</html>