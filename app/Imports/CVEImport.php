<?php

namespace App\Imports;

use App\CVE;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CVEImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CVE([
            'severity_v2' => $row['severity_v2'],
            'severity_v3' => $row['severity_v3'],
            'type' => $row['type'],
            'title' => $row['title'],
            'cve' => $row['cve'],
            'cvss_v2' => is_numeric($row['cvss_v2']) ? $row['cvss_v2'] : 0,
            'cvss_v3' => is_numeric($row['cvss_v3']) ? $row['cvss_v3'] : 0,
            'cwe_id' => $row['cwe_id'],
            'cwe_label' => $row['cwe_label'],
            'affected_vendors' => $row['affected_vendors'],
            'affected_cpes' => $row['affected_cpes'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
