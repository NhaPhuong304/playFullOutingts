@extends('admin.dashboard')
@section('page-title', 'Profile')

@section('content')
<div class="main-content">
    <div class="row mt-4">

        <!-- Left Column: Avatar + Account Details -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <img id="profilePreview" 
                         src="{{ $user->photo ? asset('storage/avatars/'.$user->photo) : asset('storage/avatars/no-image.jpg') }}" 
                         class="rounded-circle mb-3" 
                         style="width:150px;height:150px;object-fit:cover;">

                    <form id="photoForm" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" id="photoInput" accept="image/*" style="display:none;">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="changePhotoBtn">Change Photo</button>
                    </form>

                    <h5 class="mt-3" id="userName">{{ $user->name }}</h5>
                    <div class="mt-3 text-start">
                        <p><small class="text-muted">Email:</small> <span id="userEmail">{{ $user->email }}</span></p>
                        <p><small class="text-muted">Phone:</small> <span id="userPhone">{{ $user->phone ?? '-' }}</span></p>
                        <p><small class="text-muted">Birthday:</small> {{ $user->birthday ?? '-' }}</p>
                        <p><small class="text-muted">Last Login:</small> {{ $user->last_login ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">

            <!-- Edit Profile -->
            <div class="card mb-4">
                <div class="card-header"><h5>Edit Profile</h5></div>
                <div class="card-body">
                    <form id="profileForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card">
                <div class="card-header"><h5>Change Password</h5></div>
                <div class="card-body">
                    <form id="passwordForm">
                        @csrf
                        <div class="mb-3 position-relative">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="currentPassword" required>
                            <span class="toggle-password" style="position:absolute; right:10px; top:35px; cursor:pointer;">👁️</span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="newPassword" required>
                            <span class="toggle-password" style="position:absolute; right:10px; top:35px; cursor:pointer;">👁️</span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                            <span class="toggle-password" style="position:absolute; right:10px; top:35px; cursor:pointer;">👁️</span>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    // --- Upload avatar ---
    document.getElementById('changePhotoBtn').addEventListener('click', function(){
        document.getElementById('photoInput').click();
    });

    document.getElementById('photoInput').addEventListener('change', function(){
        let formData = new FormData();
        formData.append('photo', this.files[0]);
        formData.append('_token','{{ csrf_token() }}');

        fetch("{{ route('admin.profile.update', $user->id) }}", {method:'POST', body: formData})
        .then(res => res.json())
        .then(data=>{
            if(data.success && data.user.photo){
                document.getElementById('profilePreview').src = '/storage/avatars/'+data.user.photo;
            }
        });
    });

    // --- Profile form submit ---
    document.getElementById('profileForm').addEventListener('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);
        let phone = formData.get('phone');
        let email = formData.get('email');
        let name = formData.get('name');

        // --- Client-side validation ---
        if(!name.trim()){
            alert('Tên không được để trống');
            return;
        }
        if(!/^\S+@\S+\.\S+$/.test(email)){
            alert('Email không hợp lệ');
            return;
        }
        if(phone && !/^\d{10}$/.test(phone)){
            alert('Số điện thoại phải đủ 10 chữ số');
            return;
        }

        fetch("{{ route('admin.profile.update', $user->id) }}", {method:'POST', body: formData})
        .then(res => res.json())
        .then(data=>{
            if(data.success){
                document.getElementById('userName').innerText = data.user.name;
                document.getElementById('userEmail').innerText = data.user.email;
                document.getElementById('userPhone').innerText = data.user.phone ?? '-';
                alert('Profile updated successfully!');
            }
        });
    });

        // Password form submit
        document.getElementById('passwordForm').addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);
            let newPassword = formData.get('newPassword');
            let confirmPassword = formData.get('confirmPassword');

// Thêm field Laravel expected
formData.append('newPassword_confirmation', confirmPassword);


            if(newPassword.length < 6){
                alert('Mật khẩu mới phải ít nhất 6 ký tự');
                return;
            }
            if(newPassword !== confirmPassword){
                alert('Xác nhận mật khẩu không khớp');
                return;
            }

           fetch("{{ route('admin.profile.changePassword', $user->id) }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    alert(data.message);
                    this.reset();
                } else if(data.error){
                    alert(data.error);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Đã có lỗi xảy ra!');
            });

        });

    // --- Toggle password visibility ---
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function(){
        const input = this.previousElementSibling; // input ngay trước icon
        if(input.type === 'password'){
            input.type = 'text';     
            this.textContent = '👁️';
        } else {
            input.type = 'password';
            this.textContent = '🙈';
        }
    });
});



});
</script>
@endsection
