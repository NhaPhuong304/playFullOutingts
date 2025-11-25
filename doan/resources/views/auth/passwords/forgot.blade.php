@extends('layouts.user')

@section('content')
    <h2 class="text-xl font-bold mb-4">Quên mật khẩu</h2>

    @if($errors->any())
        <div class="text-red-600 mb-2">{{ $errors->first() }}</div>
    @endif
    @if(session('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.forgot.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium" for="email">Email đã đăng ký</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}" class="mt-1 block w-full rounded-lg border px-3 py-2" />
        </div>
        <div>
            <button class="bg-primary text-white px-4 py-2 rounded">Gửi mã</button>
        </div>
    </form>
@endsection
