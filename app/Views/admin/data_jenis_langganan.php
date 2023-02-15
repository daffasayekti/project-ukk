<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jenis Langganan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/admin/create_jenis_langganan" class="badge badge-primary py-lg-2" style="box-shadow:0 2px 6px #6777ef">Add Langganan</a></div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class=" alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Success!</b> <?= session()->getFlashData('success'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-body">
            <div class="card">
                <div class="card-header justify-content-end">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Jenis Langganan" autocomplete="off">
                        </div>
                        <div class="float-right ml-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Layanan</th>
                                <th>Harga Langganan</th>
                                <th>Periode Langganan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_jenis_langganan as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td>Layanan <?= $value['nama_langganan']; ?></td>
                                    <td class="text-center">Rp. <?= number_format($value['harga_langganan'], 0, ",", "."); ?></td>
                                    <td class="text-center"><?= $value['waktu_langganan']; ?> Hari</td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/admin/edit_jenis_langganan/<?= $value['id_langganan']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="/admin/hapus_jenis_langganan/<?= $value['id_langganan']; ?>" class="btn btn-danger btn-sm ml-1 hapus-langganan"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php if (empty($data_jenis_langganan)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Jenis Langganan Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('jenis_langganan', 'pagination_data_jenis_langganan'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const hapusLangganan = document.querySelectorAll(".hapus-langganan")

    for (let i = 0; i < hapusLangganan.length; i++) {
        hapusLangganan[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Jenis Langganan Tersebut ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }
</script>
<?= $this->endSection(); ?>