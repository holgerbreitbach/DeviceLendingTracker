<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Medienzentrenverwaltung
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 mb-8 rounded my-3">Neues Medienzentrum erstellen</button>
                @if($isOpen)
                    @include('livewire.create')
                @endif

            <table class="table-fixed w-full text-xs" style="display: none;">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Nummer</th>
                    <th class="px-4 py-2">Straße</th>
                    <th class="px-4 py-2">PLZ</th>
                    <th class="px-4 py-2">Ort</th>
                    <th class="px-4 py-2">Telefon</th>
                    <th class="px-4 py-2">E-Mail</th>
                    <th class="px-4 py-2">Notiz</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orgs as $org)
                    <tr>
                        <td class="border px-4 py-2">{{ $org->id }}</td>
                        <td class="border px-4 py-2">{{ $org->name }}</td>
                        <td class="border px-4 py-2">{{ $org->number }}</td>
                        <td class="border px-4 py-2">{{ $org->street }}</td>
                        <td class="border px-4 py-2">{{ $org->code }}</td>
                        <td class="border px-4 py-2">{{ $org->location }}</td>
                        <td class="border px-4 py-2">{{ $org->phone }}</td>
                        <td class="border px-4 py-2">{{ $org->email }}</td>
                        <td class="border px-4 py-2">{{ $org->note }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $org->id }})" id="ButtonEdit{{ $org->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Bearbeiten</button>
                            <!--<button wire:click="delete({{ $org->id }})" id="ButtonDelete{{ $org->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Löschen</button>-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <livewire:org-tables
                model="App\Models\Org"
                sort="id|asc"
                hideable="select"
                exportable
            />
</div>
</div>
</div>
</div>
