@extends('layouts.main')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>

            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $barang->kode }}</h4>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="{{ $barang->getImage() }}" class="card-img-top img-fluid"
                                            alt="singleminded">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $barang->nama }}</h5>
                                            <p class="card-text">
                                                {{ $barang->deskripsi }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">

                                                <tbody>
                                                    <tr>
                                                        <td>Kode :</td>
                                                        <td>{{ $barang->kode }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama :</td>
                                                        <td>{{ $barang->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stok :</td>
                                                        <td>{{ $barang->stok }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Satuan :</td>
                                                        <td>{{ $barang->satuan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga :</td>
                                                        <td>{{ $barang->harga }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ukuran :</td>
                                                        <td>{{ $barang->ukuran }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Warna :</td>
                                                        <td>{{ $barang->warna }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kategori :</td>
                                                        <td>{{ $barang->kategori->nama }}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
