<x-layout>
    <x-slot name="title">Members</x-slot>
    <h2><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}</a>/メンバー管理</h2>

    <div class="text-end mb-2">
        <a href="{{ route('manager.teams.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">役割</th>
                <th scope="col">名前</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <th scope="row">
                        @if ($member->role === 0)
                            通常
                        @else
                            マネージャー
                        @endif
                    </th>
                    <td>{{ $member->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
