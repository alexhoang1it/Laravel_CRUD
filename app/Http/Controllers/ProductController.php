<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    //product service
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Create Product
     * @param CreateProductRequest $request
     */
    public function create(CreateProductRequest $request)
    {
        //product services
        $product = $this->productService->createProduct($request->validated());

        if (!$product) {
            return response()->json($product, 500);
        }

        return response()->json($product, 201);
    }

    /**
     * Get detail product
     */
    public function detail($productId)
    {
        //product services
        $productDetail = $this->productService->getDetail($productId);

        // return when product not found
        if (!$productDetail) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return product
        return response()->json($productDetail);
    }

    /**
     * Get list product
     */
    public function getProducts(Request $request)
    {
        $result = $this->productService->getProducts();

        return response()->json(['products' => $result]);
    }
    /**
     * Get list product
     */
    public function search(Request $request)
    {
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);
        $searchParam = [
            'title' => $request->get('title', ''),
            'price' => $request->get('price', '')
        ];

        $result = $this->productService->getProductsPaginated($limit, $offset, $searchParam);

        return response()->json($result);
    }

    /**
     * Update product
     */
    public function update(CreateProductRequest $request, $productId)
    {
        $updatedProduct = $this->productService->updateProduct($productId, $request->all());

        // return when product not found
        if (!$updatedProduct) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return product
        return response()->json(['product' => $updatedProduct]);
    }

    /**
     * Delete product
     */
    public function delete($productId)
    {
        $result = $this->productService->deleteProduct($productId);

        if ($result) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
