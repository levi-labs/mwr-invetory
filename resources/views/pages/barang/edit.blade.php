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
                    <h4 class="card-title">Kategori</h4>
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
                                <form action="{{ route('barang.update', $barang->id) }}" class="form form-vertical"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Kategori</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="kode" value="{{ $barang->kode }}">
                                                @error('kode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="nama" value="{{ $barang->nama }}">
                                                @error('nama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-select" id="kategori" name="kategori">
                                                    <option selected disabled>Pilih Kategori</option>
                                                    @foreach ($kategori as $item)
                                                        <option {{ $item->id == $barang->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kategori')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" id="stok" class="form-control" name="stok"
                                                    min="0" placeholder="0" value="{{ $barang->stok }}">
                                                @error('stok')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="number" id="harga" class="form-control" name="harga"
                                                    min="0" placeholder="0" value="{{ $barang->harga }}">
                                                @error('harga')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ukuran">Ukuran</label>
                                                <input type="text" id="ukuran" class="form-control" name="ukuran"
                                                    min="0" placeholder="" value="{{ $barang->ukuran }}">
                                                @error('ukuran')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="warna">Warna</label>
                                                <input type="text" id="warna" class="form-control" name="warna"
                                                    min="0" placeholder="" value="{{ $barang->warna }}">
                                                @error('warna')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" id="satuan" class="form-control" name="satuan"
                                                    min="0" placeholder="Pcs" value="{{ $barang->satuan }}">
                                                @error('satuan')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group my-4">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input" id="gambar"
                                                        name="gambar" value="{{ $barang->gambar }}">

                                                    <label class="form-file-label" for="gambar">
                                                        <span class="form-file-text">Choose file...</span>
                                                        <span class="form-file-button">Browse</span>
                                                        <span>{{ $barang->gambar }}</span>
                                                    </label>
                                                </div>
                                                @error('gambar')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{ $barang->deskripsi }}</textarea>
                                                @error('deskripsi')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ route('barang.index') }}'">Back</button>
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
