<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductMedia extends Model
{
    protected $table = 'product_medias';

    protected $allowedFields = ['product_id', 'media', 'type'];

    public const TYPE_IMAGE = 'image';
    public const TYPE_VIDEO = 'video';
}
