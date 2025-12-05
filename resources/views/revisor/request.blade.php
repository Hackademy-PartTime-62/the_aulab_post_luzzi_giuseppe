<x-layout>

    <div class="container py-5">

        <h1 class="mb-4">Lavora con noi</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('revisor.request.send') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Perché vuoi diventare revisore?</label>
                <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>

                @error('message')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Invia richiesta</button>

        </form>

    </div>

</x-layout>
