<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Mostrar una lista de tareas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::with('category')->get(); // Obtener todas las tareas con sus categorías
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Mostrar el formulario para crear una nueva tarea.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('tasks.create', compact('categories'));
    }

    /**
     * Almacenar una nueva tarea en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Mostrar el formulario para editar una tarea existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id); // Buscar la tarea o lanzar un error 404
        $categories = Category::all(); // Obtener todas las categorías
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Actualizar una tarea en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'completed' => 'boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Eliminar una tarea de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}

