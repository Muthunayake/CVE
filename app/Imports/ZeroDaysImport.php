<?php

namespace App\Imports;

use App\ZeroDay;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ZeroDaysImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ZeroDay([
            'cve_id' => $row['cve_id'],
            'affected_vendor' => $row['affected_vendor'],
            'vulnerability' => $row['vulnerability'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
