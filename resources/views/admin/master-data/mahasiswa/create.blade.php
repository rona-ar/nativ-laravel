<x-app header="Master Data/Mahasiswa">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Mahasiswa</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/master-data/mahasiswa') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">NIM</label>
                                    <input class="form-control" type="text" name="nim" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Angkatan</label>
                                    <input class="form-control" type="text" name="angkatan" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama</label>
                                    <input class="form-control" type="text" name="nama" id="">
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
