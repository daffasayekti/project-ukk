<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $title; ?></title>

    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/aos.css" />
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="main-panel">
            <?= $this->include('/layouts/navbar') ?>
            <?= $this->renderSection('content'); ?>
            <?= $this->include('/layouts/footer') ?>
        </div>
    </div>

    <!-- My JS -->
    <script src="/assets/js/vendor.bundle.base.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/demo.js"></script>
    <script src="/assets/js/jquery.easeScroll.js"></script>
</body>

</html>