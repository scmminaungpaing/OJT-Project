<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('role')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Role',
            'Phone',
            'Dob',
            'Address',
            'Created_At'
        ];
    }
    
    public function map($user): array
    {
        return [
            $user -> name,
            $user -> email,
            $user -> role->name,
            $user -> phone,
            $user -> dob,
            $user -> address,
            $user -> created_at
        ];
    } 
}
