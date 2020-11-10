<?php

namespace App\Http\Livewire;

use App\Models\Org;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Orgs;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OrgTables extends LivewireDatatable
{
    public $model = Org::class;
    public $orgs = Orgs::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            Column::name('name')->searchable()->label('Name'),
            Column::name('number')->searchable()->label('Nummer'),
            Column::name('street')->searchable()->label('Straße'),
            Column::name('code')->searchable()->label('PLZ'),
            Column::name('location')->searchable()->label('Ort'),
            Column::name('phone')->searchable()->label('Telefon'),
            Column::name('email')->truncate()->searchable()->label('E-Mail'),
            Column::name('note')->truncate()->searchable()->label('Notiz'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-edit', ['id' => $id, 'name' => $name]);
            })
        ];
    }

}
