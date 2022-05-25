<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Models\qrcode_models as tb_qrcode;

class qrCodeController extends Controller {
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

    public function index() {
        $data = tb_qrcode::paginate(10);

        return view('page.qr-code.index-qrCode', ['dataQRCode' => $data]);
    }

    public function createQR (Request $req) {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $params =[
            'external_id' => 'test-qr-code-'.rand(),
            'type' => 'DYNAMIC',
            'amount' => '10000',
            'callback_url' => 'https://2db6-180-241-242-19.ap.ngrok.io/qr-code/callback'
        ];

        $createQR = \Xendit\QRCode::create($params);

        // return $createQR;
        tb_qrcode::create([
            'name' => $req->nama,
            'email' => $req->email,
            'phone' => $this->idPhoneNumber($req->no_telp),
            'id' => $createQR['id'],
            'external_id' => $createQR['external_id'],
            'payment_channel' => 'QR Code',
            'nominal' => $createQR['amount'],
            'status' => $createQR['status'],
            'qr_string' => $createQR['qr_string']
        ]);

        return view('page.qr-code.after-create', [
            'dataQR' => $createQR
        ]);
    }

    public function QrCodeCallback(Request $req) {
        // JIKA DATA JSON TIDAK ADA MAKA MUNCUL MESSAGE
        if (empty($req->all())) {
            return response()->json(['message' => 'Can not process empty request'], 400);
        }

        // MENGAMBIL DATA JSON DARI CALLBACK
        $json = json_decode($req->getContent());

        tb_qrcode::where('external_id', $json->qr_code->external_id)->update(
            [
                'status' => "PAID",
                'pay_at' => date('d-m-Y G:s:i'),
                'receipt_id' => $json->payment_details->receipt_id,
                'source' => $json->payment_details->source,
            ]
        );

        return response()->json(['json' => $json]);
    }
}
