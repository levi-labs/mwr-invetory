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
                    <h4 class="card-title">Barang Keluar</h4>
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
                                <form action="{{ route('barang-keluar.store-analysis') }}" class="form form-vertical"
                                    method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="periode">Periode</label>
                                                <select class="form-select" id="periode" name="periode" required>
                                                    <option selected disabled>Pilih Periode</option>
                                                    <option value="1">1 Bulan</option>
                                                    <option value="3">3 Bulan</option>
                                                    <option value="6">6 Bulan</option>
                                                </select>
                                                @error('periode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="button" id="submitBtn"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ route('barang-keluar.index') }}'">Back</button>
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


    @if (isset($data) && isset($result))
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Analisis</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Barang</th>
                                            <th>Actual</th>
                                            <th>Forecast</th>
                                            <th>Bulan Tahun</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>{{ $item->total_qty }}</td>
                                                <td>{{ $result[$key]['score'] }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('m-Y', $item->month . '-' . $item->year)->format('F Y') }}
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sales Forecast</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! $line->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ $line->cdn() }}"></script>
        {{ $line->script() }}
    @endif


    <script>
        document.getElementById('periode').addEventListener('change', function() {
            var selectedValue = this.value;
            var submitBtn = document.getElementById('submitBtn');

            if (selectedValue == '1' || selectedValue == '3' || selectedValue == '6') {
                submitBtn.disabled = false;
                submitBtn.type = 'submit';
            } else {
                submitBtn.disabled = true;
                submitBtn.type = 'button';
            }
        });
    </script>

@endsection
