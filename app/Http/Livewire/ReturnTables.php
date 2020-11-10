<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Lendings;
use App\Models\Lending;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Orgs;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ReturnTables extends LivewireDatatable
{
    public $model = Lending::class;

    public function builder()
    {
        return Lending::query()
            ->leftJoin('devices', 'devices.id', 'lendings.device_id')
            ->leftJoin('teachers', 'teachers.id', 'lendings.teacher_id')
            ->leftJoin('orgs', 'lendings.org_id_1', 'orgs.id')->whereNotNull('lendings.org_id_2');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            Column::name('devices.name')->truncate()->searchable()->label('Gerät'),
            Column::name('teacher.name')->truncate()->searchable()->label('Person'),
            Column::name('org_id_1')->truncate()->searchable()->label('Ausgeliehen von (MZ)'),
            DateColumn::name('lendingDate')->truncate()->searchable()->label('Ausgeliehen am'),
            Column::name('org_id_2')->truncate()->searchable()->label('Rückgabe an (MZ)'),
            DateColumn::name('returnDate')->truncate()->searchable()->label('Rückgabe am'),
            Column::name('note')->truncate()->searchable()->label('Notiz'),
            Column::callback(['id', 'note'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })
        ];
    }

}
