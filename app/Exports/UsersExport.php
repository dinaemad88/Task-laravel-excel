<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->full_name,
            $user->phone_number,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Phone Number',
            'Email',
        ];
    }
}
