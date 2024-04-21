<?php

namespace App\Http\Controllers\Api;

use App\Dto\ProductDto;
use App\Enums\HttpCode;
use App\Enums\Pagination;
use App\Enums\ResponseMessage;
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
        $limit = $request->query()['limit'] ?? Pagination::LIMIT_DEFAULT;
        $page = $request->query()['page'] ?? Pagination::PAGE_DEFAULT;

        $products = $this->productService->findAll($page, $limit);

        return response()->json($products, HttpCode::OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productDto = new ProductDto(...$request->validated());

            $product = $this->productService->create($productDto);

            return response()->json(
                ['data' => $product, 'message' => ResponseMessage::CREATED],
                HttpCode::CREATED
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpCode::SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $product, 'message' => ResponseMessage::FIND_ONE]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {
        try {
            $productDto = new ProductDto(...$request->validated());

            $product = $this->productService->update($product, $productDto);

            return response()->json(['data' => $product, 'message' => ResponseMessage::UPDATED]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpCode::SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product = $this->productService->destroy($product);

        return response()->json(['data' => $product, 'message' => ResponseMessage::DELETED]);
    }
}
