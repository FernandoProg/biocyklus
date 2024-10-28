@extends('layout')

@section('content')
<div class="container-fluid gx-0 text-center" style="background-image: url('{{ asset('storage/images/static/header-web-datos-reciclaje.jpg') }}'); min-height:500px; background-position: center;">
    <h1 class="text-white fw-bold py-4">Reduce. Reutiliza. Recicla.</h1>
    <h3 class="text-white fw-semibold py-4">El reciclaje de los envases domésticos que gestionamos crece un 3,5% en 2023</h3>
</div>
<div class="container text-center mb-2">
    <div class="row">
        <p class="fs-1 text-success fw-bold my-4">Acerca de nosotros</p>
        <div class="col-xl-6 col-md-12 col-sm-12 fs-3 px-4 text-secondary px-4">
            <p>Founded in 1989, Recupac is one of the largest providers of recycling solutions and industrial waste management in Chile, involved in the whole cycle of waste, and serving a wide range of customers in the commercial, retail and industrial sectors.</p>
            <br>
            <p>We own 3 facility plants in Región Metropolitana and 1 in Región de Valparaíso, which allow us to manage more than 100.000 tons of waste each year.</p>
        </div>
        <div class="col-xl-6 col-md-12 col-sm-12 fs-4 px-4 text-secondary px-4">
            <p>Our customers are well protected because we have all environmental and sanitary permits required by law in order to operate as an industrial waste management company. We are also registered in the Ministry of the Environment as “Gestores”, in the context of the recent EPR law (Extended Producer Responsibility).</p>
            <br>
            <p>One of our key attributes, is that our engineers analyze each of our customers waste generation processes, and offer tailored solutions for comprehensive waste management, in such way that allows them to:

            Reduce the volume of waste to landfill.
            Lower disposal costs.
            Together with collaborators and communities, contribute to protect the environment.
            We are part of Empresas Coipsa, which over the last 40 years has been dedicated to give life to waste.</p>
        </div>
        <lite-youtube videoid="f624znnK7i4"></lite-youtube>
        <p class="fs-1 text-success fw-bold my-4">Nuestro equipo</p>
        <hr>
        <div class="card-group">
            <div class="card">
                <img src="{{ asset('storage/images/static/francisca.jpeg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Francisca Andrea González Vejar</h5>
                <p class="card-text">Nutricionista con especialización en calidad e inocuidad alimentaria</p>
                <p class="card-text"><small class="text-body-secondary">fgonzalez@nutricion.ucsc.cl</small></p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('storage/images/static/fernando.jpeg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Fernando Antonio Cabezas Herrera</h5>
                <p class="card-text">Ingeniero Civil Informático</p>
                <p class="card-text"><small class="text-body-secondary">fcabezas@ing.ucsc.cl</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection