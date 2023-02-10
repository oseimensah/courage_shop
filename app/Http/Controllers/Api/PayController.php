<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function payment(Request $request)
    {
        // $order = Order::firstWhere('code', $request['orderCode']);
        $subscriberNo = '';
        $pan = null;

        if (!$request['cardOption']) {
            $subscriberNo = preg_replace("/\s+/", "", $request['momoNumber']);
            $subscriberNo = '233' . substr($subscriberNo, 1);
        } else {
            $pan = preg_replace("/\s+/", "", $request['cardNumber']);
        }

        $requestArray = [
            'customer_name' => $request->first_name . ' ' . $request->last_name,
            'customer_email' => $request->email,
            'customer_phone' => $subscriberNo,
            'subscriber_number' => $subscriberNo,
            // 'voucher_code' => $request['selectedValue']=== 'VDF' ? $this->mobile_vocher : null,
            'voucher_code' => null,
            'description' => 'Purely Ghanaian \nPayment for your products - GHC ' . $request->amount,
            'r-switch' => !$request['cardOption'] ? $request['selectedValue'] : 'VIS',
            'currency' => 'GHS',
            'amount' => $request->amount,
            'card_holder' => $request['cardholder'],
            'pan' => $pan,
            'exp_month' => $request['expiredMonth'],
            'exp_year' => $request['expiredYear'],
            'cvv' => $request['securityCode'],
        ];

        if ($request['paymentOption']) {
            $cardPay = new ProcessCardPayment($requestArray);
            $response = $cardPay->response;

            Log::alert($response);
            return response()->json([
                'data' => $response,
                'code' => 200
            ]);
        } else {
            $moPay = new ProcessMobileMoneyPayment($requestArray);
            $response = $moPay->response;

            Log::alert($response);
            return response()->json([
                'data' => $response,
                'code' => 200
            ]);
        }
        // return $request;
    }
}
