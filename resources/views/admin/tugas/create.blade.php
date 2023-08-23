<x-app header="Tugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tugas</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/tugas') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Judul FIlm</label>
                                    <input class="form-control" type="text" name="title" id="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Tahun Rilis</label>
                                    <input class="form-control" type="text" name="publication_year" id="">
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
        </script>
    @endpush
</x-app>
