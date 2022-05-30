<?php

namespace App\Models;

use CodeIgniter\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $allowedFields = ['user_id', 'reply_to', 'description', 'created_at'];
}
