<div class="title" style="padding-bottom: 13px">
    <div style="text-align: center;text-transform: uppercase;font-size: 15px">
        @if($dateStart && $dateEnd)
            Izin Keluar Per ({{ \Carbon\Carbon::parse($dateStart)->locale('id')->translatedFormat('l, d F Y') }} - {{ \Carbon\Carbon::parse($dateEnd)->locale('id')->translatedFormat('l, d F Y') }})
        @else
            Izin Keluar
        @endif
    </div>
</div>
<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">No</th>
            <th scope="col">Kode Izin</th>
            <th scope="col">Waktu Izin</th>
            <th scope="col">Waktu Kembali</th>
            <th scope="col">Keperluan</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Kembali</th>
            <th scope="col">Yang Membuat</th>
            <th scope="col">Dibuat Pada</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($izinKeluar as $izin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $izin->kode_izin }}</td>
            <td>{{ $izin->waktu_izin }}</td>
            <td>{{ $izin->waktu_kembali }}</td>
            <td>{{ $izin->keperluan }}</td>
            <td>{{ $izin->keterangan }}</td>
            <td>
                @if($izin->kembali)
                    <p> Kembali </p>
                @else
                    <p> Tidak Kembali </p>
                @endif
            </td>
            <td>
                {{ $izin->pengguna_buat_izin->nama }}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($izin->create_date)->locale('id')->translatedFormat('l, d F Y') }}
            </td>
            <td>
                @if($izin->status === 'T1')
                    <p>Approve Keluar (HRGA)</p>
                @elseif($izin->status === 'T2')
                    <p>Approve Keluar (Satpam)</p>
                @elseif($izin->status === 'T3')
                    <p>Approve Masuk (Satpam)</p>
                @elseif($izin->status === 'A')
                    <p>Aktif</p>
                @elseif($izin->status=== 'C')
                    <p>Selesai</p>
                @else
                    <p>Status Tidak Ditemukan</p>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
