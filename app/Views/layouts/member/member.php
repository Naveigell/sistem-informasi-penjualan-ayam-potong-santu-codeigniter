<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('member/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('member/css/style.css'); ?>" rel="stylesheet">
    <?= $this->renderSection('content-style') ?>
</head>

<body>

<?= $this->include('layouts/member/header'); ?>

<?= $this->renderSection('content-body') ?>

<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="<?= route_to('home'); ?>" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E-commerce</span>
                    <br>Daging Ayam Santu</h1>
            </a>
            <p>Usaha ayam potong santu merupakan salah satu Usaha yang bergerak dibidang penjualan ayam potong di daerah Ubud, Gianyar, Bali.</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Jln Raya Ubud, No. 35 Kecamatan Ubud, Kabupaten Gianyar.</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>santuriani12@gmail.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+6281239682074</p>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<?= $this->include('layouts/member/script'); ?>
<?= $this->renderSection('content-script') ?>
</body>

</html>