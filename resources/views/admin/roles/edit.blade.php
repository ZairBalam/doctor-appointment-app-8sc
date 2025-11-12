<x-admin-layout title="Roles | Dr.Stone" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">
   <x-wire-card>
   <form action="{{route('admin.roles.update', $role)}}" method="POST">
        @csrf
        @method('PUT') 
        <x-wire-input name="name" label="Nombre del Rol" placeholder="Ingrese el nombre del rol" value="{{ old('name', $role->name) }}">
           
        </x-wire-input>
        <div class="flex justify-end">
             <x-wire-button type="submit" class="mt-4" blue>Actualizar</x-wire-button>
        </div>
   </form>

</x-wire-card>
</x-admin-layout>