<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data['list_mahasiswa'] = Mahasiswa::orderBy('username')->get();
        return view('admin.master-data.mahasiswa.index', $data);
    }

    public function create()
    {
        return view('admin.master-data.mahasiswa.create');
    }

    public function store()
    {
        if (Mahasiswa::where('nim', request('nim'))->exists())
            return back()->with('danger', 'Mahasiswa telah terdaftar');

        $pengguna = new Mahasiswa;
        $pengguna->nim = request('nim');
        $pengguna->angkatan = request('angkatan');
        $pengguna->nama = request('nama');
        $pengguna->password = request('password');
        $pengguna->save();

        return redirect('admin/master-data/pengguna')->with('success', 'Data mahasiswa berhasil tersimpan');
    }

    public function show(Mahasiswa $pengguna)
    {
        $data['mahasiswa'] = $pengguna;
        return view('admin.master-data.mahasiswa.show', $data);
    }

    public function edit(Mahasiswa $pengguna)
    {
        $data['mahasiswa'] = $pengguna;
        return view('admin.master-data.mahasiswa.edit', $data);
    }

    public function update(Mahasiswa $pengguna)
    {

        $pengguna->nim = request('nim');
        $pengguna->angkatan = request('angkatan');
        $pengguna->nama = request('nama');
        if (request()->password) $pengguna->password = request('password');
        $pengguna->save();

        return redirect('admin/master-data/pengguna')->with('success', 'Perubahan data mahasiswa berhasil tersimpan');
    }

    public function destroy(Mahasiswa $pengguna)
    {
        $pengguna->delete();

        return back()->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
