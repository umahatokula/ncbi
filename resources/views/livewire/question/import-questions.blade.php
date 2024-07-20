<div>
    <form wire:submit.prevent="import">
        @csrf
        <div>
            <label for="file">Import Questions CSV</label>
            <input type="file" id="file" wire:model="file">
            @error('file') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" class="border-white rounded-xl p-5">Import</button>
    </form>

    <div wire:loading wire:target="import">
        Importing, please wait...
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
