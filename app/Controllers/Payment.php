<?php

namespace App\Controllers;

use App\Models\JenisLanggananModel;

use App\Models\BeritaModel;

use App\Models\PembayaranModel;

use App\Models\AkunModel;

use Carbon\Carbon;

class Payment extends BaseController
{
    protected $jenisLanggananModel;
    protected $beritaModel;
    protected $pembayaranModel;
    protected $akunModel;
    protected $carbon;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->beritaModel = new BeritaModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->akunModel = new AkunModel();
        $this->carbon = new Carbon();
    }

    public function detail_pembayaran($id)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-vg0qvnm9Az97NxyMgEVIB6OR';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $data_langganan = $this->jenisLanggananModel->getDataLanggananById($id);

        $items = array(
            array(
                'id'       => $data_langganan['id_langganan'],
                'price'    => $data_langganan['harga_langganan'],
                'quantity' => 1,
                'name'     => 'Layanan ' . $data_langganan['nama_langganan']
            ),
        );

        $customer_details = array(
            'first_name' => user()->username,
        );

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $data_langganan['harga_langganan'],
            ],
            'item_details' => $items,
            'customer_details' => $customer_details,
        ];

        $data = [
            'title' => 'Detail Pembayaran',
            'snapToken' => \Midtrans\Snap::getSnapToken($params),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_langganan' => $data_langganan,
            'data_pembayaran' => $this->pembayaranModel->getDataPembayaranByUsername(user()->username),
        ];

        return view('/pages/payment', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $dataPembayaran = $this->jenisLanggananModel->getDataLanggananById($this->request->getVar('id_langganan'));
            $dataPelanggan = $this->akunModel->find($this->request->getVar('id_pelanggan'));

            $this->pembayaranModel->save([
                'transaksi_id' => $this->request->getVar('transaction_id'),
                'order_id' => $this->request->getVar('order_id'),
                'nama_pelanggan' => $dataPelanggan['username'],
                'email' => $dataPelanggan['email'],
                'nama_produk' => $dataPembayaran['nama_langganan'],
                'jenis_langganan' => $dataPembayaran['jenis_langganan'],
                'total_pembayaran' => $this->request->getVar('gross_amount'),
                'tipe_pembayaran' => $this->request->getVar('payment_type'),
                'status_pembayaran' => $this->request->getVar('transaction_status'),
                'tanggal_pembayaran' => $this->request->getVar('transaction_time')
            ]);

            $cekStatus = $this->pembayaranModel->getStatusPembayaran($this->request->getVar('order_id'));

            if ($cekStatus['status_pembayaran'] == 'settlement') {
                $builder = $this->akunModel->table('users');

                $where = ['id' => user()->id];

                $date = Carbon::parse($this->request->getVar('transaction_time'))->addDays($dataPembayaran['waktu_langganan']);

                $dataUpdate = [
                    'jenis_akun_id' => 2,
                    'tanggal_expired' => $date,
                ];

                $builder->set($dataUpdate)
                    ->where($where)
                    ->update();
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($cekStatus['status_pembayaran'] == 'pending') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($cekStatus['status_pembayaran'] == 'cancel') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($cekStatus['status_pembayaran'] == 'expire') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            }
        }
    }

    public function detail_invoice()
    {
        helper(['tanggal_helper']);

        $data = [
            'data_invoice' => $this->pembayaranModel->getDataPembayaranByUsername(user()->username),
        ];

        return view('/pages/invoice', $data);
    }
}
