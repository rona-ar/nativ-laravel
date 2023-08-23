<x-app header="Tugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tugas</div>
                    <div class="float-right">
                        <a href="{{ url()->current() }}/edit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <dl>
                                <dt>Judul Buku</dt>
                                <dd>{{ $buku->title }}</dd>
                                <dt>Penulis</dt>
                                <dd>{{ $buku->author }}</dd>
                                <dt>Tahun Terbit</dt>
                                <dd>{{ $buku->publication_year }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-2 text-center">
                            @if ($buku->cover_image)
                                <img src="{{ url($buku->cover_image) }}" alt=""
                                    style="height: 200px; float:right">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-datatable">
                        <thead>
                            <th width="50px">No</th>
                            <th width="150px">Aksi</th>
                            <th>Kalimat</th>
                            <th width="100px">Dikerjakan</th>
                        </thead>
                        <tbody>
                            @foreach ($buku->quote as $quote)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('admin/pertanyaan', $quote->id) }}" class="btn btn-info">
                                                <i class="fa fa-info"></i>
                                            </a>
                                            @if ($quote->audio_path)
                                                <button class="btn btn-primary"
                                                    onclick="playAudio('{{ url($quote->audio_path) }}')"><i
                                                        class="fa fa-play"></i>
                                                    Dengarkan
                                                </button>
                                            @else
                                                <button class="btn btn-dark" disabled><i class="fa fa-play"></i>
                                                    Dengarkan
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ $quote->sentence }}
                                    </td>
                                    <td>
                                        {{ $quote->dikerjakan }}
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
