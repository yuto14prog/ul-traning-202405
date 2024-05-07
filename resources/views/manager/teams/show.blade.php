<x-layout>
    <x-slot name="title">Team: (id:{{ $team->id }})</x-slot>
    <h2>{{ $team->name }}(id:{{ $team->id }})</h2>
    <div class="mb-3">
        <div class="text-end mb-2">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">編集</a>
        </div>  
    </div>
</x-layout>
