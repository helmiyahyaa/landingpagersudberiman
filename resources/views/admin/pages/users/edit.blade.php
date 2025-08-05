@extends('layouts.admin')
@section('judul', 'Users Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit User') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit User: {{ $user->name }}</h6>
        </div>
        <div class="card-body">

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger" role="alert">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="username">Username <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="small text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="level">Level <span class="small text-danger">*</span></label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="Super Admin" {{ old('level', $user->level) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="Admin" {{ old('level', $user->level) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection