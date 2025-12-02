@extends('admin.dashboard')
@section('page-title', 'Materials')

@section('content')
<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Materials</h5>
        </div>
        <div class="card-body">
            <div class="row g-2 align-items-center mb-4">
                <div class="col-auto">
                    <button class="btn btn-success" id="addMaterialBtn">Add</button>
                </div>
                <div class="col-auto ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="materialTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                        <tr>
                            <td>
                                @if($material->image)
                                    <img src="{{ asset('storage/'.$material->image) }}" width="50" height="50" class="rounded">
                                @else
                                    <img src="{{ asset('storage/materials/no-image.jpg') }}" width="50" height="50" class="rounded">
                                @endif
                            </td>
                            <td>{{ $material->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-success editMaterialBtn"
                                        data-id="{{ $material->id }}"
                                        data-name="{{ $material->name }}"
                                        data-image="{{ $material->image }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger deleteMaterialBtn"
                                        data-id="{{ $material->id }}"
                                        data-name="{{ $material->name }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add Material Modal -->
<div class="modal fade" id="addMaterialModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Material</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.material.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" id="addMaterialImageInput">
                        <img id="addMaterialImagePreview" src="{{ asset('storage/materials/no-image.jpg') }}" width="100" height="100" class="mt-2 rounded">
                    </div>
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Material</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Material Modal -->
<div class="modal fade" id="editMaterialModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Material</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMaterialForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editMaterialId" name="id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Image</label>
                        <input type="file" class="form-control" id="editMaterialImageInput" name="image">
                        <img id="editMaterialImagePreview" src="{{ asset('storage/materials/no-image.jpg') }}" width="100" height="100" class="mt-2 rounded">
                    </div>
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" id="editMaterialName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Material Modal -->
<div class="modal fade" id="deleteMaterialModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete <strong id="deleteMaterialName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteMaterialForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const rowsPerPage = 6;
let currentPage = 1;
let filteredRows = [];

// Search & Pagination
function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    filteredRows = Array.from(document.querySelectorAll("#materialTable tbody tr")).filter(row => {
        const name = row.cells[1].innerText.toLowerCase();
        return name.includes(searchText);
    });
    currentPage = 1;
    paginationTable();
}

function paginationTable() {
    const totalRows = filteredRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    document.querySelectorAll("#materialTable tbody tr").forEach(r => r.style.display = "none");
    filteredRows.slice((currentPage-1)*rowsPerPage, currentPage*rowsPerPage).forEach(r => r.style.display = "");
    renderPagination(totalPages);
}

function renderPagination(totalPages) {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";
    for (let i=1;i<=totalPages;i++){
        const btn = document.createElement("button");
        btn.textContent=i;
        btn.className="btn btn-sm btn-outline-primary mx-1";
        if(i===currentPage) btn.classList.add("active");
        btn.onclick=()=>{currentPage=i;paginationTable();};
        pagination.appendChild(btn);
    }
}

// Modals
function initMaterialModals() {
    // Add
    document.getElementById('addMaterialBtn').addEventListener('click', () => {
        new bootstrap.Modal(document.getElementById('addMaterialModal')).show();
    });

    // Image preview
    document.getElementById('addMaterialImageInput').addEventListener('change', function(e){
        if(e.target.files && e.target.files[0]){
            const reader = new FileReader();
            reader.onload = e => document.getElementById('addMaterialImagePreview').src = e.target.result;
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    document.getElementById('editMaterialImageInput').addEventListener('change', function(e){
        if(e.target.files && e.target.files[0]){
            const reader = new FileReader();
            reader.onload = e => document.getElementById('editMaterialImagePreview').src = e.target.result;
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Edit
    document.querySelectorAll('.editMaterialBtn').forEach(btn => btn.addEventListener('click', function(){
        document.getElementById('editMaterialId').value = this.dataset.id;
        document.getElementById('editMaterialName').value = this.dataset.name;
        document.getElementById('editMaterialImagePreview').src = this.dataset.image ? `/storage/${this.dataset.image}` : "{{ asset('storage/materials/no-image.jpg') }}";
        document.getElementById('editMaterialForm').action = `/admin/material/${this.dataset.id}`;
        new bootstrap.Modal(document.getElementById('editMaterialModal')).show();
    }));

    // Delete
    document.querySelectorAll('.deleteMaterialBtn').forEach(btn => btn.addEventListener('click', function(){
        document.getElementById('deleteMaterialName').textContent = this.dataset.name;
        document.getElementById('deleteMaterialForm').action = `/admin/material/${this.dataset.id}`;
        new bootstrap.Modal(document.getElementById('deleteMaterialModal')).show();
    }));
}

document.addEventListener('DOMContentLoaded', ()=>{
    filteredRows = Array.from(document.querySelectorAll("#materialTable tbody tr"));
    paginationTable();
    document.getElementById('searchInput').addEventListener('input', filterRows);
    initMaterialModals();
});
</script>
@endsection
