<?php

namespace App\Services;

use App\Contracts\Messages;
use App\Contracts\ProcessResult;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{
    /**
     * create Product logic
     * @param array $productInfo product info
     * @return Product $product
     */
    public function createProduct(array $productInfo)
    {
        DB::beginTransaction();

        // create product logic
        $product = Product::create($productInfo);
        if (!$product) {
            DB::rollBack();
            return false;
        }

        //save product image

        DB::commit();
        return $product;
    }

    /**
     * Get detail product
     * @param int $productId id of product
     * @return array $productDetail product detail
     */
    public function getDetail(int $productId)
    {
        // get product by ID
        $product = new Product();
        $productDetail = $product->getDetail($productId);
        if (!$productDetail) {
            return $productDetail;
        }

        //get image
        $image = new Image();
        $listImages = $image->getImages(array($productId));
        if (!$listImages) {
            return $productDetail;
        }

        foreach ($listImages as $image) {
            //thumbnail
            if ($image['type'] == 1) {
                $productDetail['thumbnail'] = $image['link'];
            } else if ($image['type'] == 2) { //image
                $productDetail['images'][] = $image['link'];
            }
        }

        return $productDetail;
    }

    /**
     * Get list product
     * @param int $limit limit
     * @param int $skip offset
     * @param array $searchParam content search param
     * @return array $result list of product
     */
    public function getProductsPaginated($limit, $skip, $searchParam)
    {
        // call search
        $product = new Product();
        $products = $product->searchProduct($limit, $skip, $searchParam);
        if (count($products['products']) == 0) {
            return $products;
        }

        //get list product id
        $productIds = array();
        foreach ($products['products'] as &$product) {
            $product['thumbnail'] = '';
            $product['images'] = array();
            $productIds[] = $product['id'];
        }

        //get image
        $image = new Image();
        $listImages = $image->getImages($productIds);
        if (!$listImages) {
            return $products;
        }

        foreach ($products['products'] as &$productDetail) {
            foreach ($listImages as $image) {
                if($productDetail['id'] == $image['product_id'])
                //thumbnail
                if ($image['type'] == 1) {
                    $productDetail['thumbnail'] = $image['link'];
                } else if ($image['type'] == 2) { //image
                    $productDetail['images'][] = $image['link'];
                }
            }
        }

        return $products;
    }

    public function getProducts()
    {
        // call search
        $product = new Product();
        $products = $product->getListProduct();
        if (count($products) == 0) {
            return $products;
        }

        //get list product id
        $productIds = array();
        foreach ($products as &$product) {
            $product['thumbnail'] = '';
            $product['images'] = array();
            $productIds[] = $product['id'];
        }

        //get image
        $image = new Image();
        $listImages = $image->getImages($productIds);
        if (!$listImages) {
            return $products;
        }

        foreach ($products as &$productDetail) {
            foreach ($listImages as $image) {
                if($productDetail['id'] == $image['product_id'])
                //thumbnail
                if ($image['type'] == 1) {
                    $productDetail['thumbnail'] = $image['link'];
                } else if ($image['type'] == 2) { //image
                    $productDetail['images'][] = $image['link'];
                }
            }
        }

        return $products;
    }

    /**
     * Update product
     * @param int $productId product id
     * @param array $productData product data
     */
    public function updateProduct(int $productId, array $productData)
    {
        //get product
        $product = Product::find($productId);

        // return if not found product
        if (!$product) {
            return false;
        }

        // update product
        $product->update($productData);

        return $product;
    }

    /**
     * Delete product
     * @param int $productId product id
     */
    public function deleteProduct(int $productId)
    {
        //get product
        $product = Product::find($productId);

        if (!$product) {
            return false;
        }

        // delete product
        $product->delete();

        return true;
    }
}
