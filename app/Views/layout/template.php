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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/style1.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/components.css'); ?>">

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/trix.css'); ?>">
    <script type="text/javascript" src="<?= base_url('/assets/js/trix.js'); ?>"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
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

    <script>
        function previewImg() {
            const gambar = document.querySelector('#image-upload');
            const gambarLabel = document.querySelector('#image-label');
            const imgProfile = document.querySelector('.preview-img');

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