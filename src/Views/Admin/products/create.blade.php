<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm mới sản phẩm</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Thêm mới sản phẩm</h1>

    @if (!empty($_SESSION['errors']))
    <div class="alert alert-warning">
        <ul>
            @foreach ($_SESSION['errors'] as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

        @php
        unset($_SESSION['errors']);
        @endphp
    </div>
    @endif

    <form action="{{ url('admin/products/store') }}" enctype="multipart/form-data" method="POST">
    <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{ $product['name'] }}" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="Caregory" class="form-label" placeholder="Enter category" >Category:</label>
            <select name="category" id="category">
                <option value="{{ $categories['name'] }}"></option>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">price:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" value="{{ $product['price'] }}" name="price">
        </div>
        <div class="mb-3 mt-3">
            <label for="img_thumbnail" class="form-label">img_thumbnail:</label>
            <input type="file" class="form-control" id="img_thumbnail" placeholder="Enter img_thumbnail" name="img_thumbnail">
            <img src="{{ asset($product['img_thumbnail']) }}" alt="" width="100px">
        </div>
        <div class="mb-3 mt-3">
            <label for="overview" class="form-label">overview:</label>
            <input type="text" class="form-control" id="overview" placeholder="Enter overview" value="{{ $product['overview'] }}" name="overview">
        </div>
        <div class="mb-3 mt-3">
            <label for="content" class="form-label">content:</label>
            <input type="text" class="form-control" id="content" placeholder="Enter content" value="{{ $product['content'] }}" name="content">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>