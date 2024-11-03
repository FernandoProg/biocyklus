<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Restaurante;
use App\Models\Organizacion;
use Redirect;

class PaymentController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function createdTransaction(Request $request)
    {
        $request->request->add(['buyOrder' => uniqid()]);
        $req = $request->except('_token');
        $resp = (new Transaction)->create($req["buyOrder"], $req["session_id"], $req["amount"], route('payment.commit'));
        $tipoReciclaje = $request->input('tipo_reciclaje', []);
        $compostan = $request->has('compostan');
        $reciclan = $request->has('reciclan');
        $capacitarse = $request->has('capacitarse');
        if($request['negocio'] == 'Organizacion'){
            session([
                'data' => [
                    'nombre' => $req['nombre'],
                    'ubicacion' => $req['ubicacion'],
                    'miembros' => $req['miembros'],
                    'rrss' => $req['rrss'],
                    'asociacion' => $req['asociacion'],
                    'compostan' => $compostan,
                    'reciclan' => $reciclan,
                    'capacitarse' => $capacitarse,
                    'negocio' => $req['negocio'],
                    'tipoReciclaje' => $tipoReciclaje,
                ]
            ]);
        }else{
            session([
                'data' => [
                    'nombre' => $req['nombre'],
                    'rubro' => $req['rubro'],
                    'telefono' => $req['telefono'],
                    'ubicacion' => $req['ubicacion'],
                    'gestion' => $req['gestion'],
                    'tipo_residuos' => $req['tipo_residuos'],
                    'negocio' => $req['negocio'],
                ]
            ]);
        }
        return view('payment/created', [ "params" => $req,"response" => $resp]);
    }

    public function commitTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $resp = (new Transaction)->commit($req["token_ws"]);
            $data = session('data');
            if ($resp->isApproved()) {
                if($data['negocio'] == 'Restaurante'){
                    $restaurante = \App\Models\Restaurante::create([
                        'nombre' => $data['nombre'],
                        'rubro' => $data['rubro'],
                        'telefono' => $data['telefono'],
                        'ubicacion' => $data['ubicacion'],
                        'gestion' => $data['gestion'],
                    ]);
                    $restaurante->users()->attach($resp->sessionId);
                    $restaurante->tiposResiduos()->sync($data['tipo_residuos']);
                    session()->forget('data');
                    return redirect()->route('restaurantes.index')
                         ->with('success', 'Restaurante registrado exitosamente');
                }else{
                    $organizacion = \App\Models\Organizacion::create([
                        'nombre' => $data['nombre'],
                        'ubicacion' => $data['ubicacion'],
                        'miembros' => $data['miembros'],
                        'rrss' => $data['rrss'],
                        'asociacion' => $data['asociacion'],
                        'compostan' => $data['compostan'],
                        'reciclan' => $data['reciclan'],
                        'capacitarse' => $data['capacitarse'],
                    ]);
                    $organizacion->users()->attach($resp->sessionId);
                    if (isset($data['tipoReciclaje']) && !empty($data['tipoReciclaje'])) {
                        $organizacion->tiposReciclajes()->sync($data['tipoReciclaje']);
                    }
                    session()->forget('data');
                    return redirect()->route('organizacion.index')
                         ->with('success', 'Organizacion registrado exitosamente');
                }
            }

            return redirect()->route('dashboard');
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            session()->forget('restaurant_data');
            return view('dashboard', ["resp" => $request->all()]);
        }

        //Timeout
        session()->forget('restaurant_data');
        return view('dashboard', ["resp" => $request->all()]);

    }


    public function showRefund()
    {
        return view('webpayplus/refund');
    }

    public function refundTransaction(Request $request)
    {
        $error = false;
        try {
            $req = $request->except('_token');
            $resp = (new Transaction)->refund($req["token"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            $error = true;
        }
        return view('webpayplus/refund_success', ["resp" => $resp, "error" => $error]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new Transaction)->status($token);
        return view('webpayplus/transaction_status', ["resp" => $resp, "req" => $req]);
    }
}
