<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Person;
use App\Models\Org;

class Teachers extends Component
{
    public $teachers, $teacher, $teacher_id, $name, $forename, $street, $code, $location, $note, $school, $number, $email, $phone;
    public $isOpen = 0;

    public function render()
    {
        $this->teachers = Teacher::all();
        return view('teachers.teachers');
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
        $this->forename = '';
        $this->street = '';
        $this->code = '';
        $this->location = '';
        $this->school = '';
        $this->number = '';
        $this->phone = '';
        $this->email = '';
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
            'forename' => 'required',
        ]);


        /*DB::table('devices')->insert([
            ['serial' => 'mehul@example.com', 'name' => 'mehul@example.com','type' => 'Laptop', 'org_id' => 1],
        ]);*/

        Teacher::updateOrCreate(['id' => $this->teacher_id], [
            'name' => $this->name,
            'forename' => $this->forename,
            'street' => $this->street,
            'code' => $this->code,
            'location' => $this->location,
            'school' => $this->school,
            'number' => $this->number,
            'phone' => $this->phone,
            'email' => $this->email,
            'note' => $this->note
        ]);

        /*Device::where('id', $this->device_id)->update(['org_id' => $this->org_id]);
        Device::where('id', $this->device_id)->update(['defect' => $this->defect]);
        Device::where('id', $this->device_id)->update(['reset' => $this->reset]);*/

        /*$device = Device::find(1);
        $org = Org::find(1);

        $device->org();
        $device->save();*/
        return redirect()->to('/person');
        session()->flash('message',
            $this->teacher_id ? 'Eintrag erfolgreich aktualisiert.' : 'Eintrag erfolgreich aktualisiert.');
        $this->closeModal();
        $this->resetInputFields();



    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $this->teacher_id = $id;
        $this->name = $teacher->name;
        $this->forename = $teacher->forename;
        $this->street = $teacher->street;
        $this->code = $teacher->code;
        $this->location = $teacher->location;
        $this->school = $teacher->school;
        $this->number = $teacher->number;
        $this->phone = $teacher->phone;
        $this->email = $teacher->email;
        $this->note = $teacher->note;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Teacher::find($id)->delete();
        return redirect()->to('/person');
        session()->flash('message', 'Datensatz erfolgreich gelöscht.');
    }
}
