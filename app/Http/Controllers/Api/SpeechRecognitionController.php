<?php

namespace App\Http\Controllers\Api;

use App\FileHelper;
use App\Models\Jawaban;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SpeechRecognitionController extends Controller
{


    public function getDetail(Jawaban $jawaban)
    {
        return [
            'id' => $jawaban->id,
            'sentence' => $jawaban->sentence,
            'audio_path' => $jawaban->audio_path,
            'pronunciation_score' => (string) ($jawaban->pronunciation ?? 0),
            'accuracy_score' => (string) ($jawaban->accuracy ?? 0),
            'fluency_score' => (string) ($jawaban->fluency ?? 0),
            'completeness_score' => (string) ($jawaban->completeness ?? 0),
            'detail_score' => $this->getData($jawaban->data),
            'done' => ($jawaban) ? true :  false
        ];
    }

    public function parseData($data)
    {
        $data = json_decode($data);
        $words = collect($data->detailResult->Words);
        return $words->map(function ($word) {
            return [
                'word' => $word->Word,
                'accuracy' => $word->PronunciationAssessment->AccuracyScore
            ];
        });
    }
}
