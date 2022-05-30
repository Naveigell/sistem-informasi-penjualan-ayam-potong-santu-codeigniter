<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Chat
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var array $users */ ?>
    <div class="row align-items-center justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Chat Aktif</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <?php
                        foreach($users as $user): ?>
                            <li class="media">
                                <img alt="image" class="mr-3 rounded-circle" width="50" src="<?= base_url('admin/img/avatar/avatar-1.png'); ?>">
                                <div class="media-body">
                                    <a href="<?= route_to('admin.chats.show', $user->id); ?>" class="mt-0 mb-1 font-weight-bold text-primary" style="text-decoration: none;"><?= $user->name; ?></a>
                                    <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Member</div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
