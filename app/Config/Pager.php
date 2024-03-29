<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Templates
     * --------------------------------------------------------------------------
     *
     * Pagination links are rendered out using views to configure their
     * appearance. This array contains aliases and the view names to
     * use when rendering the links.
     *
     * Within each view, the Pager object will be available as $pager,
     * and the desired group as $pagerGroup;
     *
     * @var array<string, string>
     */
    public $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
        'pagination_users_login'     => 'App\Views\Pagers\pagination_users_login',
        'pagination_data_moderasi'   => 'App\Views\Pagers\pagination_data_moderasi',
        'pagination_data_kecelakaan' => 'App\Views\Pagers\pagination_data_kecelakaan',
        'pagination_data_ekonomi'  => 'App\Views\Pagers\pagination_data_ekonomi',
        'pagination_data_politik'  => 'App\Views\Pagers\pagination_data_politik',
        'pagination_data_olahraga' => 'App\Views\Pagers\pagination_data_olahraga',
        'pagination_data_komentar' => 'App\Views\Pagers\pagination_data_komentar',
        'pagination_users_free'    => 'App\Views\Pagers\pagination_users_free',
        'pagination_users_premium' => 'App\Views\Pagers\pagination_users_premium',
        'pagination_data_admin'    => 'App\Views\Pagers\pagination_data_admin',
        'pagination_data_pembayaran' => 'App\Views\Pagers\pagination_data_pembayaran',
        'pagination_data_invoice'    => 'App\Views\Pagers\pagination_data_invoice',
        'pagination_data_moderasi_laporan' => 'App\Views\Pagers\pagination_data_moderasi_laporan',
        'pagination_data_berita_premium' => 'App\Views\Pagers\pagination_data_berita_premium',
        'pagination_data_kategori' => 'App\Views\Pagers\pagination_data_kategori',
        'pagination_data_jenis_langganan' => 'App\Views\Pagers\pagination_data_jenis_langganan',
        'pagination_data_tagline' => 'App\Views\Pagers\pagination_data_tagline',
        'pagination_data_laporan' => 'App\Views\Pagers\pagination_data_laporan',
        'pagination_history_pembayaran' => 'App\Views\Pagers\pagination_history_pembayaran',
        'pagination_history_pembayaran_expired' => 'App\Views\Pagers\pagination_history_pembayaran_expired',
    ];

    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     *
     * @var int
     */
    public $perPage = 20;
}
