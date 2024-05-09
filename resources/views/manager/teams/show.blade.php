<x-layout>
    <x-slot name="title">Team: (id:{{ $team->id }})</x-slot>
    <h2>{{ $team->name }}(id:{{ $team->id }})</h2>
    <div class="mb-3">
        <div class="text-end mb-2">
            <a href="{{ route('manager.teams.edit', $team) }}" class="btn btn-primary">編集</a>
        </div>  
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">タスクID</th>
                <th scope="col">タイトル</th>
                <th scope="col">作成日時</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <th scope="row">{{ $task->title }}</th>
                    <th scope="row">{{ $task->created_at }}</th>
                    <td><a href="">dummy</a></td>
                    {{-- <td><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}</a></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
