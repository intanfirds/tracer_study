<table class="table table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Profesi</th>
            <th>Status</th>
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
                <td>{{ $item->detailProfesi->profesi ?? 'belum bekerja' }}</td>
                <td>{{ $item->instansi ? 'Telah Mengisi' : 'Belum Mengisi' }}</td>
                <td class="align-middle">
                    <a href="{{ url('/admin/detail', $item->alumni_id) }}" class="btn btn-light"><i class="fa fa-eye"></i></a>
                    <a href="{{ url('/admin/edit', $item->alumni_id) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                    <form action="{{ url('/admin/delete', $item->alumni_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data alumni.</td>
            </tr>
        @endforelse
    </tbody>
</table>
