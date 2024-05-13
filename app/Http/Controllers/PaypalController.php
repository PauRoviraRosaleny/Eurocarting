<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptMail;


class PaypalController extends Controller
{

    public function payment( Request $request, $id) {
        $request->session()->put('car_id', $id);
        $request->session()->put('start_date', $request->start_date);
        $request->session()->put('end_date', $request->end_date);
        $request->session()->put('amount', $request->amount);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel'),

            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $request->amount

                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ( $response['links'] as $link ) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }

            }
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if ( $response['status'] == 'COMPLETED') {

            $this->car_id = $request->session()->get('car_id');
            $this->start_date = $request->session()->get('start_date');
            $this->end_date = $request->session()->get('end_date');
            $this->amount = $request->session()->get('amount');

            $startTime = strtotime( $this->start_date );
            $startFormat = date('Y-m-d',$startTime);

            $endTime = strtotime( $this->end_date );
            $endFormat = date('Y-m-d',$endTime);

            $loan = new Loan;
            $auth = Auth::user();
            $car = Car::find($this->car_id);

            $loan->start_date = $startFormat;
            $loan->end_date = $endFormat;
            $loan->user_id = $auth->id;
            $loan->car_id = $car->id;
            $loan->car_name = $car->brand . ' ' .$car->model;
            $loan->active = 0;
            $loan->amount =  $this->amount;
            $loan->save();
            $request->session()->forget(['car_id', 'start_date', 'end_date', 'amount']);

            Mail::to($auth->email)->send(new ReceiptMail($auth->name, $car, $loan));
            return redirect()->route('account');

        } else {
            return redirect()->route('cancel');
        }

    }

    public function cancel() {
        return "Payment was canceled!";
    }
}
