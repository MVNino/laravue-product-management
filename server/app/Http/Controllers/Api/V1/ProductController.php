<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\ProductDto;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Response $response): \Illuminate\Http\JsonResponse
    {
        $limit = $request->query()['limit'] ?? 10;
        $page = $request->query()['page'] ?? 1;

        $products = $this->productService->findAll($page, $limit);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $product = $this->productService->create($request->input());

            return response()->json(['data' => $product, 'message' => 'Created'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $product, 'message' => 'Find One']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): \Illuminate\Http\JsonResponse
    {
        try {
            $product = $this->productService->update($product, $request->input());

            return response()->json(['data' => $product, 'message' => 'Updated']);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product = $this->productService->destroy($product);

        return response()->json(['data' => $product, 'message' => 'Deleted']);
    }
}
