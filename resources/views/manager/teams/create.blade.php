<x-layout>
    <x-slot name="title">Team作成</x-slot>
    <h2>チーム新規作成</h2>
    <x-form-error />
    <x-mini-panel>
        {{-- <form action="{{ route('admin.users.store') }}" method="post">
            @csrf

            @include('components.admin.user-fields')

            <div class="mb-3">
                <label class="form-label" for="userPassword">パスワード</label>
                <input type="password" name="password" value="" id="userPassword"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="作成" class="btn btn-primary">
        </form> --}}
    </x-mini-panel>
</x-layout>
