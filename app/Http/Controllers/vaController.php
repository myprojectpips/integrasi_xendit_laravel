<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;
use Carbon\Carbon;

use App\Models\va_models as tb_va;

class vaController extends Controller {

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

    public function getVA() {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $getVABanks = \Xendit\VirtualAccounts::getVABanks();

        return $getVABanks;
    }

    public function index() {
        $vaBank = $this->getVA();
        $data_vaBank = tb_va::paginate(10);
        return view('page.virtual-account.index-va', ['vaBank' => $vaBank, 'dataVaBank' => $data_vaBank]);
    }

    public function createVa (Request $req) {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        try {
            $params = [ 
                "is_closed" => true,
                "external_id" => "test-va-".rand(),
                "bank_code" => $req->payment_method,
                "name" => $req->nama,
                "expected_amount" => 10000,
                "is_single_use" => true,
                "expiration_date" => Carbon::now()->addDays(1)->toISOString()
            ];
    
            $createVA = \Xendit\VirtualAccounts::create($params);

            tb_va::create([
                'name' => $req->nama,
                'email' => $req->email,
                'phone' => $this->idPhoneNumber($req->no_telp),
                'id' => $createVA['id'],
                'external_id' => $createVA['external_id'],
                'payment_channel' => "Virtual Account",
                'bank' => $createVA['bank_code'],
                'account_number' => $createVA['account_number'],
                'amount' => $createVA['expected_amount'],
                'status' => $createVA['status'],
                'expire_at' => $createVA['expiration_date']." UTC",
            ]);

            // return $createVA;

            return view('page.virtual-account.after-create', [
                'status' => $createVA['status'],
                'external_id' => $createVA['external_id'],
                'bank_code' => $createVA['bank_code'],
                'name' => $createVA['name'],
                'account_number' => $createVA['account_number'],
                'expected_amount' => $createVA['expected_amount'],
                'expiration_date' => $createVA['expiration_date']." UTC",
                'id' => $createVA['id'],
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function vaCallback (Request $req) {
        // JIKA DATA JSON TIDAK ADA MAKA MUNCUL MESSAGE
        if (empty($req->all())) {
            return response()->json(['message' => 'Can not process empty request'], 400);
        }

        // MENGAMBIL DATA JSON DARI CALLBACK
        $json = json_decode($req->getContent());

        tb_va::where('external_id', $json->external_id)->update([
            'status' => "PAID",
            'pay_at' => date('d-m-Y G:s:i')
        ]);

        return response()->json([
            'status' => $json->external_id,
            'bank_code' => $json->bank_code,
            'account_number' => $json->account_number,
            'amount' => $json->amount
        ]);
    }
}
