@extends('layout')

@section('content')
<div class="container-fluid gx-0 text-center position-relative" style="background-image: url('{{ asset('storage/images/static/header-web-datos-reciclaje.jpg') }}'); min-height: 500px; background-position: center; background-size: cover;">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>
    <h1 class="text-white fw-bold py-4">Reduce. Reutiliza. Recicla.</h1>
    <h3 class="text-white fw-semibold py-4">El reciclaje de los envases domésticos que gestionamos crece un 3,5% en 2023</h3>
</div>

<div class="container my-5">
    <div class="row">
        <p class="fs-1 text-success fw-bold text-center my-4">Acerca de nosotros</p>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="bg-light p-4 rounded shadow">
                <p class="fs-5 text-secondary">En Biocyklus, nos apasiona la sostenibilidad y la reducción del desperdicio alimentario. Somos un equipo comprometido con la creación de soluciones innovadoras que conectan a restaurantes y organizaciones con el objetivo de dar una segunda vida a los alimentos orgánicos que de otro modo serían desechados. Creemos que la alimentación responsable es fundamental para construir un futuro más sostenible, y nuestro compromiso es facilitar el acceso a productos de calidad mientras promovemos prácticas de consumo consciente.</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="bg-light p-4 rounded shadow">
                <p class="fs-5 text-secondary">Nuestra plataforma se dedica a empoderar a las comunidades locales y a fomentar un cambio positivo en la forma en que se gestionan los recursos. A través de Biocyklus, no solo apoyamos a los negocios en la reducción de su impacto ambiental, sino que también ayudamos a las personas a acceder a alimentos frescos y nutritivos a precios asequibles. Juntos, trabajamos hacia un modelo de economía circular que beneficia a todos, promoviendo la colaboración y el respeto por el medio ambiente.</p>
            </div>
        </div>
    </div>

    <lite-youtube videoid="f624znnK7i4"></lite-youtube>

    <p class="fs-1 text-success fw-bold text-center my-4">Nuestro equipo</p>
    <hr>

    <div class="card-group">
        <div class="card">
            <img src="{{ asset('storage/images/static/francisca.jpeg') }}" class="card-img-top" alt="Francisca Andrea González Vejar">
            <div class="card-body text-center">
                <h5 class="card-title">Francisca Andrea González Vejar</h5>
                <p class="card-text">Nutricionista con especialización en calidad e inocuidad alimentaria</p>
                <p class="card-text"><small class="text-body-secondary">fgonzalez@nutricion.ucsc.cl</small></p>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('storage/images/static/fernando.jpeg') }}" class="card-img-top" alt="Fernando Antonio Cabezas Herrera">
            <div class="card-body text-center">
                <h5 class="card-title">Fernando Antonio Cabezas Herrera</h5>
                <p class="card-text">Ingeniero Civil Informático</p>
                <p class="card-text"><small class="text-body-secondary">fernandoach2025@gmail.com</small></p>
            </div>
        </div>
    </div>
</div>

<style>
.overlay {
    z-index: 1;
}
.card {
    border: none;
    transition: transform 0.3s;
}
.card:hover {
    transform: scale(1.05);
}
</style>

@endsection
