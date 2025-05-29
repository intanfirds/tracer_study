<table class="table table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($alumni as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->NIM }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->prodi->nama_prodi }}</td>
                <td>
                    <a href="{{ url('/admin/detail', $item->alumni_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{ url('/admin/edit', $item->alumni_id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                    <form action="{{ url('/admin/delete', $item->alumni_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data alumni.</td>
            </tr>
        @endforelse
    </tbody>
</table>
