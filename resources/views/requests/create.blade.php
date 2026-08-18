@extends('requests.layout')

@section('content')
    <h2>Registrar Nueva Solicitud</h2>

    <form action="{{ route('requests.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Categoría</label>
            <select name="category_id" id="category_id" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="status">Estado</label>
            <select name="status" id="status" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resuelto</option>
            </select>
            @error('status') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn">Guardar Solicitud</button>
        <a href="{{ route('requests.index') }}" class="btn" style="background: #6c757d;">Cancelar</a>
    </form>
@endsection