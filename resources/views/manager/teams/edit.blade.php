<x-layout>
    <x-slot name="title">Team/edit</x-slot>
    <h2>{{ $team->name }}編集</h2>
    <x-mini-panel>
        <x-form-error />
        <form action="{{ route('manager.teams.update', $team) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label" for="name">チーム名</label>
                <input type="text" name="name" value="{{$team->name}}" id="name"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="更新" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
