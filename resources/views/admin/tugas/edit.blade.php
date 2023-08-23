<x-app header="Tugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tugas</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/tugas', $tugas->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Judul FIlm</label>
                                    <input class="form-control" type="text" value="{{ $tugas->title }}"
                                        name="title" id="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Tahun Rilis</label>
                                    <input class="form-control" type="text" value="{{ $tugas->publication_year }}"
                                        name="publication_year" id="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Cover Film</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                <i class="fa fa-folder-open"></i>
                                                <input type="file" name="cover_image" />
                                            </span>
                                        </span>
                                        <input value="" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pertanyaan_container">
                            @forelse ($tugas->quote as $pertanyaan)
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            @if ($loop->first)
                                                <label for="" class="control-label">
                                                    Kalimat
                                                    <button type="button" class="btn btn-xs btn-primary"
                                                        onclick="tambahFile()">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </label>
                                            @endif
                                            <div class="input-group">
                                                <input type="text" name="kalimat[{{ $pertanyaan->id }}]"
                                                    class="form-control" value="{{ $pertanyaan->sentence }}"
                                                    placeholder="Kalimat">
                                                @if ($pertanyaan->audio_path)
                                                    <div class="input-group-btn">
                                                        <a class="btn btn-info" target="_blank"
                                                            href="{{ url($pertanyaan->audio_path) }}">
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if ($loop->first)
                                                <label for="" class="control-label">Audio File</label>
                                            @endif
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        <i class="fa fa-folder-open"></i>
                                                        <input type="file"
                                                            name="file_audio[{{ $pertanyaan->id }}]" />
                                                    </span>
                                                </span>
                                                <input value="" readonly class="form-control">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-danger"
                                                        onclick="hapusRecord('{{ $pertanyaan->id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="" class="control-label">Kalimat</label>
                                            <input type="text" name="kalimat[{{ (int) (microtime(true) * 1000) }}]"
                                                class="form-control" placeholder="Kalimat">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="control-label">File Audio</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        <i class="fa fa-folder-open"></i>
                                                        <input type="file"
                                                            name="file_audio[{{ (int) (microtime(true) * 1000) }}]" />
                                                    </span>
                                                </span>
                                                <input value="" readonly class="form-control">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-info" onclick="tambahFile()">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function getTemplate() {
                time = Date.now();
                return `
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="kalimat[${time}]" class="form-control" placeholder="Kalimat">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <i class="fa fa-folder-open"></i>
                                    <input type="file" name="file_audio[${time}]" />
                                </span>
                            </span>
                            <input value="" readonly class="form-control">
                            <span class="input-group-btn">
                                <span class="btn btn-danger" onclick="hapusBukti(this)">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>`
            }

            function tambahFile() {
                template = getTemplate()
                $("#pertanyaan_container").append(template)
            }

            function hapusBukti(item) {
                $(item).parent().parent().parent().parent().parent().remove()
            }

            function hapusRecord(id) {
                Swal.fire({
                    title: 'Yakin Menghapus Data Ini?',
                    text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lanjutkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const url = `{{ url('admin/pertanyaan') }}/${id}`
                        const csrf_token = '{{ csrf_token() }}'
                        const template = `
                        <form method="post" action="${url}">
                            <input type="hidden" name="_token" value="${csrf_token}"/>
                            <input type="hidden" name="_method" value="delete"/>
                        </form>
                    `
                        $(template).appendTo('body').submit();
                    }
                })
            }
        </script>
    @endpush
</x-app>
