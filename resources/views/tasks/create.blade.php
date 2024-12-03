<?php

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Crear Nueva Tarea</h1>
    
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700">Título</label>
            <input type="text" id="title" name="title" class="w-full p-2 border border-gray-300 rounded" value="{{ old('title') }}">
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descripción</label>
            <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Categoría</label>
            <select id="category_id" name="category_id" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Seleccionar Categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Tarea</button>
    </form>
</div>
@endsection
