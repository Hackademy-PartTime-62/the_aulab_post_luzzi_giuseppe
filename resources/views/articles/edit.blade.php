<x-layout>
    <div class="container py-5">
        <h1 class="fw-bold mb-4">Modifica articolo</h1>

        <form action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Titolo</label>
                <input type="text" name="title" value="{{ $article->title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Sottotitolo</label>
                <input type="text" name="subtitle" value="{{ $article->subtitle }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Corpo</label>
                <textarea name="body" rows="6" class="form-control" required>{{ $article->body }}</textarea>
            </div>

            <button class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
</x-layout>
