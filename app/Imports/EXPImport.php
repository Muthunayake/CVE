<?php

namespace App\Imports;

use App\EXP;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EXPImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EXP([
            'exploit' => $row['exploit'],
            'cve_id' => $row['cve_id'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
