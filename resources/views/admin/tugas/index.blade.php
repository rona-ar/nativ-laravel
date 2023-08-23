<x-app header="Tugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Tugas</div>
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
                            <th>Judul Film</th>
                            <th width="100px">Tahun Terbit</th>
                            <th width="150px">Jumlah Kutipan</th>
                        </thead>
                        <tbody>
                            @foreach ($list_tugas as $tugas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <x-table.action-button :item="$tugas" />
                                    </td>
                                    <td>{{ $tugas->title }}</td>
                                    <td>{{ $tugas->publication_year }}</td>
                                    <td>{{ $tugas->quote_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
