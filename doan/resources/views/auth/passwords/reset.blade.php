@extends('layouts.user')

@section('content')
    <h2 class="text-xl font-bold mb-4">Đặt mật khẩu mới</h2>

    @if($errors->any())
        <div class="text-red-600 mb-2">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.reset.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium" for="password">Mật khẩu mới</label>
            <input id="password" name="password" type="password" required class="mt-1 block w-full rounded-lg border px-3 py-2" />
        </div>
        <div>
            <label class="block text-sm font-medium" for="password_confirmation">Xác nhận mật khẩu</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded-lg border px-3 py-2" />
        </div>
        <div>
            <button class="bg-primary text-white px-4 py-2 rounded">Đổi mật khẩu</button>
        </div>
    </form>
@endsection
