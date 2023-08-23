<?php

namespace App\Http\Controllers\Api;

use App\FileHelper;
use App\Models\Book;
use App\Models\Tugas;
use App\Models\Jawaban;
use App\Http\Controllers\Controller;

class TugasApiController extends Controller
{
    public function all()
    {
        $id_mahasiswa = request('id_mahasiswa');
        $id_quote = Jawaban::where('id_mahasiswa', $id_mahasiswa)->get()->pluck('id_quote');
        return Book::with('quote')->get()->map(function ($item) use ($id_quote) {
            $progress = $item->quote->whereIn('id', $id_quote)->count();
            return [
                'id' => $item->id,
                'title' => $item->title,
                'pub_year' => $item->publication_year,
                'cover_image' => $item->cover_image_url,
                'total' => $item->quote->count(),
                'progress' => $progress,
                'done' => $item->quote->count() == $progress
            ];
        });
    }

    public function getJson()
    {
        return Book::with('quote')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'quotes' => $item->quote->map(function ($item) {
                    $item->audio_path = "app/audio_synthesis/$item->id.wav";
                    $item->save();
                    return [
                        'id' => $item->id,
                        'sentence' => $item->sentence
                    ];
                })
            ];
        });
    }

    public function get(Book $tugas)
    {
        $id_mahasiswa = request('id_mahasiswa');
        $jawaban = Jawaban::where('id_mahasiswa', $id_mahasiswa)->get();
        return $tugas->quote->map(function ($item) use ($jawaban) {
            $result = $jawaban->where('id_quote', $item->id)->first();
            return [
                'id' => $item->id,
                'sentence' => $item->sentence,
                'audio_path' => $item->audio_path,
                'pronunciation_score' => (float) ($result->pronunciation_score ?? 0),
                'accuracy_score' => (float) ($result->accuracy_score ?? 0),
                'fluency_score' => (float) ($result->fluency_score ?? 0),
                'completeness_score' => (float) ($result->completeness_score ?? 0),
                'detail' => ($result) ? $result->detail : null,
                'done' => ($result) ? true :  false
            ];
        });
    }

    public function speechRecognition()
    {
        $id_mahasiswa = request('id_mahasiswa');
        $id_quote = request('id_quote');
        $path = FileHelper::upload(request('audio'))
            ->destination('app/audio_record')
            ->save();

        $data = $this->parseData(request('data'));

        $jawaban = new Jawaban;
        $jawaban->id_mahasiswa = $id_mahasiswa;
        $jawaban->id_quote = $id_quote;
        $jawaban->audio_path = $path;
        $jawaban->accuracy_score = $data['accuracy'];
        $jawaban->pronunciation_score = $data['pronunciation'];
        $jawaban->fluency_score = $data['fluency'];
        $jawaban->completeness_score = $data['completeness'];
        $jawaban->detail = $data['detail'];
        $jawaban->save();

        return response()->json($jawaban, 200);
    }

    public function parseData($data)
    {
        $jsonData = json_decode($data);
        $words = collect($jsonData->detailResult->Words);
        $detail = $words->map(function ($word) {
            return [
                'word' => $word->Word,
                'accuracy' => $word->PronunciationAssessment->AccuracyScore
            ];
        });
        return [
            'accuracy' => $jsonData->accuracyScore,
            'pronunciation' => $jsonData->pronunciationScore,
            'completeness' => $jsonData->completenessScore,
            'fluency' => $jsonData->fluencyScore,
            'detail' => $detail
        ];
    }
}
