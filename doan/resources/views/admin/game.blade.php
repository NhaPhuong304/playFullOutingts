@extends('admin.dashboard')
@section('page-title', 'Game')

@section('content')

<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Games</h5>
        </div>
        <div class="card-body">
            <div class="row g-2 align-items-center mb-4">
                <!-- Dropdown Role -->
                <div class="col-auto">
                    <select class="form-select" name="status" id="searchStatus">
                        <option value="">All</option>
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button class="btn btn-success" id="addGameBtn">
                        Add
                    </button>
                </div>

                <div class="col-auto ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="gameTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Duration</th>
                            <th>Instructions</th>
                            <th>Video</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                        <tr>
                            <td>
                                @if($game->image)
                                <img src="{{ asset('storage/games/images/'.$game->image) }}?t={{ $game->updated_at->timestamp }}" width="50" height="50" class="rounded">
                                @else
                                <img src="{{ asset('storage/games/no-image.jpg') }}" width="50" height="50" class="rounded">
                                @endif
                            </td>
                            <td>{{ $game->name }}</td>
                            <td>{{ $game->slug }}</td>
                            <td>{{ $game->duration }} min</td>
                            <td>{{ Str::limit($game->instructions, 50) }}</td>
                            <td>
                                @if($game->video_url)
                                <a href="{{ asset('storage/games/videos/'.$game->video_url) }}" target="_blank">View Video</a>
                                @endif
                            </td>
                            <td>
                                @if($game->download_file)
                                <a href="{{ asset('storage/games/files/'.$game->download_file) }}" download>Download</a>
                                @endif
                            </td>
                            <td>
                                @if($game->status)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-info viewGameBtn"
                                        data-id="{{ $game->id }}"
                                        data-name="{{ $game->name }}"
                                        data-slug="{{ $game->slug }}"
                                        data-duration="{{ $game->duration }}"
                                        data-instructions="{{ $game->instructions }}"
                                        data-image="{{ $game->image ? asset('storage/games/images/'.$game->image) : asset('storage/games/images/no-image.jpg') }}"
                                        data-video="{{ $game->video_url ? asset('storage/games/videos/'.$game->video_url) : '' }}"
                                        data-file="{{ $game->download_file }}"
                                        data-status="{{ $game->status }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger deleteGameBtn"
                                        data-id="{{ $game->id }}"
                                        data-name="{{ $game->name }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success editGameBtn"
                                        data-id="{{ $game->id }}"
                                        data-name="{{ $game->name }}"
                                        data-slug="{{ $game->slug }}"
                                        data-duration="{{ $game->duration }}"
                                        data-instructions="{{ $game->instructions }}"
                                        data-image="{{ $game->image ? asset('storage/games/images/'.$game->image) : asset('storage/games/images/no-image.jpg') }}"
                                        data-video="{{ $game->video_url ? asset('storage/games/videos/'.$game->video_url) : '' }}"
                                        data-file="{{ $game->download_file }}"
                                        data-status="{{ $game->status }}">
                                        <i class="fa-solid fa-pencil"></i>
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
<!-- View Game Modal -->
<div class="modal fade" id="viewGameModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Game Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4 text-center mb-3">
                    <!-- Image -->
                    <img id="viewGameImage" class="rounded" style="width:150px;height:150px;object-fit:cover;">
                </div>
                <div class="col-md-8">
                    <p><strong>ID:</strong> <span id="viewGameId"></span></p>
                    <p><strong>Name:</strong> <span id="viewGameName"></span></p>
                    <p><strong>Slug:</strong> <span id="viewGameSlug"></span></p>
                    <p><strong>Duration:</strong> <span id="viewGameDuration"></span> min</p>
                    <p><strong>Instructions:</strong> <span id="viewGameInstructions"></span></p>

                    <!-- Video -->
                    <div id="viewGameVideoContainer" class="mb-2" style="display:none;">
                        <strong>Video:</strong><br>
                        <video id="viewGameVideo" width="100%" controls></video>
                    </div>

                    <!-- File -->
                    <div id="viewGameFileContainer" class="mb-2" style="display:none;">
                        <strong>File:</strong><br>
                        <iframe id="viewGameFile" width="100%" height="300px" style="border:1px solid #ccc;"></iframe>
                    </div>

                    <p><strong>Status:</strong> <span id="viewGameStatus"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addGameModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Game</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.game.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-4 text-center">
                        <!-- Image Preview -->
                        <img id="addGameImagePreview" class="rounded mb-2" style="width:150px;height:150px;" src="{{ asset('storage/games/no-image.jpg') }}">
                        <input type="file" class="form-control mb-2" name="image" id="addGameImageInput">

                        <!-- Video Preview -->
                        <video id="addGameVideoPreview" class="mb-2" width="200" controls style="display:none;"></video>
                       <input type="file" class="form-control mb-2" name="video_url" id="addGameVideoInput" accept="video/*">

                        <!-- File Upload -->
                        <input type="file" class="form-control mb-2" name="download_file" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="col-md-8">
                        <div class="mb-2">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-2">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" required>
                        </div>
                        <div class="mb-2">
                            <label>Duration (min)</label>
                            <input type="number" class="form-control" name="duration">
                        </div>
                        <div class="mb-2">
                            <label>Instructions</label>
                            <textarea class="form-control" name="instructions" rows="3"></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Game</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editGameModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Game</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGameForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body row">
                    <div class="col-md-4 text-center">
                        <img id="editGameImagePreview" class="rounded mb-2" style="width:150px;height:150px;">
                        <input type="file" class="form-control mb-2" name="image" id="editGameImageInput">
                        <input type="file" class="form-control mb-2" name="video_url" accept="video/*">
                        <input type="file" class="form-control mb-2" name="download_file" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="col-md-8">
                        <div class="mb-2">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="editGameName">
                        </div>
                        <div class="mb-2">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" id="editGameSlug">
                        </div>
                        <div class="mb-2">
                            <label>Duration (min)</label>
                            <input type="number" class="form-control" name="duration" id="editGameDuration">
                        </div>
                        <div class="mb-2">
                            <label>Instructions</label>
                            <textarea class="form-control" name="instructions" rows="3" id="editGameInstructions"></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Status</label>
                            <select class="form-control" name="status" id="editGameStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
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

