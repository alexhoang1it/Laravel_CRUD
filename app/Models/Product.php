<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'discount_percentage',
        'rating',
        'stock',
        'brand',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'cart_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function scopeSearch($query, $searchParam)
    {
        if (!empty($searchParam['title'])) {
            $query->where('title', 'like', '%' . $searchParam['title'] . '%');
        }

        if (!empty($searchParam['price'])) {
            $query->where('price', $searchParam['price']);
        }

        return $query;
    }

    public function getDetail(int $productId)
    {
        $result = $this::join('carts', 'carts.id', '=', 'products.cart_id')
            ->where('products.id', '=', $productId)
            ->select('products.*', 'carts.title as category')->first();

        if (!$result) {
            return $result;
        }
        return $result->toArray();
    }

    public function getListProduct()
    {
        $result = $this::join('carts', 'carts.id', '=', 'products.cart_id')
        ->select('products.*', 'carts.title as category')->get()->toArray();

        return $result;
    }

    public function searchProduct(int $limit, int $skip, array $searchParam)
    {
        $query = $this::join('carts', 'carts.id', '=', 'products.cart_id');

        if (!empty($searchParam['title'])) {
            $query->where('title', 'like', '%' . $searchParam['title'] . '%');
        }

        if (!empty($searchParam['price'])) {
            $query->where('price', $searchParam['price']);
        }

        //get total
        $total = $query->count();
        $result = [
            'total' => $total,
            'skip' => $skip,
            'limit' => $limit,
            'products' => array()
        ];
        if ($total == 0) {
            return $result;
        }

        $result['products'] = $query->select('products.*', 'carts.title as category')
            ->limit($limit)->offset($skip)->get()->toArray();

        return $result;
    }
}
