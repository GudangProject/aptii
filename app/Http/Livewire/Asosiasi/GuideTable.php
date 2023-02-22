<?php

namespace App\Http\Livewire\Asosiasi;

use App\Models\Guide;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class GuideTable extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $selectJobs = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $statusSelected = false;
    public $search, $selected_id, $limitPerPage = 10, $changeLimitPage;
    public $category = [], $file_guide, $rolesEdit;

    protected $queryString = ['search' => ['except' => '']];
    protected $listeners = [
        'deleteConfirmed',
        'deleteSelected',
        'jobs-table' => 'jobsCategoryTable'
    ];

    public function jobsCategoryTable(){
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        if(!empty($this->changeLimitPage)){
            $this->limitPerPage = $this->changeLimitPage;
        }

        $data = Guide::orderByDesc('created_at')->paginate($this->limitPerPage);
        if($this->search != null){
            $data = Guide::where('file', 'like', '%'.$this->search.'%')->orderByDesc('created_at')->paginate($this->limitPerPage);
        }

        $this->emit('postStore');
        $this->dispatchBrowserEvent('iconLoad');

        $this->bulkDisabled = count($this->selectJobs) < 1;
        return view('livewire.asosiasi.guide-table', [
            'data' => $data,
            'roles' => Role::all(),
        ]);
    }

    public function deleteSelectedConfirm(){
        $this->alert('question', 'Yakin data akan dihapus?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'onConfirmed' => 'deleteSelected',
            'position' => 'center',
            'timer' => null,
        ]);

    }

    public function deleteSelected(){
        Guide::query()
            ->whereIn('id', $this->selectJobs)
            ->delete();
        $this->selectJobs = [];
        $this->selectAll = false;
    }

    public function editGuide($id){
        $data = Guide::findOrFail($id);
        $this->category = $id;
        $this->file_guide = $data->file;
        $this->rolesEdit = Role::all();
        $this->dispatchBrowserEvent('openCategoryModal');
    }

    public function updateGuide(){
        if($this->file_guide != null){
            $this->validate([
                'file_guide' => 'mimes:pdf|max:10240',
            ]);

            $this->file_guide->storeAs('public/files/guide/', $this->file_guide->getClientOriginalName());
        }

        $save = Guide::findOrFail($this->categoryId);

        if($this->file_guide != null){
            $save->file = $this->file_guide->getClientOriginalName();
        }

        $save->category = $this->category;
        $save->status = 1;
        $save->created_by = auth()->user()->id;
        $save->save();

        $this->alert('success', 'Category update successfully...', [
            'position' => 'center',
        ]);

        $this->dispatchBrowserEvent('closeCategoryModal');
    }

    public function selectAll(){
        if($this->selectAll == true){
            $this->selectJobs = Guide::pluck('id');
            $this->statusSelected = true;
        }else{
            $this->selectJobs = [];
        }
    }

    public function unselectedJobs(){
        $this->selectJobs = [];
        $this->selectAll = false;
        $this->statusSelected = false;

    }

    public function updateStatus($value){
        Guide::query()
            ->whereIn('id', $this->selectJobs)
            ->update([
                'status' => $value
            ]);

        $this->selectJobs = [];
        $this->selectAll = false;
        $this->statusSelected = false;
    }

    public function deleteSingleSelected($id){
        $this->selected_id = $id;

        $this->alert('question', 'Yakin data akan dihapus?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'onConfirmed' => 'deleteConfirmed',
            'position' => 'center',
            'timer' => null,
        ]);
    }

    public function deleteConfirmed(){
        Guide::findOrFail($this->selected_id)->delete();
        $this->alert('success', 'Data berhasil dihapus', [
            'position' => 'center',
        ]);
    }

    public function createGuide(){
        // dd(json_encode($this->category));
        try{
            $this->validate([
                'category' => 'required',
                'file_guide' => 'required|mimes:pdf|max:10240',
            ]);

            $this->file_guide->storeAs('public/files/guide/', $this->file_guide->getClientOriginalName());
            $save = new Guide();
            $save->file = $this->file_guide->getClientOriginalName();
            $save->category = json_encode($this->category);
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            $this->alert('success', 'Bidang Ilmu berhasil ditambahkan !', [
                'position' => 'center',
            ]);

        $this->dispatchBrowserEvent('closeModalBidangIlmu');

        }catch(Exception $error){
            $this->alert('error', $error->getMessage(), [
                'position' => 'center',
            ]);
        }
    }
}
