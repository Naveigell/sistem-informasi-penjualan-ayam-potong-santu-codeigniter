<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Pengeluaran
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $expenditure */ ?>
        <form action="<?= @$expenditure ? route_to('admin.expenditures.update', $expenditure->id) : route_to('admin.expenditures.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$expenditure): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Pengeluaran</h4>
            </div>
            <div class="card-body">

                <?php if ($errors = session()->getFlashdata('errors')): ?>
                    <div class="alert-danger alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (@$expenditure): ?>
                    <div class="form-group">
                        <label>Id Pengeluaran</label>
                        <input readonly type="text" class="form-control" value="<?= @$expenditure ? strtoupper($expenditure->rand_id) : ''; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label>Tanggal Publish</label>
                    <input name="publish_date" type="date" class="form-control" value="<?= @$expenditure ? date('Y-m-d', strtotime($expenditure->publish_date)) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Sub Pengeluaran</label>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body" id="expenditure-container">
                            <?php if (@$expenditure): ?>

                                <?php
                                    $subExpenditures = (new \App\Models\SubExpenditure())->where('expenditure_id', $expenditure->id)->get()->getResultObject();
                                ?>

                                <?php foreach($subExpenditures as $subExpenditure): ?>

                                    <?php $bytes = uniqid(); ?>

                                    <div class="row" id="row-<?= $bytes; ?>">
                                        <div class="form-group col-3">
                                            <label>Nama Pengeluaran</label>
                                            <input name="name[]" type="text" class="form-control" value="<?= $subExpenditure->name; ?>">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>Jumlah</label>
                                            <input name="quantity[]" type="text" class="form-control nominal" value="<?= $subExpenditure->quantity; ?>">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>Nominal</label>
                                            <input name="nominal[]" type="text" class="form-control nominal" value="<?= $subExpenditure->nominal; ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Deskripsi</label>
                                            <input name="description[]" type="text" class="form-control" value="<?= $subExpenditure->description; ?>">
                                        </div>
                                        <div class="form-group col-1">
                                            <label>Action</label> <br>
                                            <button type="button" data-row-id="row-<?= $bytes; ?>" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            <?php else: ?>

                                <?php $bytes = uniqid(); ?>

                                <div class="row" id="row-<?= $bytes; ?>">
                                    <div class="form-group col-3">
                                        <label>Nama Pengeluaran</label>
                                        <input name="name[]" type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Jumlah</label>
                                        <input name="quantity[]" type="text" class="form-control nominal" value="">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Nominal</label>
                                        <input name="nominal[]" type="text" class="form-control nominal" value="">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Deskripsi</label>
                                        <input name="description[]" type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group col-1">
                                        <label>Action</label> <br>
                                        <button type="button" data-row-id="row-<?= $bytes; ?>" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <button onclick="addPengeluaran()" type="button" class="btn btn-info">Tambah</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        function addPengeluaran() {
            let id = (Math.random() + 1).toString(36) + Date.now();

            $('#expenditure-container').append(`
                             <div class="row" id="row-${id}">
                                <div class="form-group col-3">
                                    <label>Nama Pengeluaran</label>
                                    <input name="name[]" type="text" class="form-control" value="">
                                </div>
                                <div class="form-group col-2">
                                    <label>Jumlah</label>
                                    <input name="quantity[]" type="text" class="form-control nominal" value="">
                                </div>
                                <div class="form-group col-2">
                                    <label>Nominal</label>
                                    <input name="nominal[]" type="text" class="form-control nominal" value="">
                                </div>
                                <div class="form-group col-4">
                                    <label>Deskripsi</label>
                                    <input name="description[]" type="text" class="form-control" value="">
                                </div>
                                <div class="form-group col-1">
                                    <label>Action</label> <br>
                                    <button type="button" data-row-id="row-${id}" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>`);

            addPengeluaranEvent();

            $(".nominal").inputmask({
                alias : "currency",
                groupSeparator: ",",
                prefix: "",
                placeholder: "",
                allowPlus: false,
                allowMinus: false,
                rightAlign: false,
                digits: 0,
                removeMaskOnSubmit: true,
            });
        }
    </script>
    <script>
        addPengeluaranEvent();

        function addPengeluaranEvent() {
            $(document).delegate('.btn-delete', 'click', function (evt) {
                try {
                    document.getElementById($(evt.currentTarget).data('row-id')).remove();
                } catch (e) {
                }
            });
        }
    </script>
<?= $this->endSection() ?>