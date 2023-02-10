<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ProcessCardPayment.
 */
class ProcessCardPayment
{
    public $merchant_id;
    public $api_key;
    public $username;
    public $base_uri;
    public $third_url_response;
    public $processing_code;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The  incomming request array .
     *
     * @var array
     */
    protected $request;

    /**
     * The API response from Payswitch.
     *
     * @var array
     */
    public $response;

    /**
     * Retrying Duplicate Transaction ID.
     *
     * @var int
     */
    protected $retry = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->merchant_id = config('payswitch.merchant_id');
        $this->api_key = config('payswitch.api_key');
        $this->username = config('payswitch.username');
        $this->base_uri = config('payswitch.base_uri', 'https://prod.theteller.net');
        $this->third_url_response = config('payswitch.redirect_url');
        $this->processing_code = '000000';
        $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $this->process();
    }

    public function handleCallback(array $array)
    {
        // $payment = Payment::where('transaction_id', $array['transaction_id'])
        //             ->first();
        // if($payment)
        // {
        //    Log::info($array);
        //    if(isset($array['code'])){
        //          if($array['code'] == 000){
        //             $payment->status = 'Approved';
        //             $payment->save();
        //          }else{
        //             $payment->delete();
        //          }
        //    }
        // }

        // return $array;
    }

    public function process()
    {
        $http = new Client();
        $body = Arr::only($this->request, [
            'transaction_id',
            'subscriber_number',
            'desc',
            'voucher_code',
            'r-switch'
        ]);
        $body = [
            'amount' => sprintf("%'.012d", $this->request['amount'] * 100),
            'transaction_id' => \unique_code(),
            'r-switch' => $this->request['r_switch'],
            'desc' => $this->request['description'],
            'merchant_id' => $this->merchant_id,
            'processing_code' => $this->processing_code,
            '3d_url_response' => $this->third_url_response,
            'pan' => $this->request['pan'],
            'exp_month' => $this->request['exp_month'],
            'exp_year' => $this->request['exp_year'],
            'cvv' => $this->request['cvv'],
            'currency' => $this->request['currency'],
            'card_holder' => $this->request['card_holder'],
            'customer_email' => $this->request['customer_email'],
        ];

        $credentials = base64_encode('pasilier62ecf8f6a0412:MzJmMjBlMWMxOGE4ODBjMDYxYzYyMjc1YjNkMzI3MDk=');
        $http = new Client([
            'base_uri' => $this->base_uri,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => ["Basic " . $credentials],
                'Cache-Control' => 'no-cache',
                'Accept' => 'Accept: */*',
                'User-Agent' => 'guzzle/6.0',
                'Accept-Charset' => '*',
                'Accept-Encoding' => '*',
                'Accept-Ranges' => 'none',
                'Accept-Language' => '*',
            ]
        ]);


        $makePaymentPromise = $http->postAsync("v1.1/transaction/process", ["body" => json_encode($body)])->then(
            function (ResponseInterface $response) {
                return $response;
            },
            function (RequestException $e) {
                $message =  $e->getMessage() . "\n";
                $request = $e->getRequest()->getMethod();
                Log::alert($message);

                return $message;
            }
        );

        $response = $makePaymentPromise->wait();
        try {
            $response = json_decode($response->getBody()->getContents(), true);
            Log::info(print_r($response, true));
        } catch (\Exception $e) {
            report($e);
        }

        $this->response = $response;

        if ($response['code'] == '000') {

            $amount = substr($this->request['amount'], 0, 10);
            $amount = $amount + 0;
            $approved = 'Approved';
            if (!isset($response['transaction_id'])) {
                $approved = 'Pending';
            }

            //save data

        } elseif ($this->response['code'] == '909') {
            if ($this->retry <= 2) {
                $this->retry = $this->retry + 1;
                $this->request['transaction_id'] = \unique_code();
                $this->handle();
            }
        } elseif ($this->response['code'] == '114') {
            $this->error($this->response, 'Invalid Voucher code');
        } elseif ($this->response['code'] == '102') {
            $this->error($this->response, 'Number not registered for mobile money');
        } elseif ($this->response['code'] == '107') {
            $this->error($this->response, 'USSD is busy, please try again later');
        } elseif ($this->response['code'] == '101' || $response['code'] == '105' || $response['code'] == '100') {
            $this->error($this->response, $this->response['reason'] . ", Please check your account balance and try again");
        } elseif ($this->response['code'] == '000') {
            $this->error($this->response);
        } elseif ($this->response['code'] == '030') {
            $this->error($this->response, $this->response['reason']);
        } else {
            $this->error($this->response);
        }

        return $this->response;
    }

    public function error($response, $reason = '')
    {
        Log::critical($response);
        if ($reason) {
            $this->response['reason'] = $reason;
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        Log::critical($exception->getMessage());
    }
}
