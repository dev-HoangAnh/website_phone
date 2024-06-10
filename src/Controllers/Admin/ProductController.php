<?php

namespace Hoanh\WebsitePhone\Controllers\Admin;

use Hoanh\WebsitePhone\Commons\Controller;
use Hoanh\WebsitePhone\Models\Category;
use Hoanh\WebsitePhone\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private Product $products;
    private Category $category;

    public function __construct()
    {
        $this->products = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        $products = $this->products->all();

        $this->renderViewAdmin('products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = $this->category->all();
        $categoryPluck = array_column($categories, 'name', 'id');
        $this->renderViewAdmin('products.create',[
            'categoryPluck' => $categoryPluck
        ]);
    }

    public function store()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'category'              => 'required',
            'price'                 => 'required|',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',
            'content'               => 'required', 

        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/products/create'));
            exit;
        } else {
            $data = [
                'name'     => $_POST['name'],
                'category_id'   => $_POST['category'],
                'price_regular'    => $_POST['price'],
                'content'     => $_POST['content'],
            ];

            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload ảnh không thành công';

                    header('Location: ' . url('admin/products/create'));
                    exit;
                }
            }

            $this->products->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url('admin/products'));
            exit;
        }
    }

    public function show($id)
    {
        $products = $this->products->findByID($id);

        $this->renderViewAdmin('products.show', [
            'product' => $products
        ]);
    }

    public function edit($id)
    {
        $products = $this->products->findByID($id);

        $this->renderViewAdmin('products.edit', [
            'product' => $products
        ]);
    }

    public function update($id)
    {
        $products = $this->products->findByID($id);

        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'category'              => 'required',
            'price'                 => 'required|',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',
            'content'               => 'required', 
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/products/{$products['id']}/edit"));
            exit;
        } else {
            $data = [
                'name'     => $_POST['name'],
                'category_id'   => $_POST['category'],
                'price_regular'    => $_POST['price'],
                'content'     => $_POST['content'],
               
            ];

            $flagUpload = false;
            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $flagUpload = true;

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload ảnh không thành công';

                    header('Location: ' . url("admin/products/{$products['id']}/edit"));
                    exit;
                }
            }

            $this->products->update($id, $data);

            if (
                $flagUpload
                && $products['img_thumbnail']
                && file_exists(PATH_ROOT . $products['img_thumbnail'])
            ) {
                unlink(PATH_ROOT . $products['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url("admin/products/{$products['id']}/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        $products = $this->products->findByID($id);

        $this->products->delete($id);

        if (
            $products['img_thumbnail']
            && file_exists(PATH_ROOT . $products['img_thumbnail'])
        ) {
            unlink(PATH_ROOT . $products['img_thumbnail']);
        }

        header('Location: ' . url('admin/products'));
        exit();
    }
}
