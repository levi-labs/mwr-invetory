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
                    <h4 class="card-title">Daftar Barang Masuk</h4>
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
                        <div class="row justify-content-between">
                            <div class="col-md-8 align-items-center">
                                <a href=" {{ route('barang-masuk.create') }}" class="btn btn-primary">Tambah <i
                                        class="fa-solid fa-plus"></i></a>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('barang-masuk.search') }}"
                                    class="form form-vertical d-flex align-items-center" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center">
                                                    <input type="text" id="first-name-vertical" class="form-control me-2"
                                                        name="search" placeholder="Search">
                                                    <button type="submit" class="btn btn-dark"> <i data-feather="search"
                                                            width="10"></i></button>
                                                </div>
                                                @error('search')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang Masuk</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Supplier</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->barang->kode ?? $item->barang_kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->supplier }}</td>
                                            <td>
                                                <a href="{{ route('barang-masuk.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('barang-masuk.delete', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
    </div>
@endsection
