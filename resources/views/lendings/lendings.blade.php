<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ausleihe
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
            <button wire:click="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 mb-8 rounded my-3">Neuen Ausleihvorgang erstellen</button>
                @if($isOpen)
                    @include('lendings.create')
                @endif
                @if($returnOpen)
                    @include('lendings.return')
                @endif
            <table class="table-fixed w-full text-xs" style="display:none">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">#</th>
                    <th class="px-4 py-2">Gerät</th>
                    <th class="px-4 py-2">Ausleihender</th>
                    <th class="px-4 py-2">Ausgeliehen von</th>
                    <th class="px-4 py-2">Ausgeliehen am</th>
                    <th class="px-4 py-2">Rückgabe an</th>
                    <th class="px-4 py-2">Rückgabe am</th>
                    <th class="px-4 py-2">Notiz</th>
                    <th class="px-4 py-2">Aktion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lendings as $lending)
                    <tr>
                        <td class="border px-4 py-2">{{ $lending->id }}</td>
                        <td class="border px-4 py-2">{{ $devices->find($lending->device_id)->name }}</td>
                        <td class="border px-4 py-2">{{ $teachers->find($lending->teacher_id)->forename }} {{ $teachers->find($lending->teacher_id)->name }}, {{ $teachers->find($lending->teacher_id)->location }}</td>
                        <td class="border px-4 py-2">{{ $orgs->find($lending->org_id_1)->name }}, {{ $orgs->find($lending->org_id_1)->code }} {{ $orgs->find($lending->org_id_1)->location }}</td>
                        <td class="border px-4 py-2">{{ $lending->lendingDate }}</td>
                        <td class="border px-4 py-2">@if($lending->org_id_2 >0)
                                                        {{ $orgs->find($lending->org_id_2)->name }}, {{ $orgs->find($lending->org_id_2)->code }} {{ $orgs->find($lending->org_id_2)->location }}
                        @endif</td>
                        <td class="border px-4 py-2">{{ $lending->returnDate }}</td>
                        <td class="border px-4 py-2">{{ $lending->note }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="return({{ $lending->id }})" Id="ButtonEdit{{ $lending->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Rückgabe</button>
                            <button wire:click="delete({{ $lending->id }})" Id="ButtonDelete{{ $lending->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Löschen</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <p class="mb-4 text-lg"><h1>Aktive Vorgänge:</h1></p>
                <livewire:lending-tables
                    model="App\Models\Lending"
                    sort="lendingDate|desc"
                    hideable="select"
                    exportable
                />

                <p class="mt-10 mb-4" text-lg><h1>Abgeschlossene Vorgänge:</h1></p>
                <livewire:return-tables
                    model="App\Models\Lending"
                    sort="id|asc"
                    hideable="select"
                    exportable
                />
        </div>
    </div>
</div>
</div>
