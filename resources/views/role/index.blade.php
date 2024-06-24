@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Role Pengguna</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="role-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            <span class="badge bg-dark">{{ $permission->name }}</span>
                        </td>
                        <td>
                            @foreach ($permission->roles as $role)
                                <span class="badge bg-success">{{ $role->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
