<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Device;
use App\Models\Org;

class Devices extends Component
{
    public $devices, $device, $name, $serial, $type, $device_id, $note, $org_id, $orgs, $org, $defect, $reset;
    public $isOpen = 0;

    public function render()
    {
        $this->devices = Device::all();
        $this->orgs = Org::all();
        return view('devices.devices');
    }

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->note = '';
        $this->device_id = '';
        $this->serial = '';
        $this->type = '';
        $this->org_id = '';
        $this->reset = '';
        $this->defect = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'serial' => 'required',
        ]);


        /*DB::table('devices')->insert([
            ['serial' => 'mehul@example.com', 'name' => 'mehul@example.com','type' => 'Laptop', 'org_id' => 1],
        ]);*/

        Device::updateOrCreate(['id' => $this->device_id], [
            'name' => $this->name,
            'serial' => $this->serial,
            'type' => $this->type,
            'reset' => $this->reset,
            'defect' => $this->defect,
            'org_id' => $this->org_id,
            'note' => $this->note
        ]);

        //Device::where('id', $this->device_id)->update(['org_id' => $this->org_id]);
        //Device::where('id', $this->device_id)->update(['defect' => $this->defect]);
        //Device::where('id', $this->device_id)->update(['reset' => $this->reset]);
        //Device::where('id', $this->device_id)->update(['type' => $this->type]);

        /*$device = Device::find(1);
        $org = Org::find(1);

        $device->org();
        $device->save();*/

        session()->flash('message',
            $this->device_id ? 'Eintrag erfolgreich aktualisiert.' : 'Eintrag erfolgreich aktualisiert.');

        $this->closeModal();
        $this->resetInputFields();
        return redirect()->to('/device');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $device = Device::findOrFail($id);
        $this->device_id = $id;
        $this->name = $device->name;
        $this->serial = $device->serial;
        $this->type = $device->type;
        $this->note = $device->note;
        $this->org_id = $device->org_id;
        $this->defect = $device->defect;
        $this->reset = $device->reset;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Device::find($id)->delete();
        return redirect()->to('/device');
        session()->flash('message', 'Datensatz erfolgreich gelöscht.');
    }
}
