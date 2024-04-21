<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Models\Product;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function findAll(int $page, int $limit): LengthAwarePaginator
    {
        $products = Product::latest()->paginate($limit);

        return $products;
    }

    public function create(ProductDto $productData): Product | Exception
    {
        try {
            $product = Product::create($productData->toArray());

            return $product;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function find(int $productId): ?Product
    {
        $product = Product::find($productId);

        if (!$product) return null;

        return $product;
    }

    public function update(Product $product, ProductDto $productData): Product | null | Exception
    {
        try {
            $product->name = $productData->name;
            $product->description = $productData->description;
            $product->category = $productData->category;
            $product->save();

            return $product;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy(Product $product): ?Product
    {
        $product->delete();

        return $product;
    }
}
