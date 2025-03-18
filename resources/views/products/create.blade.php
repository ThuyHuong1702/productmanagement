<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo sản phẩm mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tạo sản phẩm mới</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="in_stock" class="form-label">Tình trạng kho</label>
                <select class="form-select" id="in_stock" name="in_stock">
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Trạng thái</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="1">Hoạt động</option>
                    <option value="0">Ngừng kinh doanh</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        </form>
    </div>
</body>
</html>
