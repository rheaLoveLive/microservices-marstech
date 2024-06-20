@extends('layouts.template')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            {{-- Notification --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5 class="text-center"><i class="fas fa-times-circle"></i>Terjadi Kesalahan , Silahkan Cek Kembali</h5>
                </div>
            @endif
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">{{ $edit ? 'Edit' : 'Add New' }}</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ $edit ? route('user.update', $rsUser->id) : route('user.store') }}" method="post">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ @old('name') ? @old('name') : @$rsUser->name }}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ @old('email') ? @old('email') : @$rsUser->email }}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ @old('password') ? @old('password') : @$rsUser->password }}" />
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="superadmin"
                                    {{ @$rsUser->role == 'superadmin' || old('role') == 'superadmin' ? 'selected' : '' }}>
                                    Super
                                    Admin</option>
                                <option value="admin"
                                    {{ @$rsUser->role == 'admin' || old('role') == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="user"
                                    {{ @$rsUser->role == 'user' || old('role') == 'user' ? 'selected' : '' }}>
                                    User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                                value="{{ @old('status') ? @old('status') : @$rsUser->status }}">
                                <option {{ @$rsUser->status == 1 || @old('status') == 1 ? 'selected' : '' }}
                                    value="1">Aktif
                                </option>
                                <option {{ @$rsUser->status == 2 || @old('status') == 2 ? 'selected' : '' }}
                                    value="2">Non-Aktif
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="SAVE" class="btn btn-primary btn-block">
                        </div>
                        <a href="{{ route('user.store') }}" class="btn btn-secondary">
                            << Back</a>
                    </form>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
