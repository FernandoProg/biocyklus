<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\Configuration;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Validar y obtener la información del restaurante
        $restaurantData = $request->validate([
            'nombre' => 'required|string|max:255',
            'rubro' => 'required|string',
            'telefono' => 'nullable|string|max:15',
            'gestion' => 'required|string',
            'tipo_residuo' => 'nullable|string',
        ]);

        // Configurar Transbank
        Configuration::setEnvironment('TEST'); // o 'PRODUCTION' en producción
        Configuration::setCommerceCode('YOUR_COMMERCE_CODE');
        Configuration::setPrivateKey('YOUR_PRIVATE_KEY');

        // Crear el pago
        $buyOrder = uniqid();
        $sessionId = uniqid();
        $amount = 10000; // Monto a cobrar
        $returnUrl = route('payment.confirm'); // URL a la que redirigir después del pago

        $response = WebpayPlus::create($buyOrder, $sessionId, $amount, $returnUrl);

        // Redirigir al usuario a Transbank
        return redirect($response->url);
    }

    public function confirmPayment(Request $request)
    {
        // Manejar la confirmación del pago
        $token = $request->input('token_ws');
        $response = WebpayPlus::getTransaction($token);

        if ($response->status == 'AUTHORIZED') {
            // Registrar el restaurante aquí
            // Utiliza $response->buyOrder para vincularlo a tu registro de restaurante

            // Redirigir a la vista de éxito
            return redirect()->route('restaurantes.index')->with('success', 'Restaurante registrado con éxito.');
        }

        // Redirigir a la vista de error
        return redirect()->route('restaurantes.create')->with('error', 'Error en el pago. Inténtalo de nuevo.');
    }
}
