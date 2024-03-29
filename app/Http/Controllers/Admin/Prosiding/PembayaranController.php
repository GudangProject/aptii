<?php

namespace App\Http\Controllers\Admin\Prosiding;

use App\Http\Controllers\Controller;
use App\Models\Prosiding\ProsidingNaskah;
use App\Models\Prosiding\ProsidingPembayaran;
use App\Models\Prosiding\Rekening;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    public function index(){
        return view('admin.asosiasi.pembayaran');
    }

    public function create()
    {
        return view('admin.asosiasi.bukti-pembayaran.create', [
            'dataNaskah' => ProsidingNaskah::where('user_id', auth()->user()->id)->where('status', 5)->get(),
            'dataRekening' => Rekening::where('status', true)->get()
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required|mimes:jpg,png,jpeg',
        ]);

        try {
            $request->photo->storeAs('public/images/bukti_bayar/', auth()->user()->id.$request->photo->getClientOriginalName());

            $save                   = new ProsidingPembayaran();
            $save->user_id          = auth()->user()->id;
            $save->category         = $request->category;
            $save->no_transaksi     = $request->no_transaksi;
            $save->tanggal_bayar    = $request->tanggal_bayar;
            $save->jumlah           = $request->jumlah_bayar;
            $save->nama_pengirim    = $request->nama_pengirim;
            $save->bank_pengirim    = $request->bank_pengirim;
            $save->rekening_tujuan  = $request->rekening_tujuan;
            $save->keterangan       = $request->keterangan;
            $save->status           = 0;
            $save->photo            = '/storage/images/bukti_bayar/'.auth()->user()->id.$request->photo->getClientOriginalName();
            $save->save();

            Alert::success('Success', 'Bukti pembayaran berhasil diupload !');
            return redirect()->route('asosiasi.bukti-pembayaran');

        } catch (Exception $error) {
            dd($error->getMessage());
            Alert::error('Error', $error->getMessage());
            return back();
        }
    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {

    }

    public function uploadPembayaran(){
        return view('admin.asosiasi.bukti-pembayaran.index');
    }

    public function memberSKPayment(Request $request)
    {

        try {

            $save                   = new ProsidingPembayaran();
            $save->user_id          = auth()->user()->id;
            $save->category         = 3;
            $save->no_transaksi     = 0;
            $save->tanggal_bayar    = now();
            $save->jumlah           = 0;
            $save->nama_pengirim    = 'none';
            $save->bank_pengirim    = 'none';
            $save->rekening_tujuan  = 0;
            $save->keterangan       = $request->keterangan;
            $save->status           = 0;
            $save->photo            = 0;
            $save->save();

            Alert::success('Success', 'Bukti member SK Penunjukan berhasil diupload !');
            return redirect()->route('asosiasi.bukti-pembayaran');

        } catch (Exception $error) {
            dd($error->getMessage());
            Alert::error('Error', $error->getMessage());
            return back();
        }
    }
}
