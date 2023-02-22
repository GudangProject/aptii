<x-frontend-master>
    <section class="page-header">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-8">
              <div class="title-block">
                <h1>Anggota {{ website()->name }}</h1>
                <ul class="header-bradcrumb justify-content-center">
                  <li><a href="/">Home</a></li>
                  <li class="active" aria-current="page">Anggota</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section class="section-padding page" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8 col-12">
                    <form class="row g-2" method="get" action="{{ route('anggota') }}">
                        <div class="col-10">
                            <label for="search" class="visually-hidden">Password</label>
                            <input type="text" name="search" class="form-control" id="search" placeholder="Cari Anggota">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary mb-3">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-xl-8 col-12">
                    <div class="post-single">
                        <ul class="list-group">
                            @forelse ($data as $item)
                            <li class="list-group-item {{ $data->firstItem() + $loop->index == 1 ? 'list-group-item-action list-group-item-primary' : '' }}">
                                <a href="{{ route('anggota.detail', ['id' => $item->user_id]) }}" class="text-dark">
                                    {{ $data->firstItem() + $loop->index }}.
                                <strong> {{ $item->user->name }}</strong></a>
                                <span class="badge bg-{{ $data->firstItem() + $loop->index == 1 ? 'dark' : 'primary' }} text-white fw-bold">{{  $item->user->company  }}</span>
                            </li>
                            @empty
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Coming Soon.
                            </li>
                            @endforelse
                        </ul>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $data->links() }}
                        </div>
                    </div>
                  </div>
                <div class="col-lg-4 col-xl-4 col-12">
                    @include('client.sections.sidebar')
                </div>

            </div>
        </div>
        <!--course-->
    </section>
</x-frontend-master>
