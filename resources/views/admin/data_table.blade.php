<h4 class="fw-bold mb-4">Tabel Sebaran Lingkup Tempat Kerja dan Kesesuaian Profesi dengan Infokom</h4>
<table class="table table-sm table-bordered text-center align-middle mb-1">
    <thead class="table-light text-dark">
        <tr class="fw-bold">
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Tahun Lulus</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan <br>yang Terlacak</th>
            <th colspan="2" class="bg-dark text-white py-1">Profesi Kerja/Perguruan Tinggi</th>
            <th colspan="3" class="bg-dark text-white py-1">Lingkup Tempat Kerja</th>
        </tr>
        <tr class="fw-bold">
            <th class="bg-info text-white py-1 px-1">Bidang Infokom</th>
            <th class="bg-info text-white py-1 px-1">Non Infokom</th>
            <th class="bg-warning text-dark py-1 px-1">Multinasional</th>
            <th class="bg-warning text-dark py-1 px-1">Nasional</th>
            <th class="bg-warning text-dark py-1 px-1">Wirausaha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tabel1 as $data)
        <tr>
            <td class="py-1 px-2">{{ $data->tahun_lulus }}</td>
            <td class="py-1 px-2">{{ $data->jumlah_lulusan }}</td>
            <td class="py-1 px-2">{{ $data->terlacak }}</td>
            <td class="py-1 px-1">{{ $data->bidang_infokom }}</td>
            <td class="py-1 px-1">{{ $data->bidang_non_infokom }}</td>
            <td class="py-1 px-1">{{ $data->multinasional }}</td>
            <td class="py-1 px-1">{{ $data->nasional }}</td>
            <td class="py-1 px-1">{{ $data->wirausaha }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="table-secondary fw-semibold">
        <tr>
            <td class="py-1 px-2">Jumlah</td>
            <td class="py-1 px-2">{{ $tabel1->sum('jumlah_lulusan') }}</td>
            <td class="py-1 px-2">{{ $tabel1->sum('terlacak') }}</td>
            <td class="py-1 px-1">{{ $tabel1->sum('bidang_infokom') }}</td>
            <td class="py-1 px-1">{{ $tabel1->sum('bidang_non_infokom') }}</td>
            <td class="py-1 px-1">{{ $tabel1->sum('multinasional') }}</td>
            <td class="py-1 px-1">{{ $tabel1->sum('nasional') }}</td>
            <td class="py-1 px-1">{{ $tabel1->sum('wirausaha') }}</td>
        </tr>
    </tfoot>
</table>
<br>
<h4 class="fw-bold mb-4">Tabel Rata - Rata Masa Tunggu</h4>
<table class="table table-sm table-bordered text-center align-middle mb-1">
    <thead class="table-light text-dark">
        <tr class="fw-bold">
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Tahun Lulus</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan yang Terlacak</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Rata - Rata Masa Tunggu(Bulan)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tabel1 as $data)
        <tr>
            <td class="py-1 px-2">{{ $data->tahun_lulus }}</td>
            <td class="py-1 px-2">{{ $data->jumlah_lulusan }}</td>
            <td class="py-1 px-2">{{ $data->terlacak }}</td>
            <td class="py-1 px-2">{{ $data->rata_masa_tunggu ?? 'Belum ada yang mengisi'}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="table-secondary fw-semibold">
        <tr>
            <td class="py-1 px-2">Jumlah</td>
            <td class="py-1 px-2">{{ $tabel1->sum('jumlah_lulusan') }}</td>
            <td class="py-1 px-2">{{ $tabel1->sum('terlacak') }}</td>
            <td class="py-1 px-2">{{ number_format($tabel1->avg('rata_masa_tunggu'), 1) ?? 'Belum ada data' }} </td>
        </tr>
    </tfoot>
</table>
<br>
<h4 class="fw-bold mb-4">Tabel Survey Kepuasan</h4>
<table class="table table-sm table-bordered text-center align-middle mb-1">
    <thead class="table-light text-dark">
        <tr class="fw-bold">
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">No</th>
            <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jenis Kemampuan</th>
            <th colspan="4" class="bg-dark text-white py-1">Tingkat Kepuasan Pengguna (%)</th>
        </tr>
        <tr>
            <th class="bg-warning text-dark py-1 px-1">Sangat Baik</th>
            <th class="bg-warning text-dark py-1 px-1">Baik</th>
            <th class="bg-warning text-dark py-1 px-1">Cukup</th>
            <th class="bg-warning text-dark py-1 px-1">Kurang</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach([
            'Kerjasama Tim' => 'kerjasama_tim',
            'Keahlian di Bidang TI' => 'keahlian_bidang_it',
            'Kemampuan Bahasa Asing' => 'kemampuan_berbahasa_asing',
            'Kemampuan Berkomunikasi' => 'kemampuan_berkomunikasi',
            'Pengembangan Diri' => 'pengembangan_diri',
            'Kepemimpinan' => 'kepemimpinan',
            'Etos Kerja' => 'etos_kerja'
        ] as $label => $field)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $label }}</td>
            <td>{{ $kepuasan[$field]['Sangat Baik'] ?? 0 }}%</td>
            <td>{{ $kepuasan[$field]['Baik'] ?? 0 }}%</td>
            <td>{{ $kepuasan[$field]['Cukup'] ?? 0 }}%</td>
            <td>{{ $kepuasan[$field]['Kurang'] ?? 0 }}%</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="table-secondary fw-semibold">
        <tr>
            <td colspan="2">Rata-rata</td>
            <td>{{ $total['Sangat Baik'] ?? 0 }}%</td>
            <td>{{ $total['Baik'] ?? 0 }}%</td>
            <td>{{ $total['Cukup'] ?? 0 }}%</td>
            <td>{{ $total['Kurang'] ?? 0 }}%</td>
        </tr>
        <tr>
            <td colspan="6" class="text-end">
                <small>Total Responden: {{ $totalResponden ?? 0 }} orang</small>
            </td>
        </tr>
    </tfoot>
</table>
