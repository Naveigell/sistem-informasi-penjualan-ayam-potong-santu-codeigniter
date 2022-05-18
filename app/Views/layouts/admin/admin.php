<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Default &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <?= $this->include('layouts/admin/style'); ?>
    <?= $this->renderSection('content-style') ?>

</head>

<body>
<div id="app">
    <div class="main-wrapper">

        <?= $this->include('layouts/admin/header'); ?>
        <?= $this->include('layouts/admin/sidebar'); ?>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1><?= $this->renderSection('content-title') ?></h1>
                </div>

                <div class="section-body">
                    <?= $this->renderSection('content-body') ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">
                2.3.0
            </div>
        </footer>
    </div>
</div>

<?= $this->include('layouts/admin/script'); ?>
<?= $this->renderSection('content-script') ?>
<!-- Page Specific JS File -->
<script>
    $(".data-table").dataTable();
</script>
</body>
</html>
