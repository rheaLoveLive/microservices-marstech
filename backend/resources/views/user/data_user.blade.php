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
                        <a class="btn btn-primary btn-xl" href="{{ route('user.create') }}"><i
                                class="fas fa-user-plus"></i></i>
                            Add
                            New</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dtUsser" class="tbData table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtUser as $rsUser)
                                <tr>
                                    
                                    <td>
                                        {{ $rsUser->name }}
                                    </td>
                                    <td>
                                        {{ $rsUser->email }}
                                    </td>
                                    <td>
                                        {{ $rsUser->role }}
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-{{ $rsUser->status == 1 ? 'success' : 'danger' }}">{{ $rsUser->status == 1 ? 'Aktif' : 'Non Aktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Yakin mau menghapus ini ? ')"
                                            action="{{ route('user.destroy', $rsUser->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('user.edit', $rsUser->id) }}"><i
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
