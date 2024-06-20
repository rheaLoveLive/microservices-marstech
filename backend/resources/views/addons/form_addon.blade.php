@extends('layouts.template')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            {{-- Notification --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5 class="text-center"></i>Terjadi Kesalahan , Silahkan Cek Kembali</h5>
                </div>
            @endif
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">{{ $edit ? 'Edit' : 'Add New' }} {{ $title }}</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ $edit ? route('addon.update', $rsAddon->id) : route('addon.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-4 px-4">
                                <div class="card">
                                    <div class="card-body">
                                        @if (@$rsAddon->icon != '')
                                            <img id="foto_icon" src="{{ asset('uploads/icon/' . @$rsAddon->icon) }}"
                                                class="img-fluid" alt="icon">
                                        @else
                                            <img id="foto_icon" src="{{ asset('img/no_apk.jpg') }}" class="img-fluid"
                                                alt="icon">
                                        @endif
                                        <input type="file" name="file_icon" id="file_icon" class="d-none">
                                        <input type="text" name="old_icon" id="old_icon" class="d-none"
                                            value="{{ @$rsAddon->icon }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="card px-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ @old('name') ? @old('name') : @$rsAddon->name }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category"
                                            class="form-control @error('category') is-invalid @enderror"
                                            value="{{ @old('category') ? @old('category') : @$rsAddon->category }}">
                                            <option
                                                {{ @$rsAddon->category == 'free' || @old('category') == 'free' ? 'selected' : '' }}
                                                value="free">Gratis
                                            </option>
                                            <option
                                                {{ @$rsAddon->category == 'paid' || @old('category') == 'paid' ? 'selected' : '' }}
                                                value="paid">Berbayar
                                            </option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ @old('price') ? @old('price') : @$rsAddon->price }}">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror"
                                            value="{{ @old('status') ? @old('status') : @$rsTrans->status }}">
                                            <option {{ @$rsTrans->status == 0 || @old('status') == 0 ? 'selected' : '' }}
                                                value="0">Tidak Terinstall
                                            </option>
                                            <option {{ @$rsTrans->status == 1 || @old('status') == 1 ? 'selected' : '' }}
                                                value="1">Terinstall
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="SAVE" class="btn btn-primary btn-block">
                                </div>
                            </div>
                            <a href="{{ route('addon.store') }}" class="btn btn-secondary">
                                << Back</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
