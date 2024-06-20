@extends('layouts.template')

@section('title', $title)
@section('page-title', $page_title)

@section('content')
    <div class="row">
        {{-- Data --}}
        <div class="col">
            <div class="card card-dark">
                <div class="card-header">
                    <div class="card-tools">
                        <a class="btn btn-primary btn-xl" href="{{ route('trans.create') }}"><i class="fas fa-user-plus"></i>
                            Add New
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dtUsser" class="tbData table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No Trans</th>
                                <th>Tanggal</th>
                                <th>Nama user</th>
                                <th>Nama addon</th>
                                <th>Total</th>
                                <th>No Kartu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtTrans as $rsTrans)
                                <tr>
                                    <td>{{ $rsTrans->no_trans }}</td>
                                    <td>{{ $rsTrans->tgl_trans }}</td>
                                    <td>
                                        {{ $rsTrans->user_name }}
                                    </td>
                                    <td>
                                        {{ $rsTrans->addon_name }}
                                    </td>
                                    <td>Rp {{ number_format($rsTrans->gtotal_trans, 0, ',', '.') }}</td>
                                    <td>{{ $rsTrans->diskon_trans }}</td>
                                    <td>{{ $rsTrans->number_card_trans }}</td>
                                    <td>
                                        @php
                                            $status = ['Belum di Bayar', 'Proses', 'Finish', 'Cancel'];
                                            $color = ['warning', 'primary', 'success', 'danger'];
                                        @endphp
                                        <span
                                            class="badge bg-{{ $color[$rsTrans->status_trans] }}">{{ $status[$rsTrans->status_trans] }}</span>
                                    </td>
                                    <td>
                                        <form onsubmit="return confirm('Yakin mau menghapus ini ? ')"
                                            action="{{ route('trans.destroy', $rsTrans->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('trans.edit', $rsTrans->id) }}"><i
                                                    class="fas fa-user-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    @if (session('notif'))
        @if (session('notif')['type'] == 'success')
            <script>
                swal('{{ session('notif')['text'] }}', "You clicked the button!", "success");
            </script>
        @else
            <script>
                swal('{{ session('notif')['text'] }}', "You clicked the button!", "error");
            </script>
        @endif
    @endif
@endsection
