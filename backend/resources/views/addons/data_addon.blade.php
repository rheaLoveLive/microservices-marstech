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
                        <a class="btn btn-primary btn-xl" href="{{ route('addon.create') }}">
                            <i class="fas fa-user-plus"></i> Add New
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dtUsser" class="tbData table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Icon</th>
                                <th>Nama</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtAddon as $rsAddon)
                                <tr>
                                    <td class="text-center">
                                        @if (@$rsAddon->icon != '')
                                            <img id="foto_icon" src="{{ asset('uploads/icon/' . @$rsAddon->icon) }}"
                                                alt="{{ @$rsAddon->name }}" class="thumbnail-small">
                                        @else
                                            <img id="foto_icon" src="{{ asset('img/no_apk.jpg') }}"
                                                alt="{{ @$rsAddon->name }}" class="thumbnail-small">
                                        @endif
                                    </td>
                                    <td>{{ $rsAddon->name }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $rsAddon->category == 'free' ? 'success' : 'primary' }}">
                                            {{ $rsAddon->category == 'free' ? 'Gratis' : 'Berbayar' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        Rp {{ number_format($rsAddon->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Yakin mau menghapus ini ? ')"
                                            action="{{ route('addon.destroy', $rsAddon->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('addon.edit', $rsAddon->id) }}"><i
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


{{-- @extends('layouts.template')

@section('title', $title)
@section('page-title', $page_title)

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-dark">
            <div class="card-header">
                {{ $errors->any() }}
                <div class="card-tools">
                    <a href="{{ route('addon.create') }}" class="btn btn-primary btn-xl"><i class="fas fa-plus"></i>
                        &nbsp;ADD NEW</a>
                </div>
            </div>
            <div class="card-body">
                <table id="dtUser" class="tbData table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Icon</th>
                            <th>Nama</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtAddon as $rsAddon)
                            <tr>
                                <td class="text-center">
                                    @if (@$rsAddon->foto_icon != '')
                                        <img id="foto_icon" src="{{ asset('uploads/icon/' . @$rsAddon->foto_icon) }}"
                                            alt="{{ @$rsAddon->name }}" class="thumbnail-small">
                                    @else
                                        <img id="foto_icon" src="{{ asset('img/no-menu-iamge.png') }}" alt="{{ @$rsAddon->name }}"
                                            class="thumbnail-small">
                                    @endif
                                </td>
                                <td>{{ $rsAddon->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $rsAddon->category == 'free' ? 'success' : 'primary' }}">
                                        {{ $rsAddon->category == 'free' ? 'Gratis' : 'Berbayar' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ number_format($rsAddon->rating, 0,  '.') }}
                                </td>
                                <td class="text-center">
                                    Rp {{ number_format($rsAddon->price, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $rsAddon->stok == 'in_stock' ? 'success' : 'danger' }}">
                                        {{ $rsAddon->stok == 'in_stock' ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($rsAddon->payment_method == 'cash')
                                        <span class="badge bg-success">Cash</span>
                                    @elseif ($rsAddon->payment_method == 'credit_card')
                                        <span class="badge bg-primary">Credit Card</span>
                                    @else
                                        <span class="badge bg-danger">Bank Transfer</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    <form onsubmit="return confirm('Yakin mau menghapus ini ? ')"
                                        action="{{ route('user.destroy', $rsAddon->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('user.edit', $rsAddon->id) }}"><i
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
 --}}
