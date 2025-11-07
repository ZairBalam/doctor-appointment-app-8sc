<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function edit(string $id)
    {
        $role = \Spatie\Permission\Models\Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
