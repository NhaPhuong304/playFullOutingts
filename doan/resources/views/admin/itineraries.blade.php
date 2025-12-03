@extends('admin.dashboard')
@section('page-title', 'Itinerary')

@section('content')
<style>
.game-thumb {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    cursor: pointer;
}
.game-thumb:hover {
    transform: scale(1.1);
    z-index: 10;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}
</style>

<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Itinerary</h5>
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
                <div class="col-auto">
                    <select class="form-select" name="status" id="searchStatus">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>


                <div class="col-auto">
                    <button class="btn btn-success" id="addItineraryBtn">
                        Add Itinerary
                    </button>
                </div>

                <div class="col-auto ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search itinerary...">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm" id="itineraryTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach($itineraries as $itinerary)
                        <tr>
                            <td>{{ $itinerary->name }}</td>
                            <td>{{ Str::limit($itinerary->description, 60) }}</td>
                            <td>{{ $itinerary->days }}</td>
                            <td>
                                <span class="badge {{ $itinerary->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $itinerary->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- VIEW -->
                                    <button class="btn btn-sm btn-outline-info viewItineraryBtn"
                                        data-id="{{ $itinerary->id }}"
                                        data-name="{{ $itinerary->name }}"
                                        data-description="{{ $itinerary->description }}"
                                        data-days="{{ $itinerary->days }}"
                                        data-status="{{ $itinerary->status }}"
                                        data-locations='@json($itinerary->locations)'>

                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <!-- EDIT -->
                                    <button class="btn btn-sm btn-outline-success editItineraryBtn"
                                        data-id="{{ $itinerary->id }}"
                                        data-name="{{ $itinerary->name }}"
                                        data-description="{{ $itinerary->description }}"
                                        data-days="{{ $itinerary->days }}"
                                        data-status="{{ $itinerary->status }}"
                                        data-locations='@json($itinerary->locations)'>
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <!-- DELETE -->
                                    <button class="btn btn-sm btn-outline-danger deleteItineraryBtn"
                                        data-id="{{ $itinerary->id }}"
                                        data-name="{{ $itinerary->name }}">
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

<div class="modal fade" id="viewItineraryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">

            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Itinerary Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-2">
                    <strong>Name:</strong>
                    <span id="viewName"></span>
                </div>

                <div class="mb-2">
                    <strong>Description:</strong>
                    <span id="viewDescription"></span>
                </div>

                <div class="mb-2">
                    <strong>Days:</strong>
                    <span id="viewDays"></span>
                </div>

                <div class="mb-2">
                    <strong>Status:</strong>
                    <span id="viewStatus"></span>
                </div>

                <hr>

                <h6>Locations</h6>
                <div id="viewLocations"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addItineraryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Itinerary</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('admin.itineraries.add') }}">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>
                        <input name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Days</label>
                        <input type="number" name="days" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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

<div class="modal fade" id="editItineraryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Itinerary</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editItineraryForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>
                        <input id="editName" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="editDescription" name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Days</label>
                        <input id="editDays" name="days" type="number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select id="editStatus" name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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

<div class="modal fade" id="deleteItineraryModal" tabindex="-1">
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
                <form id="deleteItineraryForm" method="POST">
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

    filteredRows = Array.from(document.querySelectorAll("#itineraryTable tbody tr")).filter(row => {
        const name = row.cells[0].innerText.toLowerCase();
        const statusText = row.cells[3].innerText.trim() === "Active" ? "1" : "0";

        const matchName = name.includes(searchText);
        const matchStatus = selectedStatus === "" || statusText === selectedStatus;

        return matchName && matchStatus;
    });

    currentPage = 1;
    paginationTable();
}


function paginate() {
    const total = filteredRows.length;
    const pages = Math.ceil(total / rowsPerPage);

    document.querySelectorAll("#itineraryTable tbody tr").forEach(row => row.style.display = "none");

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
    // lấy toàn bộ rows
    filteredRows = Array.from(document.querySelectorAll("#itineraryTable tbody tr"));
    paginate();

    document.getElementById("searchInput").addEventListener("input", filterRows);

    initModals();
});

function initModals() {

    document.getElementById("addItineraryBtn").addEventListener("click", () => {
        new bootstrap.Modal(document.getElementById("addItineraryModal")).show();
    });


document.querySelectorAll(".viewItineraryBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            document.getElementById("viewName").innerText = this.dataset.name;
            document.getElementById("viewDescription").innerText = this.dataset.description;
            document.getElementById("viewDays").innerText = this.dataset.days;
            document.getElementById("viewStatus").innerText = this.dataset.status == 1 ? "Active" : "Inactive";
            const locations = JSON.parse(this.dataset.locations || '[]');
            let html = '';
            locations.forEach(loc => {
                html += `<div class="border rounded p-2 mb-2">
                            <strong>${loc.name}</strong><br>
                            ${loc.description || ''}<br>
                            ${loc.image ? `<img src="/storage/locations/${loc.image}" width="120">` : ''}
                        </div>`;
            });
            document.getElementById("viewLocations").innerHTML = html;


            new bootstrap.Modal(document.getElementById("viewItineraryModal")).show();
        });
    });

    // ADD
    document.getElementById("addItineraryBtn").addEventListener("click", () => {
        new bootstrap.Modal(document.getElementById("addItineraryModal")).show();
    });

    // EDIT
    document.querySelectorAll(".editItineraryBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            document.getElementById("editName").value = this.dataset.name;
            document.getElementById("editDescription").value = this.dataset.description;
            document.getElementById("editDays").value = this.dataset.days;
            document.getElementById("editStatus").value = this.dataset.status;
            document.getElementById("editItineraryForm").action = `/admin/itineraries/update/${id}`;
            new bootstrap.Modal(document.getElementById("editItineraryModal")).show();
        });
    });

    // DELETE
    document.querySelectorAll(".deleteItineraryBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById("deleteName").innerText = name;
            document.getElementById("deleteItineraryForm").action = `/admin/itineraries/delete/${id}`;
            new bootstrap.Modal(document.getElementById("deleteItineraryModal")).show();
        });
    });
}
</script>

@endsection
