<?php

namespace App\Http\Controllers;

use App\FileHelper;
use App\Models\Book;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Quote;
use App\Models\Tugas;
use App\Models\Jawaban;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TugasController extends Controller
{
    public function index()
    {
        $data['list_tugas'] = Book::withCount('quote')->get();
        return view('admin.tugas.index', $data);
    }

    public function create()
    {
        return view('admin.tugas.create');
    }

    public function store()
    {
        $book = new Book;
        $book->title = request('title');
        $book->author = request('author');
        $book->publication_year = request('publication_year');
        if (request('cover_image')) {
            $book->cover_image = FileHelper::upload('cover_image')->destination('app/cover_image')->save();
        }
        $book->save();

        foreach (request('kalimat') as $key => $kalimat) {
            $pertanyaan = new Quote();
            $pertanyaan->id_book = $book->id;
            $pertanyaan->sentence = (string) $kalimat;
            $pertanyaan->save();
        }

        return redirect('admin/tugas')->with('success', 'Tugas berhasil ditambahkan');
    }

    public function show(Book $tugas)
    {
        $tugas->quote->each(function ($item) {
            $item->dikerjakan = Jawaban::where('id_quote', $item->id)->count();
        });
        $data['buku'] = $tugas;
        return view('admin.tugas.show', $data);
    }


    public function edit(Book $tugas)
    {
        $data['tugas'] = $tugas;
        return view('admin.tugas.edit', $data);
    }

    public function update(Book $tugas)
    {
        $tugas->title = request('title');
        $tugas->author = request('author');
        $tugas->publication_year = request('publication_year');
        if (request('cover_image')) {
            $tugas->cover_image = FileHelper::upload('cover_image')->destination('app/cover_image')->save();
        }
        $tugas->save();

        foreach (request('kalimat') as $key => $kalimat) {
            $pertanyaan = Quote::find($key);
            if (!$pertanyaan) $pertanyaan = new Quote;
            $pertanyaan->id_book = $tugas->id;
            $pertanyaan->sentence = $kalimat;
            if (isset(request('file_audio')[$key])) {
                $pertanyaan->audio_path = FileHelper::upload(request('file_audio')[$key])->destination('app/audio_path')->save();
            }
            $pertanyaan->save();
        }

        return redirect('admin/tugas')->with('success', 'Tugas berhasil ditambahkan');
    }

    public function destroy(Book $tugas)
    {
        $tugas->quote->each(function ($item) {
            $item->delete();
        });
        $tugas->delete();

        return redirect('admin/tugas')->with('success', 'Tugas Berhasil Dihapus');
    }
}
