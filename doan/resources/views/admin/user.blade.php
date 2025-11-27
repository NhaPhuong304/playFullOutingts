@extends('admin.dashboard')
@section('page-title', 'User')

@section('content')

<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">User</h5>
        </div>
        <div class="card-body">
            <div class="row g-2 align-items-center mb-4">
                <!-- Dropdown Role -->
                <div class="col-auto">
                    <select class="form-select" name="role" id="searchRole">
                        <option value="">All</option>
                        <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>User</option>
                        <option value="2" {{ request('role') == 2 ? 'selected' : '' }}>Admin</option>
                        <option value="3" {{ request('role') == 3 ? 'selected' : '' }}>SupperAdmin</option>
                    </select>
                </div>

                <div class="col-auto">
                    @if(Auth::user()->role_id == 3)
                        <button class="btn btn-success" id="addUserBtn">
                            Add
                        </button>
                    @endif
                </div>

                <div class="col-auto ms-auto">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search">
                        <span class="fa fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></span>
                    </div>
                </div>
            </div>

                
            <div class="table-responsive" >
                <table class="table table-hover table-sm" id="userTable">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Fullname</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->photo)
                                <img src="{{asset('storage/avatars/'.$user->photo)}}?t={{$user->updated_at->timestamp}}" class="rounded-circle me-2"  width="40" height="40">
                                @else
                                <img src="{{asset('storage/avatars/no-image.jpg')}}" class="rounded-circle me-2"  width="40" height="40">
                                @endif
                            </td>
                            <td>                        
                                <div>{{$user -> name}}</div>
                            </td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->birthday}}</td>
                            <td>{{$user -> gender}}</td>
                            <td>{{$user -> email }}</td>
                            <td>
                                @if($user->role_id == 1)
                                    User
                                @elseif($user->role_id == 2)
                                    Admin
                                @else
                                    SupperAdmin
                                @endif
                            </td>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info viewUserBtn" data-bs-toggle="tooltip" title="View"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-fullname="{{ $user->fullname }}"
                                            data-birthday="{{ $user->birthday }}"
                                            data-gender="{{ $user->gender }}"
                                            data-email="{{ $user->email }}"
                                            data-photo="{{ $user->photo ? asset('storage/avatars/'.$user->photo) : asset('storage/avatars/no-image.jpg') }}"
                                            data-status="{{ $user->status }}"
                                            data-role_id="{{ $user->role_id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <button  class="btn btn-sm btn-outline-success editUserBtn" data-bs-toggle="tooltip" title="Edit"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-fullname="{{ $user->fullname }}"
                                            data-birthday="{{ $user->birthday }}"
                                            data-gender="{{ $user->gender }}"
                                            data-email="{{ $user->email }}"
                                            data-photo="{{ $user->photo ? asset('storage/avatars/'.$user->photo) : asset('storage/avatars/no-image.jpg') }}"
                                            data-status="{{ $user->status }}"
                                            data-role_id="{{ $user->role_id }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                        @if(Auth::user()->id != $user->id)
                                            <button class="btn btn-sm btn-outline-danger blockUserBtn" data-bs-toggle="tooltip" title="Block"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-status="{{ $user->status }}">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        @endif
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

            <!-- View -->
            <div class="modal fade" id="viewUserModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header bg-primary text-white rounded-top-4">
                        <h5 class="modal-title">
                            <i class="bi bi-person-lines-fill"></i> User Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <!-- Avatar -->
                            <div class="col-md-4 text-center">
                                <img id="viewPhoto" class="rounded-circle border shadow-sm"
                                        style="width:150px; height:150px; object-fit:cover;">
                            </div>

                            <!-- Information -->
                            <div class="col-md-8">

                                <div class="mb-2">
                                    <strong>ID:</strong>
                                    <span id="viewId"></span>
                                </div>

                                <div class="mb-2">
                                    <strong>Name:</strong>
                                    <span id="viewName"></span>
                                </div>

                                <div class="mb-2">
                                    <strong>Fullname:</strong>
                                    <span id="viewFullname"></span>
                                </div>

                                <div class="mb-2">
                                    <strong>Birthday:</strong>
                                    <span id="viewBirthday"></span>
                                </div>

                                <div class="mb-2">
                                    <strong>Gender:</strong>
                                    <span id="viewGender"></span>
                                </div>

                                <div class="mb-2">
                                    <strong>Email:</strong>
                                    <span id="viewEmail"></span>
                                </div>
                                <div class="mb-2">
                                    <strong>Status:</strong>
                                    <span id="viewStatus"></span>
                                </div>
                                <div class="mb-2">
                                    <strong>Role:</strong>
                                    <span id="viewRole"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Block -->
            <div class="modal fade" id="blockUserModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirm Block</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p>Are you sure you want to <strong id="blockUserAction"></strong> <strong id="blockUserName"></strong>?</p>
                        </div>

                        <div class="modal-footer">
                            <form id="blockUserForm" method="POST" action="">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

