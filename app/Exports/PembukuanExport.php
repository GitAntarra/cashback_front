<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PembukuanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(Request)
    {
        $data_pembukuan = $this->HttpRequest("GET","/redeemers?page=".$page."&take=".$take."&bookstatus=".$status, null)->json();

        return $data_pembukuan
    }
}
