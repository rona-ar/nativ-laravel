<x-app header="Master Data/Mahasiswa">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Mahasiswa</div>
                    <div class="float-right">
                        <a href="{{ url()->current() }}/edit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>Username</dt>
                        <dd>{{ $mahasiswa->username }}</dd>
                        <dt>Nama</dt>
                        <dd>{{ $mahasiswa->nama }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app>
