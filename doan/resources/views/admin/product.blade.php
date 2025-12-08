@extends('admin.dashboard')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <h3>Product List</h3>
    </div>

    <!-- Search bar -->
    <div class="col-md-6 mb-3">
        <form class="d-flex" role="search" onsubmit="event.preventDefault(); filterTable();">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="Search product..." />
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row pt-2">
        <div class="col-md-2 mb-3">
            <a href="#" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</a>
        </div>
    </div>

    <!-- Table -->
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-2" id="productTable">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/' . ($product->photo ?? 'no-image.jpg')) }}?t={{ $product->updated_at->timestamp }}"
                                width="130" height="130" style="object-fit:cover;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <button class="btn btn-info " onclick="showProductModal({{ $product->id }})">View</button>
                            <button class="btn btn-warning " onclick="showEditModal({{ $product->id }})">Edit</button>
                            <button class="btn btn-danger " onclick="confirmDelete({{ $product->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination" class="d-flex justify-content-center mt-3"></div>
        </div>

        <!-- Modal Add Product -->
        <div class="modal fade" id="addProductModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('product_admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="photo" accept="image/*" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal View Product -->
        <div class="modal fade" id="productModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="modalContent"></div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Product -->
        <div class="modal fade" id="editProductModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form id="editProductForm" method="POST" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="editProductId">

                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body row">
                            <div class="col-md-4 text-center mb-3">
                                <label for="editPhoto" style="cursor: pointer;">
                                    <img id="editProductPhotoPreview" src="/storage/images/no-image.jpg"
                                        class="img-thumbnail" style="max-width: 150px;">
                                    <div class="text-muted small mt-2">Click to select image</div>
                                </label>
                                <input type="file" name="photo" id="editPhoto" accept="image/*" class="d-none" onchange="previewPhoto(event)">
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="editName" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" id="editDescription" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" id="editPrice" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" id="editStock" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.product.delete') }}">
                    @csrf
                    <input type="hidden" name="id" id="deleteProductId">

                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">Are you sure you want to delete this product?</div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">OK</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<div id="productsData" data-json='@json($products)'></div>

<script>
    const rowsPerPage = 4;
    let currentPage = 1;
    let filteredRows = [];
    const raw = document.getElementById("productsData").dataset.json;
    const products = JSON.parse(raw);

    function paginateTable() {
        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        document.querySelectorAll("#productTable tbody tr").forEach(row => row.style.display = "none");

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        filteredRows.slice(start, end).forEach(row => row.style.display = "");

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = "btn btn-sm btn-outline-primary mx-1";
            if (i === currentPage) btn.classList.add("active");
            btn.onclick = () => {
                currentPage = i;
                paginateTable();
            };
            pagination.appendChild(btn);
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        filterTable();
    });

    function filterTable() {
        const keyword = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#productTable tbody tr");
        filteredRows = [];

        rows.forEach(row => {
            const nameCell = row.querySelectorAll("td")[1];
            const name = nameCell.textContent.toLowerCase();

            if (name.includes(keyword)) {
                row.style.display = "";
                filteredRows.push(row);
            } else {
                row.style.display = "none";
            }
        });

        currentPage = 1;
        paginateTable();
    }

    function showProductModal(productId) {
        const selected = products.find(p => p.id === productId);
        if (!selected) return;

        const html = `
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="/storage/images/${selected.photo ?? 'no-image.jpg'}"
                        class="img-thumbnail mb-2" style="max-width: 120px;">
                </div>
                <div class="col-md-8">
                    <p><strong>Product:</strong> ${selected.name}</p>
                    <p><strong>Description:</strong> ${selected.description}</p>
                    <p><strong>Price:</strong> ${selected.price}</p>
                    <p><strong>Stock:</strong> ${selected.stock}</p>
                </div>
            </div>
        `;
        document.getElementById("modalContent").innerHTML = html;
        new bootstrap.Modal(document.getElementById('productModal')).show();
    }

    function showEditModal(productId) {
        const selected = products.find(p => p.id === productId);
        if (!selected) return;

        document.getElementById('editProductId').value = selected.id;
        document.getElementById('editName').value = selected.name;
        document.getElementById('editDescription').value = selected.description;
        document.getElementById('editPrice').value = selected.price;
        document.getElementById('editStock').value = selected.stock;

        document.getElementById('editProductPhotoPreview').src =
            selected.photo ? `/storage/images/${selected.photo}` : '/storage/images/no-image.jpg';

        new bootstrap.Modal(document.getElementById('editProductModal')).show();
    }

    function previewPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('editProductPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function confirmDelete(id) {
        document.getElementById('deleteProductId').value = id;
        new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
    }
</script>
@endsection