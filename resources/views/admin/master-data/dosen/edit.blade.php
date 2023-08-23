<x-app header="Master Data/Dosen">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Dosen</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/master-data/dosen', $dosen->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">NIP</label>
                                    <input class="form-control" type="text" name="nip"
                                        value="{{ $dosen->nip }}" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama</label>
                                    <input class="form-control" type="text" name="nama"
                                        value="{{ $dosen->nama }}" id="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Gelar Depan</label>
                                    <input class="form-control" type="text" name="gelar_depan"
                                        value="{{ $dosen->gelar_depan }}" id="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Gelar Belakang</label>
                                    <input class="form-control" type="text" name="gelar_belakang"
                                        value="{{ $dosen->gelar_belakang }}" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
