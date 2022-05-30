<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
    <style>
        .chat-box .chat-content {
            background-color: #f6f5f5 !important;
            height: 300px;
            overflow: hidden;
            padding-top: 25px !important;
        }

        .chat-box .chat-content .chat-item {
            display: inline-block;
            width: 100%;
            margin-bottom: 25px;
        }

        .chat-box .chat-content .chat-item > img {
            float: left;
            width: 50px;
            border-radius: 50%;
        }

        .chat-box .chat-content .chat-item .chat-details {
            margin-left: 70px;
        }

        .chat-box .chat-content .chat-item .chat-details .chat-text {
            box-shadow: 0 4px 8px rgb(0 0 0 / 3%);
            background-color: #fff;
            padding: 10px 15px;
            border-radius: 3px;
            width: auto;
            display: inline-block;
            font-size: 12px;
        }

        .chat-box .chat-content .chat-item .chat-details .chat-time {
            margin-top: 5px;
            font-size: 12px;
            font-weight: 500;
            opacity: 0.6;
        }

        .chat-box .chat-content .chat-item.chat-right img {
            float: right;
        }

        .chat-box .chat-content .chat-item.chat-right .chat-details {
            margin-left: 0;
            margin-right: 70px;
            text-align: right;
        }

        .chat-box .chat-form .btn {
            padding: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            position: absolute;
            bottom: -5px;
            right: 5px;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0 4px 8px rgb(0 0 0 / 3%);
        }

        .chat-box .chat-form .form-control {
            border: none;
            padding: 15px;
            height: 50px;
            padding-right: 70px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: none;
            outline: none;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var array $chats */ ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Chat</h1>
        </div>
    </div>

    <div class="container">
        <div class="col-12">
            <div class="card chat-box card-success" id="mychatbox2">
                <div class="card-header">
                    <h4>Chat dengan admin</h4>
                </div>
                <div class="card-body chat-content" id="chat-container" tabindex="3" style="overflow: auto; outline: none;">
                    <?php foreach($chats as $chat): ?>
                        <div class="chat-item <?= $chat->reply_to ? 'chat-left' : 'chat-right'; ?>" style="">
                            <img src="<?= base_url('admin/img/avatar/avatar-5.png'); ?>" />
                            <div class="chat-details">
                                <div class="chat-text"><?= $chat->description; ?></div>
                                <div class="chat-time"><?= date('l, d F Y H:i', strtotime($chat->created_at)); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer chat-form">
                    <form id="chat-form2" action="<?= route_to('member.chats.store'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="text" class="form-control" placeholder="Tulis pesan" name="description">
                        <button class="btn btn-primary">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <?php if ($errors = session()->getFlashdata('errors')): ?>
                <div class="alert-danger alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <script>
        var objDiv = document.getElementById("chat-container");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
<?= $this->endSection() ?>