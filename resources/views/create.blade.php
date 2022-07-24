<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add || DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form class="row g-3" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Thêm mới xe</h1>
            <strong><a href="{{route('products.index')}}">Quay lại trang chủ</a></strong>
            <div class="col-md-6">
              <label for="" class="form-label" >Image</label>
              <img style="height: 100px;width: 100px;" src="/images/{{isset($product)?$product->img:''}}" alt="" id="newimage">
              <input type="file" class="form-control" id="image" name="img" onchange="changeImage(event)">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Name Product</label>
              <input type="text" class="form-control" id="inputMake" name="product_name">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Description</label>
              <input type="text" class="form-control" id="inputMake" name="description">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Price</label>
              <input type="text" class="form-control" id="inputMake" name="price">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Version id</label>
              <input type="text" class="form-control" id="inputMake" name="version_id">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Service id</label>
              <input type="text" class="form-control" id="inputMake" name="service_id">
            </div>
            <select class="form-select select-mt3" name="version_id">
              <option value="1">Iphone</option>
              <option value="2">Sam sung</option>
              <option value="3">Oppo</option>
              <option value="4">Redmi</option>
              <option value="5">Realme</option>
              <option value="6">Ilumia</option>
              <option value="7">Nokia</option>
            </select>
            <select class="form-select select-mt3" name="service_id">
              <option value="1">sửa điện thoại</option>
              <option value="2">Thay pin</option>
              <option value="3">Thay ốp</option>
              <option value="4">Sửa kính</option>
            </select>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Add new car</button>
            </div>
          </form>
    </div>
    <script src="/js/getImage.js"></script>
</body>
</html>