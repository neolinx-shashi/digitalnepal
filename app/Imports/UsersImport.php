<?php

namespace App\Imports;

use App\Model\Stb;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Stb([
            'stb_number' => $row[0],
            'stb_status' => $row[1]
        ]);
    }
}
