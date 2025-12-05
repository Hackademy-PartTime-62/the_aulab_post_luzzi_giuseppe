<x-layout>
    <div class="container py-5">
        <h1 class="fw-bold">{{ $article->title }}</h1>
        <h4 class="text-muted mb-4">{{ $article->subtitle }}</h4>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}"
                 class="img-fluid rounded shadow mb-4"
                 style="max-height: 400px; object-fit: cover;">
        @endif

        <p class="fs-5">{{ $article->body }}</p>

        <p class="text-muted mt-4">
            Scritto da <strong>{{ $article->user->name }}</strong>
            il {{ $article->created_at->format('d/m/Y') }}
        </p>

        @auth
            @if(auth()->id() === $article->user_id || auth()->user()->is_admin)
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Modifica</a>

                <form action="{{ route('articles.destroy', $article) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Elimina</button>
                </form>
            @endif
        @endauth
    </div>
</x-layout>
