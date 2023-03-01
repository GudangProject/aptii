@section('title')
    Anggota {{ website()->name }} -
@endsection
<x-master-layouts>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <div class="alert-body"><strong>{{ session('message') }}</strong></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="content-wrapper">
            @livewire('asosiasi.membership')
        </div>
    </div>
</x-master-layouts>
