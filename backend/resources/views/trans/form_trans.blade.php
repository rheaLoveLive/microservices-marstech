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
                    <form action="{{ $edit ? route('trans.update', @$rsTrans->id) : route('trans.store') }}" method="post">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card px-3">
                                    <div class="mb-3">
                                        <label for="no_trans" class="form-label">No Trans</label>
                                        <input type="text" name="no_trans" id="no_trans"
                                            class="form-control @error('no_trans') is-invalid @enderror"
                                            value="{{ @old('no_trans') ? @old('no_trans') : @$rsTrans->no_trans }}"
                                            readonly />
                                        @error('no_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_trans" class="form-label">Tanggal</label>
                                        <input type="date" name="tgl_trans" id="tgl_trans"
                                            class="form-control @error('tgl_trans') is-invalid @enderror"
                                            value="{{ @old('tgl_trans') ? @old('tgl_trans') : @$rsTrans->tgl_trans }}" />
                                        @error('tgl_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_addon" class="form-label">ID Addon</label>
                                        <select name="id_addon" id="id_addon"
                                            class="form-control @error('id_addon') is-invalid @enderror"
                                            value="{{ @old('id_addon') ? @old('id_addon') : @$rsTrans->id_addon }}">
                                            <option value="">- addon -</option>
                                            @foreach ($dtAddon as $rsAddon)
                                                <option
                                                    {{ @$rsTrans->id_addon == $rsAddon->id || @old('id_addon') == $rsAddon->id ? 'selected' : '' }}
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
                                        <label for="id_user" class="form-label">ID User</label>
                                        <select name="id_user" id="id_user"
                                            class="form-control @error('id_user') is-invalid @enderror"
                                            value="{{ @old('id_user') ? @old('id_user') : @$rsTrans->id_user }}">
                                            <option value="">- user -</option>
                                            @foreach ($dtUser as $rsUser)
                                                @if ($rsUser->role === 'user')
                                                    <option
                                                        {{ @$rsTrans->id_user == $rsUser->id || @old('id_user') == $rsUser->id ? 'selected' : '' }}
                                                        value="{{ $rsUser->id }}">{{ $rsUser->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="gtotal_trans" class="form-label">Gtotal</label>
                                        <input type="number" name="gtotal_trans" id="gtotal_trans"
                                            class="form-control @error('gtotal_trans') is-invalid @enderror"
                                            value="{{ @old('gtotal_trans') ? @old('gtotal_trans') : @$rsTrans->gtotal_trans }}">
                                        @error('gtotal_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="diskon_trans" class="form-label">Diskon</label>
                                        <input type="number" name="diskon_trans" id="diskon_trans"
                                            class="form-control @error('diskon_trans') is-invalid @enderror"
                                            value="{{ @old('diskon_trans') ? @old('diskon_trans') : @$rsTrans->diskon_trans }}">
                                        @error('diskon_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pay_trans" class="form-label">Pay</label>
                                        <input type="number" name="pay_trans" id="pay_trans"
                                            class="form-control @error('pay_trans') is-invalid @enderror"
                                            value="{{ @old('pay_trans') ? @old('pay_trans') : @$rsTrans->pay_trans }}">
                                        @error('pay_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="number_card_trans" class="form-label">No</label>
                                        <input type="text" name="number_card_trans" id="number_card_trans"
                                            class="form-control @error('number_card_trans') is-invalid @enderror"
                                            value="{{ @old('number_card_trans') ? @old('number_card_trans') : @$rsTrans->number_card_trans }}">
                                        @error('number_card_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="type_payment_trans" class="form-label">Type</label>
                                        <input type="text" name="type_payment_trans" id="type_payment_trans"
                                            class="form-control @error('type_payment_trans') is-invalid @enderror"
                                            value="{{ @old('type_payment_trans') ? @old('type_payment_trans') : @$rsTrans->type_payment_trans }}">
                                        @error('type_payment_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status_trans" class="form-label">Status</label>
                                        <select name="status_trans" id="status_trans"
                                            class="form-control @error('status_trans') is-invalid @enderror"
                                            value="{{ @old('status_trans') ? @old('status_trans') : @$rsTrans->status_trans }}">
                                            <option
                                                {{ @$rsTrans->status_trans == 0 || @old('status_trans') == 0 ? 'selected' : '' }}
                                                value="0">Belum Di bayar
                                            </option>
                                            <option
                                                {{ @$rsTrans->status_trans == 1 || @old('status_trans') == 1 ? 'selected' : '' }}
                                                value="1">Proses
                                            </option>
                                            <option
                                                {{ @$rsTrans->status_trans == 2 || @old('status_trans') == 2 ? 'selected' : '' }}
                                                value="2">Finish
                                            </option>
                                            <option
                                                {{ @$rsTrans->status_trans == 3 || @old('status_trans') == 3 ? 'selected' : '' }}
                                                value="3">Cancel
                                            </option>
                                        </select>
                                        @error('status_trans')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="SAVE" class="btn btn-primary btn-block">
                                    </div>
                                </div>
                                <a href="{{ route('trans.store') }}" class="btn btn-secondary">
                                    << Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
