<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Chat
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<?php /** @var array $users */ ?>
<?php /** @var array $chats */ ?>
<?php /** @var object $user */ ?>
<div class="row align-items-start justify-content-center">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Chat Aktif</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <?php
                    foreach($users as $activeUser): ?>
                        <li class="media">
                            <img alt="image" class="mr-3 rounded-circle" width="50" src="<?= base_url('admin/img/avatar/avatar-1.png'); ?>">
                            <div class="media-body">
                                <a href="<?= route_to('admin.chats.show', $activeUser->id); ?>" class="mt-0 mb-1 font-weight-bold text-primary" style="text-decoration: none;"><?= $activeUser->name; ?></a>
                                <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Member</div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card chat-box card-success" id="mychatbox2">
            <div class="card-header">
                <h4><i class="fas fa-circle text-success mr-2" title="" data-toggle="tooltip" data-original-title="Online"></i> Chat dengan <?= $user->name; ?></h4>
            </div>
            <div class="card-body chat-content" id="chat-container" tabindex="3" style="overflow: auto; outline: none;">
                <?php foreach($chats as $chat): ?>
                    <div class="chat-item <?= $chat->reply_to ? 'chat-right' : 'chat-left'; ?>" style="">
                        <img src="<?= base_url('admin/img/avatar/avatar-5.png'); ?>" />
                        <div class="chat-details">
                            <div class="chat-text"><?= $chat->description; ?></div>
                            <div class="chat-time"><?= date('l, d F Y H:i', strtotime($chat->created_at)); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form2" action="<?= route_to('admin.chats.store', $user->id); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="text" class="form-control" name="description" placeholder="Tulis Pesan .." />
                    <button class="btn btn-primary">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
            <?php if ($errors = session()->getFlashdata('errors')): ?>
                <div class="text-danger text">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <script>
        var objDiv = document.getElementById("chat-container");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
<?= $this->endSection() ?>