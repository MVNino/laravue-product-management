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

    // Put ProductDto in method arguments
    public function create(array $productData): Product | Exception
    {
        try {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'category' => $productData['category']
            ]);

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

    public function update(Product $product, array $productData): Product | null | Exception
    {
        try {
            $product->name = $productData['name'];
            $product->description = $productData['description'];
            $product->category = $productData['category'];
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
