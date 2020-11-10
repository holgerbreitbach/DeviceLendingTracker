<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Org;

class Orgs extends Component
{
    public $orgs, $name, $number, $note, $org_id, $street, $code, $location, $phone, $email;
    public $isOpen = 0;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->orgs = Org::all();
        return view('livewire.orgs');
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
        $this->number = '';
        $this->note = '';
        $this->org_id = '';
        $this->street = '';
        $this->code = '';
        $this->location = '';
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
            'number' => 'required',
        ]);

        Org::updateOrCreate(['id' => $this->org_id], [
            'name' => $this->name,
            'number' => $this->number,
            'street' => $this->street,
            'code' => $this->code,
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'note' => $this->note
        ]);

        session()->flash('message',
            $this->org_id ? 'Eintrag erfolgreich aktualisiert.' : 'Eintrag erfolgreich aktualisiert.');

        $this->closeModal();
        $this->resetInputFields();
        $this->orgs = Org::all();
        return redirect()->to('/org');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $org = Org::findOrFail($id);
        $this->org_id = $id;
        $this->name = $org->name;
        $this->number = $org->number;
        $this->street = $org->street;
        $this->code = $org->code;
        $this->location = $org->location;
        $this->phone = $org->phone;
        $this->email = $org->email;
        $this->note = $org->note;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Org::find($id)->delete();
        return redirect()->to('/org');
        session()->flash('message', 'Datensatz erfolgreich gelöscht.');
    }

}
