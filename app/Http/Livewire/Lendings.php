<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Device;
use App\Models\Org;
use App\Models\Teacher;
use App\Models\Lending;

class Lendings extends Component
{
    public $lendings, $orgs, $orgs2, $devices, $teachers, $lending_id, $teacher_id, $device_id, $org_id_2, $org_id_1, $lendingDate, $returnDate, $note;
    public $isOpen = 0;
    public $returnOpen = 0;

    public function render()
    {
        $this->lendings = Lending::all();
        $this->devices = Device::all();
        $this->orgs = Org::all();
        $this->orgs2 = Org::all();
        $this->teachers = Teacher::all();
        return view('lendings.lendings');
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
    public function openReturn()
    {
        $this->returnOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeReturn()
    {
        $this->returnOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->teacher_id = '';
        $this->lending_id = '';
        $this->note = '';
        $this->device_id = '';
        $this->org_id_1 = '';
        $this->org_id_2 = '';
        $this->lendingDate = '';
        $this->returnDate = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'device_id' => 'required',
            'teacher_id' => 'required',
            'org_id_1' => 'required',
            //'lendingDate' => 'required',
        ]);


        /*DB::table('devices')->insert([
            ['serial' => 'mehul@example.com', 'name' => 'mehul@example.com','type' => 'Laptop', 'org_id' => 1],
        ]);*/

        Lending::updateOrCreate(['id' => $this->lending_id], [
            'teacher_id' => $this->teacher_id,
            'device_id' => $this->device_id,
            'org_id_1' => $this->org_id_1,
            //'org_id_2' => $this->org_id_2,
            'lendingDate' => $this->lendingDate,
            //'returnDate' => $this->returnDate,
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
        return redirect()->to('/lending');
        session()->flash('message',
            $this->device_id ? 'Eintrag erfolgreich aktualisiert.' : 'Eintrag erfolgreich aktualisiert.');

        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function storeReturn()
    {
        $this->validate([
            //'device_id' => 'required',
            'returnDate' => 'required',
            'org_id_2' => 'required',
        ]);


        /*DB::table('devices')->insert([
            ['serial' => 'mehul@example.com', 'name' => 'mehul@example.com','type' => 'Laptop', 'org_id' => 1],
        ]);

        Lending::updateOrCreate(['id' => $this->lending_id], [
            //'teacher_id' => $this->teacher_id,
            //'device_id' => $this->device_id,
            //'org_id_1' => $this->org_id_1,
            'org_id_2' => $this->org_id_2,
            //'lendingDate' => $this->lendingDate,
            'returnDate' => $this->returnDate,
            'note' => $this->note
        ]);*/

        Lending::where('id', $this->lending_id)->update(['org_id_2' => $this->org_id_2]);
        Lending::where('id', $this->lending_id)->update(['returnDate' => $this->returnDate]);
        Lending::where('id', $this->lending_id)->update(['note' => $this->note]);
        //Device::where('id', $this->device_id)->update(['type' => $this->type]);

        /*$device = Device::find(1);
        $org = Org::find(1);

        $device->org();
        $device->save();*/
        //return redirect()->to('/lending');
        session()->flash('message',
            $this->device_id ? 'Eintrag erfolgreich aktualisiert.' : 'Eintrag erfolgreich aktualisiert.');

        $this->closeReturn();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $lending = Lending::findOrFail($id);
        $this->lending_id = $id;
        $this->teacher_id = $lending->teacher_id;
        $this->org_id_1 = $lending->org_id_1;
        $this->org_id_2 = $lending->org_id_2;
        $this->note = $lending->note;
        $this->device_id = $lending->device_id;
        $this->note = $lending->note;
        $this->lendingDate = $lending->lendingDate;
        $this->returnDate = $lending->returnDate;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function return($id)
    {
        $lending = Lending::findOrFail($id);
        $this->lending_id = $id;
        //$this->teacher_id = $lending->teacher_id;
        //$this->org_id_1 = $lending->org_id_1;
        $this->org_id_2 = $lending->org_id_2;
        //$this->note = $lending->note;
        //$this->device_id = $lending->device_id;
        $this->note = $lending->note;
        //$this->lendingDate = $lending->lendingDate;
        $this->returnDate = $lending->returnDate;
        $this->openReturn();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Lending::find($id)->delete();
        return redirect()->to('/lending');
        session()->flash('message', 'Datensatz erfolgreich gelöscht.');
    }
}
