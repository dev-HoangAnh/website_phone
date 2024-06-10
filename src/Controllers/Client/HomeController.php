<?php

namespace Hoanh\WebsitePhone\Controllers\Client;

use Hoanh\WebsitePhone\Commons\Controller;
use Hoanh\WebsitePhone\Models\Product;

class HomeController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        $products = $this->product->all();

        $this->renderViewClient('home', [
            'products' => $products
        ]);
    }
}
