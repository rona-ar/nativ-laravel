<x-app header="Master Data / Mahasiswa">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Master Data Pengguna</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-datatable">
                        <thead>
                            <th width="50px">No</th>
                            <th width="50px">Aksi</th>
                            <th>Username</th>
                            <th>Nama</th>
                        </thead>
                        <tbody>
                            @foreach ($list_mahasiswa as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <x-table.action-button :item="$mahasiswa" />
                                    </td>
                                    <td>{{ $mahasiswa->username }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
