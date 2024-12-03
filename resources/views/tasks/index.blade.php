<?php

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold">Lista de Tareas</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear nueva tarea</a>
        <table class="min-w-full mt-4 border-collapse">
            <thead>
                <tr>
                    <th class="border-b py-2 px-4">Título</th>
                    <th class="border-b py-2 px-4">Categoría</th>
                    <th class="border-b py-2 px-4">Estado</th>
                    <th class="border-b py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td class="border-b py-2 px-4">{{ $task->title }}</td>
                        <td class="border-b py-2 px-4">{{ $task->category->name }}</td>
                        <td class="border-b py-2 px-4">{{ $task->completed ? 'Completada' : 'Pendiente' }}</td>
                        <td class="border-b py-2 px-4">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500">Editar</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="text-red-500">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
