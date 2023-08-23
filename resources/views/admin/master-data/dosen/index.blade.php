<x-app header="Master Data / Dosen">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Dosen</div>
                    <div class="float-right">
                        <a href="{{ url()->current() }}/create" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-datatable">
                        <thead>
                            <th width="50px">No</th>
                            <th width="50px">Aksi</th>
                            <th>NIP</th>
                            <th>Nama</th>
                        </thead>
                        <tbody>
                            @foreach ($list_dosen as $dosen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <x-table.action-button :item="$dosen" />
                                    </td>
                                    <td>{{ $dosen->nip }}</td>
                                    <td>{{ $dosen->nama_gelar }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
