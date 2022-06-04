<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Produk
<?= $this->endSection() ?>

<?= $this->section('content-title') ?>
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $product */ ?>
        <form action="<?= @$product ? route_to('admin.products.update', $product->id) : route_to('admin.products.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$product): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Produk</h4>
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
                <div class="form-group">
                    <label>Foto Produk</label>
                    <input name="image" type="file" accept="image/png,image/jpeg,image/jpg" class="form-control">
                </div>
                <div class="form-group">
                    <label>Video Produk</label>
                    <input name="video" type="file" accept="video/*" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input name="name" type="text" class="form-control" value="<?= @$product ? $product->name : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Kategori Produk</label>
                    <select class="form-control" name="category_id" id="">
                        <option value="">Nothing selected</option>
                        <?php /** @var array $categories */
                        foreach ($categories as $category): ?>
                            <option <?php if (@$product): ?>
                                <?php if ($product->id == $category->id): ?>
                                    selected
                                <?php endif; ?>
                            <?php endif; ?> value="<?= $category->id; ?>"><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10"><?= @$product ? $product->description : ''; ?></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
<script src="<?= base_url('/vendor/ckeditor5/build/ckeditor.js'); ?>"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            height: 400,
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            // heading: {
            //     options: [
            //         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            //         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            //         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            //     ]
            // }
        } )
        .catch( error => {
            console.log( error );
        } );
</script>
<?= $this->endSection() ?>
