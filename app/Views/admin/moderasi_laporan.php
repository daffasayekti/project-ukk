<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Moderasi Laporan</h1>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Judul Laporan" autocomplete="off">
                        </div>
                        <div class="float-right ml-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md" id="table">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Isi Laporan</th>
                                <th>Nama Pengirim</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_laporan_moderasi as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['isi_pesan']; ?></td>
                                    <td class="text-center">
                                        <?= $value['nama_pengirim']; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/proses_moderasi_laporan/<?= $value['id_laporan']; ?>" class="btn btn-success ml-1 btn-sm setuju-moderasi-laporan"><i class="fas fa-check-circle"></i></a>
                                        <a href="/admin/gagal_moderasi_laporan/<?= $value['id_laporan']; ?>" class="btn btn-danger ml-1 btn-sm gagal-moderasi-laporan"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_laporan_moderasi)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Tidak Ada Laporan Yang Perlu Dimoderasi!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_laporan_masyarakat', 'pagination_data_moderasi_laporan'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    const setujuModerasiLaporan = document.querySelectorAll(".setuju-moderasi-laporan")

    for (let i = 0; i < setujuModerasiLaporan.length; i++) {
        setujuModerasiLaporan[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menyetujui Moderasi Laporan Tersebut ?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }

    const gagalModerasiLaporan = document.querySelectorAll(".gagal-moderasi-laporan")

    for (let i = 0; i < gagalModerasiLaporan.length; i++) {
        gagalModerasiLaporan[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menggagalkan Moderasi Laporan Tersebut ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Gagalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }
</script>
<?= $this->endSection(); ?>