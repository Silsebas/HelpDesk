@extends('requests.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Listado de Solicitudes</h2>
        <a href="{{ route('requests.create') }}" class="btn">Nueva Solicitud</a>
    </div>

    <form method="GET" action="{{ route('requests.index') }}" class="filters">
        <select name="category_id">
            <option value="">Todas las categorías</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Todos los estados</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resuelto</option>
        </select>

        <button type="submit" class="btn">Filtrar</button>
        <a href="{{ route('requests.index') }}" class="btn" style="background: #6c757d;">Limpiar</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
                <tr>
                    <td>{{ $req->id }}</td>
                    <td>{{ $req->title }}</td>
                    <td>{{ $req->category->name }}</td>
                    <td>
                        @if($req->status == 'pending') Pendiente
                        @elseif($req->status == 'in_progress') En Progreso
                        @else Resuelto
                        @endif
                    </td>
                    <td>{{ $req->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('requests.edit', $req->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('requests.destroy', $req->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No hay solicitudes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection