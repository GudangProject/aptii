@php
    $config = \App\Models\Admin\Configuration::orderBy('created_at')->first();
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/dashboard"><span class="brand-logo">
                <h2 class="brand-text">{{ $config->name }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
            </li>

            @role('anggota|admin|super admin')
                @php
                    $paymentCheck = \App\Models\Prosiding\ProsidingPembayaran::where('user_id', auth()->user()->id)->latest()->first();
                @endphp
                @isset($paymentCheck)
                    @if ($paymentCheck->status == 1)
                        <li class="navigation-header"><span data-i18n="Apps &amp; Pages">Layanan</span><i data-feather="more-horizontal"></i>
                        </li>
                        <li class="{{ request()->routeIs('asosiasi.info') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('asosiasi.info') }}"><i data-feather="radio"></i><span class="menu-title text-truncate" data-i18n="User">Info Asosiasi</span></a>
                        </li>
                        @php
                            $json = file_get_contents('JSON/link-prosiding.json');
                            $linkasosiasi = json_decode($json, true);
                        @endphp
                        {{-- <li class="nav-item"><a class="d-flex align-items-center" href="{{ $linkasosiasi['data']['group'][0]['url'] }}" target="_blank"><i data-feather="external-link"></i><span class="menu-title text-truncate" data-i18n="User">Jurnal Asosiasi</span></a>
                        </li> --}}
                        <li class="{{ request()->routeIs('asosiasi.seminar') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('asosiasi.seminar') }}"><i data-feather="tv"></i><span class="menu-title text-truncate" data-i18n="User">Event Acara</span></a>
                        </li>
                        <li class="{{ request()->routeIs('asosiasi.sertifikat') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('asosiasi.sertifikat') }}"><i data-feather="file"></i><span class="menu-title text-truncate" data-i18n="User">Sertifikat</span></a>
                        </li>
                        @role('member|anggota')
                        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="repeat"></i><span class="menu-title text-truncate" data-i18n="Pages">Kerjasama</span></a>
                            <ul class="menu-content">
                                <li class="{{ request()->routeIs('activity.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('activity.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="User">Kerjasama Kegiatan</span></a>
                                </li>
                                <li class="{{ request()->routeIs('journal_collab.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('journal_collab.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="User">Kerjasama Jurnal</span></a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                    @endif
                @endisset
            <li class="{{ request()->routeIs('asosiasi.bukti-pembayaran') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('asosiasi.bukti-pembayaran') }}"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="User">Data Pembayaran</span></a>
            </li>
            @endrole

            <li class="{{ request()->routeIs('user.guide') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('user.guide') }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="User">Panduan</span></a>
            </li>

            @role('admin|super admin|writer')
            <li class="navigation-header"><span data-i18n="Apps &amp; Pages">Data</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Pages">Data Asosiasi</span></a>
                <ul class="menu-content">
                    {{-- <li class="{{ request()->routeIs('asosiasi.upload-naskah') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('asosiasi.upload-naskah') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="User">Naskah Jurnal</span></a>
                    </li>
                    @role('super admin')
                    <li class="{{ request()->routeIs('asosiasi.naskah') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('asosiasi.naskah') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Kelola Jurnal</span></a>
                    </li>
                    @endrole
                    <li class="{{ request()->routeIs('bidang-ilmu.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('bidang-ilmu.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Bidang Ilmu</span></a>
                    </li>
                    <li class="{{ request()->routeIs('asosiasi.template') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('asosiasi.template') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Template</span></a>
                    </li> --}}
                    <li class="{{ request()->routeIs('asosiasi.pembayaran') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('asosiasi.pembayaran') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Pembayaran</span></a>
                    </li>
                    <li class="{{ request()->routeIs('customer-care.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('customer-care.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Kontak Narahubung</span></a>
                    </li>
                    <li class="{{ request()->routeIs('asosiasi.nasional') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('asosiasi.nasional') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Link Jurnal Asosiasi</span></a>
                    </li>
                    <li class="{{ request()->routeIs('certificate.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('certificate.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Data Sertifikat</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='dollar-sign'></i><span class="menu-title text-truncate" data-i18n="Pages">Laporan Keuangan</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('finance.journal-afiliasi') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('finance.journal-afiliasi') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Jurnal Afiliasi</span></a>
                    </li>
                    <li class="{{ request()->routeIs('finance.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('finance.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Member</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="repeat"></i><span class="menu-title text-truncate" data-i18n="Pages">Kerjasama</span></a>
                <ul class="menu-content">
                    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('activity.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="User">Kerjasama Kegiatan</span></a>
                    </li>
                    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('journal_collab.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="User">Kerjasama Jurnal</span></a>
                    </li>
                </ul>
            </li>
            {{-- <li class="{{ request()->routeIs('managers.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('managers.index') }}"><i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="Pages">Pengurus</span></a>
            </li> --}}
            <li class="{{ request()->routeIs('memberships.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('memberships.index') }}"><i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="Pages">Anggota</span></a>
            </li>
            <li class="{{ request()->routeIs('event.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('event.index') }}"><i data-feather="tv"></i><span class="menu-title text-truncate" data-i18n="Pages">Event Acara</span></a>
            </li>

            @can('edit articles')
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Pages">Posts</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('articles.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('articles.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Artikel Asosiasi</span></a>
                    </li>
                    <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('categories.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Kategori</span></a>
                    </li>
                    <li class="{{ request()->routeIs('tags.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('tags.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">Tags</span></a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('pages.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('pages.index') }}"><i data-feather="folder"></i><span class="menu-title text-truncate" data-i18n="Configuration">Page</span></a>
            </li>
            @endcan

            <li class="{{ request()->routeIs('agenda.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('agenda.index') }}"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Pages">Agenda</span></a>
            </li>
            <li class="{{ request()->routeIs('images.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('images.index') }}"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Pages">Iklan</h5></a></li>
            <li class="{{ request()->routeIs('videos.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('videos.index') }}"><i data-feather="video"></i><span class="menu-title text-truncate" data-i18n="Pages">Video</h5></a></li>

            @endrole

            @role('super admin')
            <li class="navigation-header"><span data-i18n="Apps &amp; Pages">Setting</span><i data-feather="more-horizontal"></i>
            </li>

            <li class="{{ request()->routeIs('menu.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('menu.index') }}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Configuration">Menu</span></a>
            </li>
            <li class="{{ request()->routeIs('configuration.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('configuration.index') }}"><i data-feather="globe"></i><span class="menu-title text-truncate" data-i18n="Configuration">Web Setting</span></a>
            </li>
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('users.index') }}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="User">Users</span></a>
            </li>
            <li class="{{ request()->routeIs('role-permission.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('role-permission.index') }}"><i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="User">Manajemen User</span></a>
            </li>
            <li class="{{ request()->routeIs('guides.index') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('guides.index') }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="User">Panduan User</span></a>
            </li>
            @endrole

            {{-- <li class="nav-item"><a class="d-flex align-items-center" href="qrcode"><i data-feather="cpu"></i><span class="menu-title text-truncate" data-i18n="qrcode">QR Code Generator</span></a> --}}
            </li>
        </ul>
    </div>
</div>