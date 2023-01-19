<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Judul Website -->
    <title><?= $title; ?></title>

    <!-- Boostrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/style1.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/components.css'); ?>">

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/trix.css'); ?>">
    <script type="text/javascript" src="<?= base_url('/assets/js/trix.js'); ?>"></script>

    <!-- ChartJS -->
    <script type="text/javascript" src="<?= base_url('/assets/js/Chart.min.js'); ?>"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <link rel="shortcut icon" href="/assets/images/favicon.png" />
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            <?= $this->include('/layout/navbar') ?>
            <?= $this->include('/layout/sidebar') ?>
            <?= $this->renderSection('content'); ?>
            <?= $this->include('/layout/footer'); ?>

        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <!-- JS Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- My JS -->
    <script src="<?= base_url('/assets/js/stisla.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/scripts.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/custom.js'); ?>"></script>
</body>

</html>