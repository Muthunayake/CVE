<?php

namespace App\Imports;

use App\ScanData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ScanDataImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ScanData([
            'ip_address' => $row['ip_address'],
            'host_name_fdqn' => $row['host_name_fdqn'],
            'vuln_name' => $row['vuln_name'],
            'severity' => $row['severity'],
            'protocol' => $row['protocol'],
            'port' => $row['port'],
            'vulnerability' => $row['vulnerability'],
            'solution' => $row['solution'],
            'cvssv3_score' => is_numeric($row['cvssv3_score']) ? $row['cvssv3_score'] : 0,
            'cve_id' => $row['cve_id'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
