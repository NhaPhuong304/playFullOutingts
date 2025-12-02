@extends('admin.dashboard')
@section('page-title', 'Location')

@section('content')

<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Locations</h5>
        </div>

        <div class="card-body">

            <div class="row g-2 align-items-center mb-4">
                <div class="col-auto">
                    <select class="form-select" name="status" id="searchStatus">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button class="btn btn-success" id="addLocationBtn">
                        Add Location
                    </button>
                </div>

                <div class="col-auto ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search location...">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm" id="locationTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Itinerary</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width:140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->itinerary->name ?? 'N/A' }}</td>
                            <td>{{ Str::limit($location->description, 60) }}</td>
                            <td>
                                @if($location->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-info viewLocationBtn"
                                            data-id="{{ $location->id }}"
                                            title="View">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-success editLocationBtn"
                                            data-id="{{ $location->id }}"
                                            data-itinerary="{{ $location->itinerary_id }}"
                                            data-name="{{ $location->name }}"
                                            data-description="{{ $location->description }}"
                                            data-status="{{ $location->status }}"
                                            title="Edit">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger deleteLocationBtn"
                                            data-id="{{ $location->id }}"
                                            data-name="{{ $location->name }}"
                                            title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>

        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">

            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Location Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-2"><strong>Name:</strong> <span id="viewName"></span></div>
                <div class="mb-2"><strong>Itinerary:</strong> <span id="viewItinerary"></span></div>
                <div class="mb-2"><strong>Description:</strong> <span id="viewDescription"></span></div>
                <div class="mb-2"><strong>Status:</strong> <span id="viewStatus"></span></div>
                <div class="mb-2" id="viewImageContainer"></div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Location</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('admin.locations.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Itinerary</label>
                        <select name="itinerary_id" class="form-control" required>
                            @foreach($itineraries as $it)
                                <option value="{{ $it->id }}">{{ $it->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Name</label>
                        <input name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Location</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editLocationForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Itinerary</label>
                        <select name="itinerary_id" id="editItinerary" class="form-control" required>
                            @foreach($itineraries as $itinerary)
                                <option value="{{ $it->id }}">{{ $itinerary->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Name</label>
                        <input id="editName" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="editDescription" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select id="editStatus" name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-warning">Save Changes</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteLocationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5>Confirm Delete</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Do you really want to delete <strong id="deleteName"></strong>?</p>
            </div>

            <div class="modal-footer">
                <form id="deleteLocationForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
const rowsPerPage = 4;
let currentPage = 1;
let filteredRows = [];

function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const selectedStatus = document.getElementById('searchStatus').value;

    filteredRows = Array.from(document.querySelectorAll("#locationTable tbody tr")).filter(row => {
        const name = row.cells[0].innerText.toLowerCase();
        const statusText = row.cells[3].innerText.trim() === "Active" ? "1" : "0";

        const matchName = name.includes(searchText);
        const matchStatus = selectedStatus === "" || statusText === selectedStatus;

        return matchName && matchStatus;
    });

    currentPage = 1;
    paginate();
}

function paginate() {
    const total = filteredRows.length;
    const pages = Math.ceil(total / rowsPerPage);

    document.querySelectorAll("#locationTable tbody tr").forEach(row => row.style.display = "none");

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    filteredRows.slice(start, end).forEach(row => row.style.display = "");

    renderPagination(pages);
}

function renderPagination(pages) {
    const container = document.getElementById("pagination");
    container.innerHTML = "";

    for (let i = 1; i <= pages; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.className = "btn btn-sm btn-outline-primary mx-1";
        if (i === currentPage) btn.classList.add("active");

        btn.onclick = () => {
            currentPage = i;
            paginate();
        };

        container.appendChild(btn);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    filteredRows = Array.from(document.querySelectorAll("#locationTable tbody tr"));
    paginate();

    document.getElementById("searchInput").addEventListener("input", filterRows);

    initModals();
});

function initModals() {

    document.getElementById("addLocationBtn").addEventListener("click", () => {
        new bootstrap.Modal(document.getElementById("addLocationModal")).show();
    });

    document.querySelectorAll(".viewLocationBtn").forEach(btn => {
        btn.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch(`/admin/locations/${id}`)
                .then(res => res.json())
                .then(data => {

                    document.getElementById("viewName").innerText = data.name;
                    document.getElementById("viewItinerary").innerText = data.itinerary ?? "N/A";
                    document.getElementById("viewDescription").innerText = data.description;
                    document.getElementById("viewStatus").innerText = data.status == 1 ? "Active" : "Inactive";

                    let html = "";
                    if(data.image){
                        html = `<img src="${data.image}" width="200" class="rounded">`;
                    }
                    document.getElementById("viewImageContainer").innerHTML = html;

                    new bootstrap.Modal(document.getElementById("viewLocationModal")).show();
                });
        });
    });

    document.querySelectorAll(".editLocationBtn").forEach(btn => {
        btn.addEventListener("click", function () {

            let id = this.dataset.id;

            document.getElementById("editName").value = this.dataset.name;
            document.getElementById("editDescription").value = this.dataset.description;
            document.getElementById("editStatus").value = this.dataset.status;
            document.getElementById("editItinerary").value = this.dataset.itinerary;

            document.getElementById("editLocationForm").action =
                `/admin/locations/update/${id}`;

            new bootstrap.Modal(document.getElementById("editLocationModal")).show();
        });
    });

    document.querySelectorAll(".deleteLocationBtn").forEach(btn => {
        btn.addEventListener("click", function () {

            let id = this.dataset.id;
            let name = this.dataset.name;

            document.getElementById("deleteName").innerText = name;

            document.getElementById("deleteLocationForm").action =
                `/admin/locations/delete/${id}`;

            new bootstrap.Modal(document.getElementById("deleteLocationModal")).show();
        });
    });

}
</script>

@endsection
