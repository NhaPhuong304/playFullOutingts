@extends('admin.dashboard')
@section('page-title', 'Recycle Products')

@section('content')
<style>
/* ===========================
   PRODUCT IMAGE — CLEAN UI
=========================== */
.product-thumb {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    transition: 0.25s ease;
    cursor: pointer;
}

.product-thumb:hover {
    transform: scale(1.12);
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    z-index: 2;
    position: relative;
}
/* ===========================
   ACTION BUTTONS — CLEAN UI
=========================== */

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px !important;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15px;
    transition: 0.25s ease;
}


</style>


<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Trash Products</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="row g-2 align-items-center mb-4">
                <div class="col-12 col-md-4 col-lg-3 ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-hover text-center align-middle" id="productTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->photo ? asset('storage/images/'.$product->photo) : asset('storage/images/no-image.jpg') }}"
                                         class="product-thumb">
                                </td>

                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 60) }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>

                                <td class="btn-group">

                                    <!-- View -->
                                    <button class="btn btn-sm btn-outline-primary viewProductBtn"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-photo="{{ $product->photo }}"
                                        data-description="{{ $product->description }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-success restoreProductBtn"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>

                                    <!-- Delete -->
                                    <button class="btn btn-sm btn-outline-danger deleteProductBtn"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>

<!-- ==========================
     VIEW PRODUCT MODAL
=========================== -->
<div class="modal fade" id="viewProductModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row">

                <!-- ảnh -->
                <div class="col-md-4 text-center mb-3">
                    <img id="viewProductImage"
                        class="rounded border"
                        style="width:150px;height:150px;object-fit:cover;">
                </div>

                <!-- thông tin -->
                <div class="col-md-8">
                    <p><strong>Name:</strong> <span id="viewProductName"></span></p>
                    <p><strong>Description:</strong> <span id="viewProductDescription"></span></p>
                    <p><strong>Price:</strong> $<span id="viewProductPrice"></span></p>
                    <p><strong>Stock:</strong> <span id="viewProductStock"></span></p>
                </div>

            </div>

        </div>
    </div>
</div>


<!-- Confirm Restore/Delete Modal -->
<div class="modal fade" id="confirmActionModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" id="confirmActionHeader">
        <h5 class="modal-title" id="confirmActionTitle">Confirm Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="confirmActionBody">
        Are you sure?
      </div>
      <div class="modal-footer">
        <form id="confirmActionForm" method="POST">
            @csrf
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn" id="confirmActionBtn">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
const rowsPerPage = 6;
let currentPage = 1;
let filteredRows = [];

function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    filteredRows = Array.from(document.querySelectorAll("#productTable tbody tr")).filter(row => {
        const name = row.cells[1].innerText.toLowerCase();
        return name.includes(searchText);
    });
    currentPage = 1;
    paginationTable();
}

function paginationTable() {
    const totalRows = filteredRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    document.querySelectorAll("#productTable tbody tr").forEach(r => r.style.display = "none");
    filteredRows.slice((currentPage-1)*rowsPerPage, currentPage*rowsPerPage).forEach(r => r.style.display = "");
    renderPagination(totalPages);
}

function renderPagination(totalPages) {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";
    for (let i=1;i<=totalPages;i++){
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.className = "btn btn-sm btn-outline-primary mx-1";
        if(i===currentPage) btn.classList.add("active");
        btn.onclick = ()=>{ currentPage=i; paginationTable(); };
        pagination.appendChild(btn);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    filteredRows = Array.from(document.querySelectorAll("#productTable tbody tr"));
    paginationTable();
    document.getElementById('searchInput').addEventListener('input', filterRows);

    const confirmModal = new bootstrap.Modal(document.getElementById('confirmActionModal'));
    const confirmForm = document.getElementById('confirmActionForm');
    const confirmBody = document.getElementById('confirmActionBody');
    const confirmTitle = document.getElementById('confirmActionTitle');
    const confirmHeader = document.getElementById('confirmActionHeader');
    const confirmBtn = document.getElementById('confirmActionBtn');

document.querySelectorAll('.restoreProductBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;

        confirmTitle.textContent = 'Restore Product';
        confirmBody.textContent = `Do you want to restore "${name}"?`;

        confirmBtn.className = 'btn btn-success';
        confirmHeader.className = 'modal-header bg-success text-white';

        confirmForm.action = `/admin/recycle-product/restore/${id}`;
        confirmForm.method = 'POST';

        confirmModal.show();
    });
});


document.querySelectorAll('.viewProductBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        const photo = this.dataset.photo
            ? `/storage/images/${this.dataset.photo}`
            : `/storage/images/no-image.jpg`;

        document.getElementById('viewProductImage').src = photo;
        document.getElementById('viewProductName').textContent = this.dataset.name;
        document.getElementById('viewProductDescription').textContent = this.dataset.description;
        document.getElementById('viewProductPrice').textContent = this.dataset.price;
        document.getElementById('viewProductStock').textContent = this.dataset.stock;

        new bootstrap.Modal(document.getElementById('viewProductModal')).show();
    });
});


document.querySelectorAll('.deleteProductBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;

        confirmTitle.textContent = 'Delete Product Permanently';
        confirmBody.textContent = `Are you sure you want to delete "${name}" permanently?`;

        confirmBtn.className = 'btn btn-danger';
        confirmHeader.className = 'modal-header bg-danger text-white';

        confirmForm.action = `/admin/recycle-product/delete/${id}`;
        confirmForm.method = 'POST';

        if (!confirmForm.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            confirmForm.appendChild(methodInput);
        }

        confirmModal.show();
    });
});

});
</script>

@endsection
