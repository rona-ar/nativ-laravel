<x-app header="Tugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Pertanyaan</div>
                    <div class="float-right">
                        @if ($quote->audio_path)
                            <button class="btn btn-primary" onclick="playAudio('{{ url($quote->audio_path) }}')"><i
                                    class="fa fa-play"></i>
                                Dengarkan
                            </button>
                        @else
                            <button class="btn btn-dark" disabled><i class="fa fa-play"></i>
                                Dengarkan
                            </button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>Kalimat Pertanyaan</dt>
                        <dd>{{ $quote->sentence }}</dd>
                    </dl>
                    <table class="table table-bordered table-datatable">
                        <thead>
                            <th width="50px">No</th>
                            <th width="150px">Aksi</th>
                            <th width="100px">NIM</th>
                            <th>Nama</th>
                            <th width="150px">Accuracy Score</th>
                            <th width="150px">Fluency Score</th>
                            <th width="150px">Completeness Score</th>
                            <th width="150px">Pronunciation Score</th>
                        </thead>
                        <tbody>
                            @foreach ($quote->jawaban as $jawaban)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-block"
                                            onclick="playAudio('{{ url($jawaban->audio_path) }}')">
                                            <i class="fa fa-play"></i>
                                            Dengarkan</button>
                                    </td>
                                    <td>
                                        {{ $jawaban->mahasiswa->nim }}
                                    </td>
                                    <td>
                                        {{ $jawaban->mahasiswa->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $jawaban->accuracy }}
                                    </td>
                                    <td class="text-center">
                                        {{ $jawaban->fluency }}
                                    </td>
                                    <td class="text-center">
                                        {{ $jawaban->completeness }}
                                    </td>
                                    <td class="text-center">
                                        {{ $jawaban->pronunciation }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function playAudio(audioPath) {
                var audio = new Audio(audioPath);
                audio.play();
            }
        </script>
    @endpush
</x-app>
