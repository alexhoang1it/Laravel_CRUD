<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * get image by productIds
     */
    public function getImages(array $productIds) {
        $result = $this::join('product_images', 'product_images.image_id', '=', 'images.id')
        ->whereIn('product_images.product_id', $productIds)
        ->select('images.id', 'images.type', 'images.link', 'product_images.product_id as product_id')
        ->get()->toArray();
        return $result;
    }
}
