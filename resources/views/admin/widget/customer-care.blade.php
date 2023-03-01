<div class="card">
    <div class="card-body">
        <h4 class="text-primary">Kontak Narahubung</h4>

        @foreach ($data as $row)
            <div class="d-flex justify-content-start align-items-center mt-2">
                <div class="avatar mr-75">
                    <img src="{{asset('storage/images/users').'/'.$row->getUser->profile_photo_path}}" alt="avatar" height="40" width="40" />
                </div>
                <div class="profile-user-info">
                    <h6 class="mb-0">{{ $row->getUser->name }}</h6>
                    <small class="text-muted">{{ $row->getUser->phone }}</small>
                </div>
                <a href="https://wa.me/{{ $row->getUser->phone }}" target="_blank" class="btn btn-success btn-icon btn-sm ml-auto">
                    <i data-feather="message-circle"></i>
                </a>
            </div>

            @if ($loop->depth == 8)
                @break
            @endif
        @endforeach
    </div>
    @php
        $paymentCheck = \App\Models\Prosiding\ProsidingPembayaran::where('user_id', auth()->user()->id)->latest()->first();
        $json = file_get_contents('JSON/group-cs.json');
        $group = json_decode($json, true);
    @endphp
    @isset($paymentCheck)
        @if ($paymentCheck->status == 1)
            @if ($group != null)
            <div class="card-body">
                <h4 class="text-primary">
                    Link Group :
                    <a href="{{ $group['data']['group'][0]['url'] }}" class="badge badge-primary">
                        Gabung Sekarang
                    </a>
                </h4>
            </div>
            @endif
        @endif
    @endisset
    @if ($config->address != null)
        <div class="card-body">
            <h4 class="text-primary">Kantor</h4>
            <div class="d-flex justify-content-start align-items-center mt-2">
                {{ $config->address }}
            </div>
        </div>
    @endif
    <div class="card-body">
        <h4 class="text-primary">Informasi Pembayaran</h4>
        @php
            $rekening = \App\Models\Prosiding\Rekening::all();
        @endphp
        <ul>
        @foreach ($rekening as $item)
            <li>{{ $item->bank }} <strong>{{ $item->rekening }}</strong> a.n {{ $item->nama }}</li>
        @endforeach
        </ul>
    </div>
</div>
