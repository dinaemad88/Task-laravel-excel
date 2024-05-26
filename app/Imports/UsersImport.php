<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class UsersImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function map(array $row): array
    {
        return [
            'full_name' => $row['full_name'] ?? $row[' Name'] ?? null,
            'phone_number' => $row['phone_number'] ?? $row['Phone '] ?? null,
            'email' => $row['email'] ?? $row['Email'] ?? null,
        ];
    }

    public function model(array $row)
    {
        return new User($this->map($row));
    }
}
