<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 30px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #343a40;
        }
        .header p {
            color: #6c757d;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirmación de Pago</h1>
            <p>Estamos procesando tu pago. Por favor, espera...</p>
        </div>

        <h5>Detalles de la Transacción:</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Orden de compra:</strong> {{ $params['buyOrder'] }}</li>
            <li class="list-group-item" hidden><strong>ID de Sesión:</strong> {{ $params['session_id'] }}</li>
            <li class="list-group-item"><strong>Monto:</strong> {{ number_format($params['amount'] / 1, 2) }} CLP</li>
            <li class="list-group-item"><strong>Token de Pago:</strong> {{ $response->getToken() }}</li>
        </ul>

        <form action="{{ $response->getUrl() }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="token_ws" value="{{ $response->getToken() }}">
            <button type="submit" class="btn btn-primary btn-block">Finalizar Pago</button>
        </form>

        <div class="footer">
            <p>Si tienes problemas con tu pago, por favor contáctanos.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
