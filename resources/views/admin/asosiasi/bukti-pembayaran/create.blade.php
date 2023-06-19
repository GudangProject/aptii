@section('title')
    Upload Bukti Pembayaran -
@endsection
<x-master-layouts>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Upload Bukti Pembayaran</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="{{ route('asosiasi.bukti-pembayaran') }}">Bukti Pembayaran</a>
                                    </li>
                                    <li class="breadcrumb-item active">Upload
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card p-1">
                            <div class="content-body">
                                <div class="row" id="basic-table">
                                    <div class="col-12">
                                        <div class="card">
                                            <form action="{{ route('upload-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label><h5>Kategori Pembayaran</h5></label>
                                                        <select class="select2 form-control form-control-lg select2-hidden-accessible" id="category" name="category">
                                                            <option disabled selected>--- Pilih ---</option>
                                                            <option value="1">Member Reguler</option>
                                                            <option value="2">Pengelola Jurnal</option>
                                                            <option value="3">Member SK Penunjukan</option>
                                                        </select>
                                                    </div>
                                                    <div id='payment'>
                                                        <div class="form-group">
                                                            <label><h5>Nomor Transaksi</h5></label>
                                                            <input type="text" name="no_transaksi" class="form-control" placeholder="Nomor Transaksi Dari Bank" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label><h5>Tanggal Bayar</h5></label>
                                                                    <input type="date" name="tanggal_bayar" class="form-control" placeholder="Tanggal Bayar" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label><h5>Jumlah Bayar RP</h5></label>
                                                                    <input type="text" name="jumlah_bayar" class="form-control" placeholder="0" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><h5>Nama Pengirim</h5></label>
                                                            <input type="text" name="nama_pengirim" class="form-control" placeholder="Cth: Andi Mahendra" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><h5>Bank Pengirim</h5></label>
                                                            <input type="text" name="bank_pengirim" class="form-control" placeholder="Cth: Mandiri" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><h5>Rekening Tujuan</h5></label>
                                                            <select class="select2 form-control form-control-lg select2-hidden-accessible" name="rekening_tujuan">
                                                                <option value="" disabled selected>--- Pilih ---</option>
                                                                @foreach ($dataRekening as $rekening)
                                                                    <option value="{{ $rekening->id }}">{{ $rekening->bank }} - {{ $rekening->rekening }} a/n {{ $rekening->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><h5>Keterangan</h5></label>
                                                            <textarea class="form-control" name="keterangan" placeholder="Cth: Biaya pendaftaran ..." rows=3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><h5>Bukti Bayar</h5></label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="photo" id="customFile" accept="image/*"/>
                                                                <label class="custom-file-label" for="customFile">Pilih File</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-2"><i data-feather="arrow-up-circle"></i> UPLOAD</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="sk">
                                                <form action="{{ route('member-sk') }}" method="post">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label><h5>Keterangan/Lampirkan link SK Penunjukan</h5></label>
                                                            <textarea class="form-control" name="keterangan" rows=3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-2"><i data-feather="arrow-up-circle"></i> UPLOAD</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @push('vendor-css')
                            <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/vendors.min.css">
                            <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/forms/select/select2.min.css">
                            @endpush
                            @push('page-vendor')
                            <script src="{{ asset('assets') }}/vendors/js/forms/select/select2.full.min.js"></script>
                            @endpush
                            @push('page-js')
                            <script src="{{ asset('assets') }}/js/scripts/forms/form-select2.js"></script>

                                <script>
                                    window.addEventListener('addNaskah', event => {
                                        $("#create-modal").modal('show');
                                    })

                                    window.addEventListener('closeModal', event => {
                                        $("#create-modal").modal('hide');
                                    })

                                    window.addEventListener('iconLoad', event => {
                                        if (feather) {
                                            feather.replace({
                                                width: 14,
                                                height: 14
                                            });
                                        }
                                    })
                                </script>
                                <script>
                                    $('#sk').hide();
                                    $('#category').on('change', function () {
                                        if (this.value == 3) {
                                            $('#payment').hide();
                                            $('#sk').show();
                                        }else{
                                            $('#payment').show();
                                            $('#sk').hide();
                                        }
                                    });
                                </script>
                            @endpush
                        </div>
                    </div>
                </div>
                @include('admin.modals.alert')
            </div>
        </div>
    </div>
</x-master-layouts>
