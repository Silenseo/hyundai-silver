<?php

namespace App\Exports;

use App\Dealer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DealersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dealer::all();
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->address,
            $item->phone,
            $item->email,
            $item->code,
            $item->rc_code,
            $item->site,
            $item->latitude,
            $item->longitude,
            $item->visible == 1 ? '+' : '',
            $item->zyngaya,
            is_object($item->city) ? $item->city->name : '',
            is_object($item->city) ? $item->city->id : '',
            $item->special == 1 ? '+' : '',
            $item->wa == 1 ? '+' : '',
            $item->rating == 1 ? '+' : '',
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Название',
            'Адрес',
            'Телефон',
            'Email',
            'SAP-Код',
            'RC-Код',
            'Ссылка на сайт дилера',
            'Долгота',
            'Широта',
            'Видимость',
            'Телефон (Zyngaya)',
            'city_name',
            'city_id',
            'Дилер GDSI',
            'Дилер WA',
            'Рейтинговый дилер',
        ];
    }
}
