@extends('layouts.main')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
            </div>
        </div>
    </div>
    <div class="row mt-4" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar User</h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <a href=" {{ route('users.create') }}" class="btn btn-primary">Tambah <i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-bold-500">{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <a href="{{ route('users.reset-password', $item->id) }}"
                                                class="btn btn-dark">Reset Password</a>
                                            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('users.delete', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
    </div>
@endsection
