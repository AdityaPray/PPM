<x-layout>
    <head>
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
    </head>
@section('title', $title)
@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('image/dinda-catering.jpg') }}" alt="Dinda Catering" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Tentang Dinda Catering</h2>
            <p class="lead">
                Dinda Catering adalah usaha katering profesional yang berdiri sejak tahun <strong>2015</strong>.
                Kami berkomitmen untuk menghadirkan pengalaman kuliner terbaik dengan cita rasa rumahan dan kualitas
                layanan yang terpercaya.
            </p>
            <p>
                Melayani berbagai acara seperti pernikahan, arisan, meeting kantor, dan event spesial lainnya, Dinda
                Catering selalu mengutamakan kepuasan pelanggan dengan menu yang variatif, sehat, dan harga yang
                terjangkau.
            </p>
            <p>
                Dengan pengalaman lebih dari <strong>10 tahun</strong>, kami telah dipercaya oleh ratusan pelanggan
                di berbagai kota untuk menyajikan hidangan yang tidak hanya lezat, tapi juga berkesan.
            </p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col text-center">
            <h4 class="mb-3">Kenapa Memilih Kami?</h4>
            <ul class="list-unstyled">
                <li>✅ Bahan segar dan berkualitas</li>
                <li>✅ Menu fleksibel dan bisa custom</li>
                <li>✅ Tim berpengalaman dan profesional</li>
                <li>✅ Harga bersahabat untuk semua kalangan</li>
            </ul>
        </div>
    </div>
</div>
@include('components.footer')
</x-layout>
