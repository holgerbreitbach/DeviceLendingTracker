<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Teachers;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Orgs;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TeacherTables extends LivewireDatatable
{
    public $model = Org::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            Column::name('name')->searchable()->label('Name'),
            Column::name('forename')->searchable()->label('Vorname'),
            Column::name('street')->searchable()->label('Straße'),
            Column::name('code')->searchable()->label('PLZ'),
            Column::name('location')->searchable()->label('Ort'),
            Column::name('phone')->searchable()->label('Telefon'),
            Column::name('email')->truncate()->searchable()->label('E-Mail'),
            Column::name('school')->searchable()->label('Schulnr.'),
            Column::name('number')->searchable()->label('Personalnr.'),
            Column::name('note')->truncate()->searchable()->label('Notiz'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-edit', ['id' => $id, 'name' => $name]);
            })
        ];
    }

}
