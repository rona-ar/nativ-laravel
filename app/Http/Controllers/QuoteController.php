<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Tugas;
use App\Models\Pertanyaan;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    public function show(Quote $pertanyaan)
    {
        $data['quote'] = $pertanyaan;
        return view('admin.pertanyaan.show', $data);
    }
    public function destroy(Quote $pertanyaan)
    {
        $pertanyaan->delete();

        return back()->with('success', "Data pertanyaan berhasil dihapus");
    }
}
