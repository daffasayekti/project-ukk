<?php

namespace App\Controllers;

use App\Models\JenisLanggananModel;

use App\Models\BeritaModel;

use App\Models\PembayaranModel;

use App\Models\AkunModel;

use App\Models\InvoiceModel;

use App\Models\LaporanModel;

use Carbon\Carbon;

use Dompdf\Dompdf;


class Payment extends BaseController
{
    protected $jenisLanggananModel;
    protected $uri;
    protected $beritaModel;
    protected $pembayaranModel;
    protected $invoiceModel;
    protected $akunModel;
    protected $laporanModel;
    protected $carbon;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->beritaModel = new BeritaModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->akunModel = new AkunModel();
        $this->invoiceModel = new InvoiceModel();
        $this->laporanModel = new LaporanModel();
        $this->carbon = new Carbon();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
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
            'title' => 'World Time | Detail Pembayaran',
            'snapToken' => \Midtrans\Snap::getSnapToken($params),
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_langganan' => $data_langganan,
            'data_laporan' => $this->laporanModel->getDataLaporan(),
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

            if ($this->request->getVar('transaction_status') == 'settlement') {
                $builder = $this->akunModel->table('users');

                $where = ['id' => $dataPelanggan['id']];

                $date = Carbon::parse($this->request->getVar('transaction_time'))->addDays($dataPembayaran['waktu_langganan']);

                $dataUpdate = [
                    'jenis_akun_id' => 2,
                    'tanggal_expired' => $date,
                ];

                $builder->set($dataUpdate)
                    ->where($where)
                    ->update();
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($this->request->getVar('transaction_status') == 'pending') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($this->request->getVar('transaction_status') == 'cancel') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            } else if ($this->request->getVar('transaction_status') == 'expire') {
                return redirect()->to('/payment/detail_payment/' . $dataPembayaran['id_langganan']);
            }
        }
    }

    public function detail_invoice($idPembayaran)
    {
        helper(['tanggal_helper']);

        $data_pembayaran = $this->pembayaranModel->getDataPembayaranById($idPembayaran);

        $checkInvoice = $this->invoiceModel->getInvoiceByPembayaranId($idPembayaran);

        if (!$checkInvoice) {
            $this->invoiceModel->save([
                'id_pembayaran' => $data_pembayaran['id_pembayaran'],
                'transaksi_id' => $data_pembayaran['transaksi_id'],
                'order_id' => $data_pembayaran['order_id'],
                'nama_pelanggan' => $data_pembayaran['nama_pelanggan'],
                'email' => $data_pembayaran['email'],
                'nama_produk' => $data_pembayaran['nama_produk'],
                'jenis_langganan' => $data_pembayaran['jenis_langganan'],
                'total_pembayaran' => $data_pembayaran['total_pembayaran'],
                'tipe_pembayaran' => $data_pembayaran['tipe_pembayaran'],
                'status_pembayaran' => $data_pembayaran['status_pembayaran'],
                'tanggal_pembayaran' => $data_pembayaran['tanggal_pembayaran']
            ]);
        }

        $this->pembayaranModel->delete_pembayaran_by_id($idPembayaran);

        $data = [
            'data_invoice' => $this->invoiceModel->getInvoiceByPembayaranId($idPembayaran),
            'uri' => $this->uri,
            'id_pembayaran' => $idPembayaran
        ];

        return view('/pages/invoice', $data);
    }

    public function cetak_pdf($order_id)
    {
        $data_invoice = $this->invoiceModel->getInvoiceByOrderId($order_id);

        $filename = 'Laporan Invoice Order-ID #' . $order_id;
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('/pages/export_invoice2', [
            'data_invoice' => $data_invoice,
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }
}
