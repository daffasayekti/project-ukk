<?php

namespace App\Controllers;

use App\Models\JenisLanggananModel;

use App\Models\BeritaModel;

class Payment extends BaseController
{
    protected $jenisLanggananModel;
    protected $beritaModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->beritaModel = new BeritaModel();
    }

    public function detail_pembayaran($id)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-vg0qvnm9Az97NxyMgEVIB6OR';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $data_langganan = $this->jenisLanggananModel->getDataLanggananById($id);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $data_langganan['harga_langganan'],
            ],
        ];

        $data = [
            'title' => 'Detail Pembayaran',
            'snapToken' => \Midtrans\Snap::getSnapToken($params),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_langganan' => $data_langganan
        ];

        return view('/pages/payment', $data);
    }
}
