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
                    <form action="{{ $edit ? route('route.update', @$rsPlugin->id) : route('route.store') }}"
                        method="post">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card px-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ @old('name') ? @old('name') : @$rsPlugin->name }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_addon" class="form-label">ID Addon</label>
                                        <select name="id_addon" id="id_addon"
                                            class="form-control @error('id_addon') is-invalid @enderror"
                                            value="{{ @old('id_addon') ? @old('id_addon') : @$rsPlugin->id_addon }}">
                                            <option value=""> - addon - </option>
                                            @foreach ($dtAddon as $rsAddon)
                                                <option {{ @$rsPlugin->id_addon || @old('id_addon') ? 'selected' : '' }}
                                                    value="{{ $rsAddon->id }}">{{ $rsAddon->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_addon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="path" class="form-label">Path</label>
                                        <input type="string" name="path" id="path"
                                            class="form-control @error('path') is-invalid @enderror"
                                            value="{{ @old('path') ? @old('path') : @$rsPlugin->path }}">
                                        @error('path')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="component" class="form-label">Komponen</label>
                                        <input type="string" name="component" id="component"
                                            class="form-control @error('component') is-invalid @enderror"
                                            value="{{ @old('component') ? @old('component') : @$rsPlugin->component }}">
                                        @error('component')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <input type="string" name="icon" id="icon"
                                            class="form-control @error('icon') is-invalid @enderror"
                                            value="{{ @old('icon') ? @old('icon') : @$rsPlugin->icon }}">
                                        @error('icon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="SAVE" class="btn btn-primary btn-block">
                                    </div>
                                </div>
                                <a href="{{ route('route.store') }}" class="btn btn-secondary">
                                    << Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
