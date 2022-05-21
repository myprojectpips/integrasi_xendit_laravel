<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Models\ewallet_models as tb_ewallet;

class ewalletController extends Controller {

    public function idPhoneNumber($nohp){
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);

        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);

        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);

        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/', trim($nohp))){
            if(substr(trim($nohp), 0, 2) == '62'){ // cek apakah no hp karakter 1-2 adalah +62
                $hp = trim($nohp);
            }elseif(substr(trim($nohp), 0, 1) == '0'){ // cek apakah no hp karakter 1 adalah 0
                $hp = '62'.substr(trim($nohp), 1);
            }
        }

        return $hp;
    }

    // GET BALANCE
    public function balance() {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY')); // Secret Key

        $getBalance = \Xendit\Balance::getBalance('CASH');
        return $getBalance['balance'];
    }

    // PAYMENT CHANNEL YANG TERSEDIA
    public function paymentChannel() {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $list = \Xendit\PaymentChannels::list();

        // foreach ($list as $key) {
        //     echo $key['channel_category'];
        //     echo "<br>";
        // }

        return $list;
    }

    // CEK STATUS
    public function getStatus($id) {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $charge_id = $id;
        $getEWalletChargeStatus = \Xendit\EWallets::getEWalletChargeStatus($charge_id);
        return $getEWalletChargeStatus;
    }

    public function index(){
        $paymentChannel = $this->paymentChannel();
        $data_ewallet = tb_ewallet::paginate(10);

        return view('page.ewallet.index-ewallet', ['paymentChannel' => $paymentChannel, 'dataEwallet' => $data_ewallet]);
    }

    // MEMBUAT CHARGE EWALLET
    public function ewalletCharge(Request $req) {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        try {
            $amount = 12000;
            $no_telp = $this->idPhoneNumber($req->no_telp);

            // PROGRAM UNTUK EWALLET DANA, LINKAJA
            $params = [
                'reference_id' => 'test-ewallet-'.rand(),
                'currency' => 'IDR',
                'amount' => $amount,
                'checkout_method' => 'ONE_TIME_PAYMENT',
                'channel_code' => $req->payment_method,
                'channel_properties' => [
                    'mobile_number' => $no_telp,
                    'success_redirect_url' => route('ewallet.success'),
                    'failure_redirect_url' => route('ewallet.failure'),
                ],
                'metadata' => [
                    'branch_code' => 'tree_branch'
                ]
            ];
    
            $charge = \Xendit\EWallets::createEWalletCharge($params);

            tb_ewallet::create([
                'name' => $req->nama,
                'email' => $req->email,
                'phone' => $no_telp,
                'id' => $charge['id'],
                'reference_id' => $charge['reference_id'],
                'payment_channel' => "Ewallet",
                'channel_code' => $charge['channel_code'],
                'amount' => $amount,
                'status' => $charge['status'],
            ]);

            return redirect($charge['actions']['mobile_web_checkout_url']);
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput($req->all());
        }
        
    }

    // EWALLET CALLBACK
    public function ewalletCallback(Request $req) {

        // JIKA DATA JSON TIDAK ADA MAKA MUNCUL MESSAGE
        if (empty($req->all())) {
            return response()->json(['message' => 'Can not process empty request'], 400);
        }

        // MENGAMBIL DATA JSON DARI CALLBACK
        $json = json_decode($req->getContent());

        // UPDATE STATUS DAN PAY_AT PADA DATABASE
        tb_ewallet::where('reference_id', $json->data->reference_id)->update([
            'status' => "PAID",
            'pay_at' => date('d-m-Y G:i:s')
        ]);

        // MENAMPILKAN RESPONSE DI XENDIT
        return response()->json([
            'status' => $json->data->status,
            'channel_code' => $json->data->channel_code
        ]);
    }


    // REDIRECT SETELAH PROSES TRANSAKSI
    public function success() {
        return view('page.ewallet.after-pay', ['message' => 'success']);
    }

    public function failure() {
        return view('page.ewallet.after-pay', ['message' => 'failure']);
    }


    // UNTUK MENGCANCEL TRANSAKSI
    public function cancel() {
        return "Cancel";
    }
}
