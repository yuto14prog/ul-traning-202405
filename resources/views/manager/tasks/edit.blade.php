<x-layout>
    <x-slot name="title">Task/edit</x-slot>
    <h2><a href="{{ route('manager.teams.show', $team) }}">{{ $team->name }}</a>/{{ $task->title }}編集</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.tasks.update', [$team, $task]) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label" for="title">タイトル</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" id="title"
                    class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="body">内容</label>
                <textarea type="text" name="body" id="body"
                    class="form-control @error('body') is-invalid @enderror">{{ old('title', $task->body) }}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="更新" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
