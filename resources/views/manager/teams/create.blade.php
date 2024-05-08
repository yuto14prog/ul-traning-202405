<x-layout>
    <x-slot name="title">Team作成</x-slot>
    <h2>チーム新規作成</h2>
    <x-form-error />
    <x-mini-panel>
        <form action="{{ route('manager.teams.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="name">チーム名</label>
                <input type="hidden" name="owner_id" value="2" id="owner_id" class="form-control">
                <input type="text" name="name" value="" id="name"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="作成" class="btn btn-primary">
        </form>
    </x-mini-panel>
</x-layout>
