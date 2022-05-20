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
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="form-delete" method="post" action="">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Item tidak akan bisa dikembalikan</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
<!-- Page Specific JS File -->
<script>
    $(".data-table").dataTable();
    $(".btn-delete").on('click', function () {
        $('#form-delete').attr("action", $(this).data('url'));
    })
</script>
</body>
</html>
