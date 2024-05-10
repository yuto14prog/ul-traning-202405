<x-layout>
    <x-slot name="title">Users</x-slot>
    <h2>チーム管理</h2>

    <div class="text-end mb-2">
        <a href="{{ route('manager.team.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <th scope="row">{{ $team->id }}</th>
                    <td><a href="{{ route('manager.team.show', $team) }}">{{ $team->name }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
