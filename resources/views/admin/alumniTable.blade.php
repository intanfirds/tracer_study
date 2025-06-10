<!-- CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .alumni-table {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .alumni-table thead th {
        background-color: #2c3e50;
        color: white;
        font-weight: 600;
        vertical-align: middle;
    }

    .alumni-table tbody tr:hover {
        background-color: rgba(44, 62, 80, 0.05);
    }

    .status-badge {
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-filled {
        background-color: #28a745;
        color: white;
    }

    .badge-empty {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-not-working {
        background-color: #6c757d;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-view {
        background-color: #17a2b8;
        color: white;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_filter input {
        font-size: 0.9rem;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 4px;
        padding: 2px 8px;
    }
</style>

<div class="card border-0 shadow-lg">
    <div class="card-body px-0 py-2">
        <div class="table-responsive px-3">
            <table id="alumniTable" class="table alumni-table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>NIM</th>
                        <th>Nama Alumni</th>
                        <th>Program Studi</th>
                        <th>Profesi</th>
                        <th width="12%">Status Data</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumni as $index => $item)
                        <tr>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            <td><span class="badge bg-light text-dark">{{ $item->NIM }}</span></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->prodi->nama_prodi }}</td>
                            <td>
                                @if ($item->detailProfesi->isNotEmpty())
                                    @if ($item->detailProfesi->first()->kategori_id == 3)
                                        <span class="status-badge badge-not-working">
                                            <i class="fas fa-user-clock me-1"></i> Belum bekerja
                                        </span>
                                    @else
                                        <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                            {{ $item->detailProfesi->first()->profesi ?? '-' }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->detailProfesi->isNotEmpty())
                                    <span class="status-badge badge-filled">
                                        <i class="fas fa-check-circle me-1"></i> Lengkap
                                    </span>
                                @else
                                    <span class="status-badge badge-empty">
                                        <i class="fas fa-exclamation-circle me-1"></i> Belum
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ url('/admin/detail', $item->alumni_id) }}" class="action-btn btn-view"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Alumni">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('/admin/edit', $item->alumni_id) }}" class="action-btn btn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ url('/admin/delete', $item->alumni_id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete border-0"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#alumniTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            initComplete: function() {
                // Initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                });
            },
            columnDefs: [{
                    orderable: false,
                    targets: [0, 6]
                },
                {
                    searchable: false,
                    targets: [0, 5, 6]
                }
            ],
            drawCallback: function() {
                // Re-init tooltips after table redraw
                $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip({
                    trigger: 'hover'
                });
            }
        });
    });
</script>
