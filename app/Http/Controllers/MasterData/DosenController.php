<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    public function index()
    {
        $data['list_dosen'] = Dosen::orderBy('nama')->get();
        return view('admin.master-data.dosen.index', $data);
    }

    public function create()
    {
        return view('admin.master-data.dosen.create');
    }

    public function store()
    {
        if (Dosen::where('nip', request('nip'))->exists())
            return back()->with('danger', 'Dosen telah terdaftar');

        $dosen = new Dosen;
        $dosen->nip = request('nip');
        $dosen->nama = request('nama');
        $dosen->gelar_depan = request('gelar_depan');
        $dosen->gelar_belakang = request('gelar_belakang');
        $dosen->password = request('password');
        $dosen->save();

        return redirect('admin/master-data/dosen')->with('success', 'Data dosen berhasil tersimpan');
    }

    public function show(Dosen $dosen)
    {
        $data['dosen'] = $dosen;
        return view('admin.master-data.dosen.show', $data);
    }

    public function edit(Dosen $dosen)
    {
        $data['dosen'] = $dosen;
        return view('admin.master-data.dosen.edit', $data);
    }

    public function update(Dosen $dosen)
    {
        $dosen->nama = request('nama');
        $dosen->gelar_depan = request('gelar_depan');
        $dosen->gelar_belakang = request('gelar_belakang');
        if (request()->password) $dosen->password = request('password');
        $dosen->save();

        return redirect('admin/master-data/dosen')->with('success', 'Perubahan data dosen berhasil tersimpan');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus');
    }
}
