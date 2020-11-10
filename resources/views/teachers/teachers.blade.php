<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Personenverwaltung
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
            <button wire:click="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 mb-8 rounded my-3">Neue Person erstellen</button>
            @if($isOpen)
                @include('teachers.create')
            @endif
            <table class="table-fixed w-full text-xs" style="display:none">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Vorname</th>
                    <th class="px-4 py-2">Straße</th>
                    <th class="px-4 py-2">PLZ</th>
                    <th class="px-4 py-2">Ort</th>
                    <th class="px-4 py-2">Telefon</th>
                    <th class="px-4 py-2">E-Mail</th>
                    <th class="px-4 py-2">Schulnr.</th>
                    <th class="px-4 py-2">Personalnr.</th>
                    <th class="px-4 py-2">Notiz</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td class="border px-4 py-2">{{ $teacher->id }}</td>
                        <td class="border px-4 py-2">{{ $teacher->name }}</td>
                        <td class="border px-4 py-2">{{ $teacher->forename }}</td>
                        <td class="border px-4 py-2">{{ $teacher->street }}</td>
                        <td class="border px-4 py-2">{{ $teacher->code }}</td>
                        <td class="border px-4 py-2">{{ $teacher->location }}</td>
                        <td class="border px-4 py-2">{{ $teacher->phone }}</td>
                        <td class="border px-4 py-2">{{ $teacher->email }}</td>
                        <td class="border px-4 py-2">{{ $teacher->school }}</td>
                        <td class="border px-4 py-2">{{ $teacher->number }}</td>
                        <td class="border px-4 py-2">{{ $teacher->note }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $teacher->id }})" id="ButtonEdit{{ $teacher->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Bearbeiten</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <livewire:teacher-tables
                    model="App\Models\Teacher"
                    sort="name|asc"
                    hideable="select"
                    exportable
                />
        </div>
    </div>
</div>
</div>
