<x-layout>
    <div class="container py-5">

        <h1 class="mb-4">Crea un nuovo articolo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Titolo</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sottotitolo</label>
                <input type="text" name="subtitle" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Corpo dell'articolo</label>
                <textarea name="body" rows="6" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Immagine</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Pubblica articolo</button>

        </form>

    </div>
</x-layout>
