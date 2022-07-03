<div>
    <div class="content-header row">
        <div class="content-header-left col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-7">
                    <h2 class="content-header-title float-left mb-0">Jobs List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Jobs
                            </li>
                            <li class="breadcrumb-item active">Jobs List
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-5 d-flex justify-content-end">
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary" >New Job</a>
                </div>

                <div class="modal fade text-left" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    @if (count($selectJobs) > 0)
                    <div class="card-body">
                        <p class="card-text">
                            {{ count($selectJobs) }} data selected, <button wire:click="unselectedJobs()" class="btn btn-sm btn-primary">Cancel</button>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item" href="javascript:void(0);" wire:click="updateStatus(0)">Hidden</a>
                                    <a class="dropdown-item" href="javascript:void(0);" wire:click="updateStatus(1)">Show</a>
                                    <a class="dropdown-item" href="javascript:void(0);" wire:click="deleteSelected()">Delete</a>
                                </div>
                            </div>
                        </p>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" wire:click="selectAll()" wire:model="selectAll"></th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Position</th>
                                    <th>Offer Salary</th>
                                    <th>Location</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $row->id }}" wire:model="selectJobs" id="a">
                                        </td>
                                        <td>
                                            <span class="font-weight-bold">{{ $row->title }}</span>
                                            @if ($row->status < 1)
                                                <span class="badge badge-light-danger">hidden</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->type }}</td>
                                        <td>
                                            <span class="badge badge-light-primary mr-1"> {{ ucwords($row->position) }}</span>
                                        </td>
                                        <td>
                                            {{ number_format($row->budget_min) }} - {{ number_format($row->budget_max) }}
                                        </td>
                                        <td>{{ $row->work_location }}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                                    <a class="dropdown-item" href="javascript:void(0);" wire:click="updateStatus(0)">Detail</a>
                                                    <a class="dropdown-item" href="{{ route('jobs.edit', $row->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" wire:click="deleteSelected()">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="pt-2 pb-2">Data not found !</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-2">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('vendor-css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/vendors.min.css">
    @endpush
    @push('page-js')
        <script src="{{ asset('assets') }}/ckeditorx/ckeditor.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>
        <script>
            window.addEventListener('openFormModal', event => {
                $("#create-modal").modal('show');
            })

            window.addEventListener('closeFormModal', event => {
                $("#create-modal").modal('hide');
            })
        </script>
    @endpush

</div>
