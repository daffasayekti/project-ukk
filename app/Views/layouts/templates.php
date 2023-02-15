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

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <link rel="shortcut icon" href="/assets/images/favicon.png" />

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/trix.css'); ?>">
    <script type="text/javascript" src="<?= base_url('/assets/js/trix.js'); ?>"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.js-example-basic-multiple').select2({
                    tags: true
                });
            }, 200);
        });
    </script>

    <script>
        function editProfile() {
            const gambar = document.querySelector('#profile_img');
            const gambarLabel = document.querySelector('.form-control');
            const imgProfile = document.querySelector('.previewImg');

            gambarLabel.textContent = gambar.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(gambar.files[0]);

            fileSampul.onload = function(e) {
                imgProfile.src = e.target.result;
            }
        }
    </script>
</body>

</html>