<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Geräteverwaltung
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
            <button wire:click="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 mb-8 rounded my-3">Neues Gerät erstellen</button>
                @if($isOpen)
                    @include('devices.create')
                @endif
            <table class="table-fixed w-full text-xs"  style="display: none;">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Seriennummer</th>
                    <th class="px-4 py-2">Typ</th>
                    <th class="px-4 py-2">Zurückgesetzt</th>
                    <th class="px-4 py-2">Defekt</th>
                    <th class="px-4 py-2">Medienzenter</th>
                    <th class="px-4 py-2">Notiz</th>
                    <th class="px-4 py-2">Aktion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($devices as $device)
                    <tr>
                        <td class="border px-4 py-2">{{ $device->id }}</td>
                        <td class="border px-4 py-2">{{ $device->name }}</td>
                        <td class="border px-4 py-2">{{ $device->serial }}</td>
                        <td class="border px-4 py-2">{{ $device->type }}</td>
                        <td class="border px-4 py-2">
                            @if ($device->reset === 0)
                                Nein
                                @else
                                Ja
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if ($device->defect === 0)
                                Nein
                            @else
                                Ja
                            @endif
                        </td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2">{{ $device->note }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $device->id }})" id="ButtonEdit{{ $device->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Bearbeiten</button>
                            <!--<button wire:click="delete({{ $device->id }})" id="ButtonDelete{{ $device->id }}"class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Löschen</button>-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <livewire:device-tables
                    model="App\Models\Device"
                    sort="id|asc"
                    hideable="select"
                    exportable
                />
        </div>
    </div>
</div>
</div>
