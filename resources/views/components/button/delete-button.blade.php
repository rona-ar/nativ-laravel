<button class="btn btn-danger" onclick="showConfirmDelete('{{ $id }}')">
    <i class="fa fa-trash"></i>
</button>

@once
    <script>
        const showConfirmDelete = id => {
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
                    const url = `{{ url()->current() }}/${id}`
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
@endonce
