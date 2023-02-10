<?php

namespace App\Services;

use App\Models\Transaction;
use App\Jobs\MobileMoneyPayment;
use Illuminate\Support\Facades\Log;

/**
 * Class PaymentService.
 */
class PaymentService
{
   public function handleCallback(Array $data)
   {

      $trans = Transaction::where('transaction_id', $data['transaction_id'])->first();
      
      if($trans)
      {
         Log::info($data);

         if(isset($array['code'])){
            if($array['code'] == 000){
               $trans->status = 'Approved';
               $trans->save();
            }else{
               $trans->delete();
            }
         } 
      }

      return $data;

   }

   /**
     * Mobile money processing
     *
     * @param Request $request
     * @return void
     */
   public function payWithMobileMoney(Array $request)
   {
      $pay = new PaySwitchService();
      $pay->amount = $request['amount'];
      $pay->subscriber_number = $request['subscriber_number'];
      $pay->r_switch = $request['r_switch'];
      if(isset($request['company_name'])){
         $pay->desc = $request['company_name'] . " Bill Payment";
      }else{
         $pay->desc = "Bill Payment";
      }
      $pay->processing_code = "000200";
      if(!empty($request['voucher_code'])){
         $pay->voucher_code = $request['voucher_code'];
      }
      $pay->momoPay();

      if($pay->response_code == '000' && $pay->response_status == 'Approved'){
         $array = array('transaction_id' => $pay->transaction_id, 'status'=> 'Approved', 'method'=> 'Mobile Money Payment');
         $request = array_merge($request, $array);
         MobileMoneyPayment::dispatch($request)->onQueue('momo');
      }

      return $pay->response;
   }
}
