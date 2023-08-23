<x-app header="Master Data/Mahasiswa">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Dosen</div>
                    <div class="float-right">
                        <a href="{{ url()->current() }}/edit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>NIP</dt>
                        <dd>{{ $dosen->nip }}</dd>
                        <dt>Nama</dt>
                        <dd>{{ $dosen->nama }}</dd>
                        <dt>Gelar Depan</dt>
                        <dd>{{ $dosen->gelar_depan }}</dd>
                        <dt>Gelar Belakang</dt>
                        <dd>{{ $dosen->gelar_belakang }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app>
