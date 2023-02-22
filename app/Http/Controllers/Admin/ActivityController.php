<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use Illuminate\Support\Str;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{

    public function index()
    {
        return view('admin.asosiasi.activity.index');
    }

    public function create()
    {
        return view('admin.asosiasi.activity.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'institution' => 'required',
            'date' => 'required',
            'budget' => 'required|integer',
            'no_rekening' => 'required',
            'description' => '',
        ]);

        if($validator->fails()) {
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }

        try {
            Activity::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'institution' => $request->institution,
                'date' => $request->date,
                'budget' => $request->budget,
                'no_rekening' => $request->no_rekening,
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => auth()->user()->id,
            ]);
            Alert::success('Success', 'Data kegiatan berhasil ditambahkan.');
            return redirect()->route('activity.index');
        } catch (Exception $error) {
            Alert::toast($error->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        return view('admin.asosiasi.activity.detail', [
            'data' => Activity::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('admin.asosiasi.activity.edit', [
            'data' => Activity::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'institution' => 'required',
            'date' => 'required',
            'budget' => 'required|integer',
            'no_rekening' => 'required',
            'description' => '',
        ]);

        if($validator->fails()) {
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }

        try {
            Activity::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'institution' => $request->institution,
                'date' => $request->date,
                'budget' => $request->budget,
                'no_rekening' => $request->no_rekening,
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => auth()->user()->id,
            ]);
            Alert::success('Success', 'Data kegiatan berhasil diupdate.');
            return redirect()->route('activity.index');
        } catch (Exception $error) {
            Alert::toast($error->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function setBudget(Request $request){
        Activity::where('id', $request->selectId)
            ->update([
                'max_budget' => $request->max_budget,
                'status' => 1,
            ]);

        Alert::success('Success', 'Anggaran berhasil diupdate.');
        return redirect()->route('activity.index');
    }
}
