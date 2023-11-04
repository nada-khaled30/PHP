<?php
class Product
{
    private $name;
    private $imageUrl;
    private $price;
    private $categories = [];

    public function __construct($name, $imageUrl, $price)
    {
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }
}

class Category
{
    private $name;
    private $products = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }
}

class Variant
{
    private $name;
    private $details;

    public function __construct($name, $details)
    {
        $this->name = $name;
        $this->details = $details;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDetails()
    {
        return $this->details;
    }
}

class Cart
{
    private $items = [];
    private $totalPrice = 0;

    public function addItem(Product $product, $quantity = 1)
    {
        if (array_key_exists($product->getName(), $this->items)) {
            $this->items[$product->getName()] += $quantity;
        } else {
            $this->items[$product->getName()] = $quantity;
        }
        $this->totalPrice += $product->getPrice() * $quantity;
    }

    public function removeItem(Product $product, $quantity = 1)
    {
        if (array_key_exists($product->getName(), $this->items)) {
            if ($this->items[$product->getName()] <= $quantity) {
                $this->totalPrice -= $product->getPrice() * $this->items[$product->getName()];
                unset($this->items[$product->getName()]);
            } else {
                $this->items[$product->getName()] -= $quantity;
                $this->totalPrice -= $product->getPrice() * $quantity;
            }
        }
    }

    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->items as $productName => $quantity) {
            $product = findProductByName($productName); 
            if ($product) {
                $this->totalPrice += $product->getPrice() * $quantity;
            }
        }
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function completePurchase()
    {
    }
}

function findProductByName($name)
{
    
    $products = [
        new Product("Product 1", "image1.jpg", 10.00),
        new Product("Product 2", "image2.jpg", 15.00),
        
    ];

    // Search for the product in the array
    foreach ($products as $product) {
        if ($product->getName() === $name) {
            return $product;
        }
    }

    // Return null if the product is not found
    return null;
}
