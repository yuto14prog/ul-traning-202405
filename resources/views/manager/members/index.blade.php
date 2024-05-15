<x-layout>
    <x-slot name="title">Members</x-slot>
    <h2>
        <a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}(id:{{ $team->id }})</a>
        /メンバー管理
    </h2>

    <div class="text-end mb-2">
        <form action="{{ route('manager.teams.members.store', $team) }}" method="post">
            @csrf
            <label for="user_id">新規メンバー追加</label>
            <select name="user_id" id="user_id">
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>
            <input type="submit" value="追加" class="btn btn-primary">
        </form>
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
<<<<<<< HEAD
                    <td>{{ $member->name }}</td>
=======
                    <td>{{ $member->user->name }}</td>
>>>>>>> main
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
