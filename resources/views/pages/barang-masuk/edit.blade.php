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
                    <h4 class="card-title">Barang Masuk</h4>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form action="{{ route('barang-masuk.update', $barangMasuk->id) }}"
                                    class="form form-vertical" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Barang Masuk</label>
                                                <input type="text" id="first-name-vertical" class="form-control" readonly
                                                    name="kode" value="{{ $barangMasuk->kode }}">
                                                @error('kode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="barang">Barang</label>
                                                <select class="form-select" id="barang" name="barang">
                                                    <option selected disabled>Pilih Barang</option>
                                                    @foreach ($barang as $item)
                                                        <option {{ $item->id == $barangMasuk->barang_id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="supplier">Supplier</label>
                                                <select class="form-select" id="supplier" name="supplier">
                                                    <option selected disabled>Pilih Barang</option>
                                                    @foreach ($supplier as $item)
                                                        <option
                                                            {{ $item->id == $barangMasuk->supplier_id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('supplier')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="stok">Quantity</label>
                                                <input type="number" id="qty" class="form-control" name="qty"
                                                    min="0" placeholder="0" value="{{ $barangMasuk->qty }}">
                                                @error('qty')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ route('barang-masuk.index') }}'">Back</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