<!-- Add -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add User / Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addUserForm" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-4 text-center">
                        <img id="addPhotoPreview" class="rounded-circle mb-2" style="width:150px;height:150px;" src="{{ asset('storage/avatars/no-image.jpg') }}">
                        <input type="file" class="form-control" name="photo" id="addPhotoInput">
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Fullname</label>
                            <input type="text" class="form-control" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label>Birthday</label>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select class="form-control" name="role_id">
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
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
                    <button type="submit" class="btn btn-success">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Edit -->
        <div class="modal fade" id="editUserModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row">
                        <div class="col-md-4 text-center">
                            <img id="editPhotoPreview" class="rounded-circle mb-2" style="width:150px;height:150px;">
                            <input type="file" class="form-control" name="photo" id="editPhotoInput">
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label>Fullname</label>
                                <input type="text" class="form-control" name="fullname" id="editFullname">
                            </div>
                            <div class="mb-3">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" id="editBirthday">
                            </div>
                            <div class="mb-3">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="editGender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" id="editEmail" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status" id="editStatus">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Role</label>
                                <select class="form-control" name="role_id" id="editRole">
                                    <option value="2">Admin</option>
                                    <option value="1">User</option>
                                    <option value="3">SupperAdmin</option>
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
        </div>
    </div>
<script>
const rowsPerPage = 4;
let currentPage = 1;
let filteredRows = [];

function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const selectedRole = document.getElementById('searchRole').value.toLowerCase();

    filteredRows = Array.from(document.querySelectorAll("#userTable tbody tr")).filter(row => {
        const name = row.cells[1].innerText.toLowerCase();
        const role = row.cells[3].innerText;

        const matchName = name.includes(searchText);
        const matchRole = selectedRole === "" || role === selectedRole;

        return matchName && matchRole;
    });

    currentPage = 1;
    paginationTable();
}

function paginationTable() {
    const totalRows = filteredRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    document.querySelectorAll("#userTable tbody tr").forEach(row => row.style.display = "none");

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

document.addEventListener("DOMContentLoaded", () => {
    // Lấy tất cả hàng
    filteredRows = Array.from(document.querySelectorAll("#userTable tbody tr"));
    paginationTable();

    // Thêm event listener cho tìm kiếm
    document.getElementById('searchInput').addEventListener('input', filterRows);
    document.getElementById('searchRole').addEventListener('change', filterRows);

    // Tooltip
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // View, Edit, Delete modal
    initUserModals();
});

function initUserModals() {
    // view
    document.querySelectorAll(".viewUserBtn").forEach(btn => {
    btn.addEventListener("click", function () {
        const photo = this.dataset.photo;
        const status = this.dataset.status == 1 ? 'Active' : 'Inactive';
        let roleName = 'Unknown';
        if(this.dataset.role_id == 1) roleName = 'User';
        else if(this.dataset.role_id == 2) roleName = 'Admin';
        else if(this.dataset.role_id == 3) roleName = 'SupperAdmin';

        document.getElementById("viewId").textContent = this.dataset.id;
        document.getElementById("viewName").textContent = this.dataset.name;
        document.getElementById("viewFullname").textContent = this.dataset.fullname;
        document.getElementById("viewBirthday").textContent = this.dataset.birthday || '-';
        document.getElementById("viewGender").textContent = this.dataset.gender;
        document.getElementById("viewEmail").textContent = this.dataset.email;
        document.getElementById("viewStatus").textContent = status;
        document.getElementById("viewRole").textContent = this.dataset.role_id;
        document.getElementById("viewPhoto").src = photo;

        new bootstrap.Modal(document.getElementById("viewUserModal")).show();
    });
});


        // Block user
        document.querySelectorAll(".blockUserBtn").forEach(btn => {
            btn.addEventListener("click", function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const status = this.dataset.status;

                document.getElementById("blockUserName").textContent = name;
                document.getElementById("blockUserAction").textContent = status == 1 ? 'block' : 'unblock';
                document.getElementById("blockUserForm").action = `/admin/user/${id}/block`;

                new bootstrap.Modal(document.getElementById("blockUserModal")).show();
            });
        });


    // edit
    document.querySelectorAll(".editUserBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const fullname = this.dataset.fullname;
            const birthday = this.dataset.birthday;
            const gender = this.dataset.gender;
            const email = this.dataset.email;
            const status = this.dataset.status;
            const role_id = this.dataset.role_id;
            const photo = this.dataset.photo;

            document.getElementById("editName").value = name;
            document.getElementById("editFullname").value = this.dataset.fullname;
            document.getElementById("editBirthday").value = this.dataset.birthday;
            document.getElementById("editGender").value = this.dataset.gender;
            document.getElementById("editEmail").value = email;
            document.getElementById("editStatus").value = status;
            document.getElementById("editRole").value = role_id;
            document.getElementById("editPhotoPreview").src = photo;

            document.getElementById("editUserForm").action = `/admin/user/${id}`;

            new bootstrap.Modal(document.getElementById("editUserModal")).show();
        });
    });

    // preview ảnh
    document.getElementById("editPhotoInput").addEventListener("change", function(e){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById("editPhotoPreview").src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const addUserBtn = document.getElementById("addUserBtn");
    const addUserModalEl = document.getElementById("addUserModal");
    const addPhotoInput = document.getElementById("addPhotoInput");
    const addPhotoPreview = document.getElementById("addPhotoPreview");

    // Khi click nút Add User, mở modal
    addUserBtn.addEventListener("click", () => {
        const addModal = new bootstrap.Modal(addUserModalEl);
        addModal.show();
    });

    // Preview ảnh khi chọn file
    addPhotoInput.addEventListener("change", function(e){
        const reader = new FileReader();
        reader.onload = function(e){
            addPhotoPreview.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    });
});

</script>
@endsection