<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('admin.roles.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar que se cree bien el rol
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        //si pasa la validacion, crear el rol
        \Spatie\Permission\Models\Role::create(['name' => $request->name]);

        //variable de session para el mensaje de exito
        session()->flash('swal', 
            [
                'icon' => 'success',
                'title' => 'Rol creado exitosamente',
                'text' => 'El rol ha sido creado correctamente.',
            ]
        );

        //redireccionar a la vista de roles con un mensaje de exito
        return redirect()->route('admin.roles.index')->with('success', 'Rol created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
       
        return view('admin.roles.edit', compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //validar que se inserte bien el rol
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id, 
        ]);

        //si el campo no cambió, no actualices
        if($request->name === $role->name){
            Session()->flash('swal', 
            [
                'icon' => 'info',
                'title' => 'Sin cambios',
                'text' => 'No se realizaron cambios en el rol.',
            ]
            );
            return redirect()->route('admin.roles.edit', $role);
        } 

        if ($role->id <=4){
            //Variable de un solo uso
            session()->flash('swal', 
                [
                    'icon' => 'error',
                    'title' => 'Acción no permitida',
                    'text' => 'No se puede editar este rol predeterminado.',
                ]
            );
            return redirect()->route('admin.roles.index');
        }

        //si pasa la validacion, editara el rol
        $role->update(['name' => $request->name]);

        //variable de session para el mensaje de exito
        session()->flash('swal', 
            [
                'icon' => 'success',
                'title' => 'Rol actualizado exitosamente',
                'text' => 'El rol ha sido actualizado correctamente.',
            ]
        );

        //redireccionar a la vista de roles con un mensaje de exito
        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->id <=4){
            //Variable de un solo uso
            session()->flash('swal', 
                [
                    'icon' => 'error',
                    'title' => 'Acción no permitida',
                    'text' => 'No se puede eliminar este rol predeterminado.',
                ]
            );
            return redirect()->route('admin.roles.index'); 
        }

        $role->delete();

        //variable de session para el mensaje de exito
        session()->flash('swal', 
            [
                'icon' => 'success',
                'title' => 'Rol eliminado exitosamente',
                'text' => 'El rol ha sido eliminado correctamente.',
            ]
        );

        return redirect()->route('admin.roles.index');
    }
}
