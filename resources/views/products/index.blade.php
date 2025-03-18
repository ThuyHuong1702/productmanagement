<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách sản phẩm</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Tạo Sản Phẩm</a>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div>
                <select class="form-select" style="width: auto;">
                    <option value="20">Hiển thị 20</option>
                    <option value="50">Hiển thị 50</option>
                    <option value="100">Hiển thị 100</option>
                </select>
            </div>
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                <button class="btn btn-outline-secondary">🔍</button>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>
                        <a href="{{ route('products.index', ['sort' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                            ID
                            @if(request('sort') === 'asc')
                                🔼
                            @else
                                🔽
                            @endif
                        </a>
                    </th>
                    <th>Tên sản phẩm</th>
                    <th>SKU</th>
                    <th>Giá</th>
                    <th>Kho hàng</th>
                    <th>Trạng thái</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><input type="checkbox" class="product-checkbox"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>
                        @if($product->special_price && now()->between($product->special_price_start, $product->special_price_end))
                            <span class="text-danger fw-bold">{{ number_format($product->special_price, 2) }}₫</span>
                            <del class="text-muted">{{ number_format($product->price, 2) }}₫</del>
                        @else
                            {{ number_format($product->price, 2) }}₫
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $product->in_stock ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->in_stock ? 'Còn hàng' : 'Hết hàng' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $product->is_active ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $product->is_active ? 'Hoạt động' : 'Ngừng kinh doanh' }}
                        </span>
                    </td>
                    <td>{{ $product->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="d-flex justify-content-between">
            <button class="btn btn-danger">🗑️ Xóa</button>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectAllCheckbox = document.getElementById("selectAll");
            const productCheckboxes = document.querySelectorAll(".product-checkbox");

            // Xử lý chọn tất cả checkbox
            selectAllCheckbox.addEventListener("change", function () {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Xử lý chọn riêng từng sản phẩm
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function () {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false; // Bỏ chọn "Chọn tất cả" nếu bỏ chọn một ô
                    } else {
                        // Nếu tất cả các checkbox sản phẩm đều được chọn, cũng chọn "Chọn tất cả"
                        selectAllCheckbox.checked = [...productCheckboxes].every(cb => cb.checked);
                    }
                });
            });
        });
    </script>

</body>
</html>
