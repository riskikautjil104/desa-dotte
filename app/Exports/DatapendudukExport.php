<?php

namespace App\Exports;

use App\Models\Datapenduduk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DatapendudukExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Datapenduduk::query();
    }

    public function map($datapenduduk): array
    {
        return [
            $datapenduduk->rt->nama_rt,
            $datapenduduk->rw->nama_rw,
            $datapenduduk->nama,
            $datapenduduk->nik,
            $datapenduduk->alamat,
            $datapenduduk->no_kk,
            $datapenduduk->nama_kepala_keluarga,
            $datapenduduk->jenis_kelamin,
            $datapenduduk->hubungan,
            $datapenduduk->tempat_lahir,
            $datapenduduk->tanggal_lahir,
            $datapenduduk->usia,
            $datapenduduk->status,
            $datapenduduk->agama,
            $datapenduduk->golongan_darah,
            $datapenduduk->kewarganegaraan,
            $datapenduduk->suku,
            $datapenduduk->pekerjaan->nama_pekerjaan,
            $datapenduduk->pendidikan->nama_pendidikan,
        ];
    }

    public function headings(): array
    {
        return [
            'Rt',
            'Rt',
            'Nama',
            'Nik',
            'Alamat',
            'Nomor Kartu Keluarga',
            'Nama Kepala Keluarga',
            'Jenis Kelamin',
            'Hubungan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Usia',
            'Status',
            'Agama',
            'Golongan Darah',
            'Kewarganegaraan',
            'Suku',
            'Pekerjaan',
            'Pendidikan',
        ];
    }
}
