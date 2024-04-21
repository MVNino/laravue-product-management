<?php

namespace App\Dto;

class ProductDto
{
    public string $name;
    public string $description;
    public string $category;

    public function __construct(string $name, string $description, string $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
        ];
    }
}
