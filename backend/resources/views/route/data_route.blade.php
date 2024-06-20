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
                        <a class="btn btn-primary btn-xl" href="{{ route('route.create') }}">
                            <i class="fas fa-user-plus"></i>
                            Add New
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dtUsser" class="tbData table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Route</th>
                                <th>Path</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtPlugin as $rsPlugin)
                                <tr class="text-center">
                                    <td>{{ $rsPlugin->name }}</td>
                                    <td>{{ $rsPlugin->path }}</td>
                                    <td>{{ $rsPlugin->icon }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Yakin mau menghapus ini ? ')"
                                            action="{{ route('route.destroy', $rsPlugin->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('route.edit', $rsPlugin->id) }}"><i
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
