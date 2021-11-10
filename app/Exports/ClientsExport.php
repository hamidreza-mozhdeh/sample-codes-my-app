<?php

namespace App\Exports;

use App\Models\Admin;
use App\Repository\ClientRepository;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ClientsExport implements FromQuery
{
    use Exportable;

    public Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function query()
    {
        return ClientRepository::fetchAllByAdmin($this->admin);
    }
}