<div class="modal fade" id="deleteGameModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete <strong id="deleteGameName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteGameForm" method="POST">
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

const rowsPerPage = 4;
let currentPage = 1;
let filteredRows = [];

function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const selectedStatus = document.getElementById('searchStatus').value;

    filteredRows = Array.from(document.querySelectorAll("#gameTable tbody tr")).filter(row => {
        const name = row.cells[1].innerText.toLowerCase();
        const statusText = row.cells[8].innerText.toLowerCase(); // Active / Inactive
        const status = statusText === 'active' ? '1' : '0';

        const matchName = name.includes(searchText);
        const matchStatus = selectedStatus === "" || status === selectedStatus;

        return matchName && matchStatus;
    });

    currentPage = 1;
    paginationTable();
}

function paginationTable() {
    const totalRows = filteredRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    document.querySelectorAll("#gameTable tbody tr").forEach(row => row.style.display = "none");

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
            paginationTable();
        };

        pagination.appendChild(btn);
    }
}

function initGameModals() {
    // Add Game Image Preview
    const addImageInput = document.getElementById('addGameImageInput');
    const addImagePreview = document.getElementById('addGameImagePreview');
    addImageInput.addEventListener('change', e => {
        const reader = new FileReader();
        reader.onload = e => addImagePreview.src = e.target.result;
        reader.readAsDataURL(e.target.files[0]);
    });

    // Add Game Modal
    document.getElementById('addGameBtn').addEventListener('click', () => {
        new bootstrap.Modal(document.getElementById('addGameModal')).show();
    });

    // View Game Modal
    document.querySelectorAll('.viewGameBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('viewGameId').textContent = this.dataset.id;
            document.getElementById('viewGameName').textContent = this.dataset.name;
            document.getElementById('viewGameSlug').textContent = this.dataset.slug;
            document.getElementById('viewGameDuration').textContent = this.dataset.duration;
            document.getElementById('viewGameInstructions').textContent = this.dataset.instructions;
            document.getElementById('viewGameStatus').textContent = this.dataset.status === '1' ? 'Active' : 'Inactive';
            document.getElementById('viewGameImage').src = this.dataset.image;

            // Video
            const videoContainer = document.getElementById('viewGameVideoContainer');
            const video = document.getElementById('viewGameVideo');
            if(this.dataset.video){
                video.innerHTML = `<source src="${this.dataset.video}" type="video/mp4">`;
                video.load();
                videoContainer.style.display = 'block';
            } else {
                video.innerHTML = '';
                videoContainer.style.display = 'none';
            }

            // File
            const fileContainer = document.getElementById('viewGameFileContainer');
            const file = document.getElementById('viewGameFile');
            if(this.dataset.file){
                const fileUrl = this.dataset.file.startsWith('http') ? this.dataset.file : `/storage/games/files/${this.dataset.file}`;
                const ext = this.dataset.file.split('.').pop().toLowerCase();
                if(ext === 'pdf'){
                    file.src = fileUrl;
                    fileContainer.style.display = 'block';
                    fileContainer.innerHTML = '<strong>File:</strong><br>';
                    fileContainer.appendChild(file);
                } else {
                    fileContainer.innerHTML = `<strong>File:</strong> <a href="${fileUrl}" target="_blank">Open File</a>`;
                    file.src = '';
                    fileContainer.style.display = 'block';
                }
            } else {
                file.src = '';
                fileContainer.style.display = 'none';
            }

            new bootstrap.Modal(document.getElementById('viewGameModal')).show();
        });
    });

    // Edit Game Modal
    document.querySelectorAll('.editGameBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('editGameForm').action = `/admin/game/${this.dataset.id}`;
            document.getElementById('editGameName').value = this.dataset.name;
            document.getElementById('editGameSlug').value = this.dataset.slug;
            document.getElementById('editGameDuration').value = this.dataset.duration;
            document.getElementById('editGameInstructions').value = this.dataset.instructions;
            document.getElementById('editGameStatus').value = this.dataset.status;
            document.getElementById('editGameImagePreview').src = this.dataset.image;
            new bootstrap.Modal(document.getElementById('editGameModal')).show();
        });
    });

    // Delete Game Modal
    document.querySelectorAll('.deleteGameBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('deleteGameName').textContent = this.dataset.name;
            document.getElementById('deleteGameForm').action = `/admin/game/${this.dataset.id}`;
            new bootstrap.Modal(document.getElementById('deleteGameModal')).show();
        });
    });
}

// Khi DOM load xong
document.addEventListener("DOMContentLoaded", () => {
    filteredRows = Array.from(document.querySelectorAll("#gameTable tbody tr"));
    paginationTable();

    document.getElementById('searchInput').addEventListener('input', filterRows);
    document.getElementById('searchStatus').addEventListener('change', filterRows);

    initGameModals();
});
</script>


@endsection
