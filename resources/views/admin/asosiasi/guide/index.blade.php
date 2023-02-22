@section('title')
    Panduan User -
@endsection
<x-master-layouts>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @livewire('asosiasi.guide-table')
        </div>
    </div>
</x-master-layouts>
