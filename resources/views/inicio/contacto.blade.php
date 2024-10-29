@extends('../layout')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <h2>Contáctanos</h2>
                <p class="text-muted">Nos encantaría saber de ti. Ya sea que tengas preguntas sobre nuestros productos, sugerencias, o quieras saber más sobre nuestra misión en Biocyklus, estamos aquí para ayudarte.</p>
                
                <h4>Dirección</h4>
                <p>Biocyklus Ltda.<br>
                Av. Alonso de Ribera 2850<br>
                Concepción, Bío Bío</p>

                <h4>Teléfono</h4>
                <p>+56 9 9338 2587</p>

                <h4>Email</h4>
                <p><a href="mailto:biocyklus@gmail.com" class="new-style">biocyklus@gmail.com</a></p>

                <h4>Síguenos</h4>
                <p>Encuentra nuestras redes sociales en la parte inferior de esta página para mantenerte informado sobre nuestras últimas novedades.</p>
            </div>

            <div class="col-lg-6">
                <h4>Formulario de Contacto</h4>
                <p>Déjanos un mensaje y te responderemos lo antes posible.</p>
                <form action="/enviar-mensaje" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>

@endsection