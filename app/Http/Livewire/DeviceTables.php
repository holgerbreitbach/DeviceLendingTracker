<?php

namespace App\Http\Livewire;

use App\Models\Device;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Devices;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DeviceTables extends LivewireDatatable
{
    public $model = Device::class;

    public function builder()
    {
        return Device::query()
            ->leftJoin('orgs', 'orgs.id', 'devices.org_id');
    }

        public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            Column::name('name')->searchable()->label('Name'),
            Column::name('serial')->searchable()->label('Seriennr.'),
            Column::name('type')->searchable()->label('Typ'),
            BooleanColumn::name('reset')->searchable()->label('Reset'),
            BooleanColumn::name('defect')->searchable()->label('Defekt'),
            Column::name('orgs.name')->searchable()->label('MZ'),
            Column::name('note')->truncate()->searchable()->label('note'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-edit', ['id' => $id, 'name' => $name]);
            })
        ];
    }

    public function getDevicesProperty()
    {
        return Org::pluck('name');
    }

}
