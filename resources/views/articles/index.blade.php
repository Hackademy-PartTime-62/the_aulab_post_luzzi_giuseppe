<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="fw-bold">Tutti gli articoli</h1>

            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-success">
                    + Nuovo articolo
                </a>
            @endauth
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($articles->isEmpty())
            <p class="text-muted">Non ci sono articoli pubblicati.</p>
        @else
            <div class="row mt-4">
                @foreach($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h4 class="fw-bold">{{ $article->title }}</h4>
                                <p class="text-muted">{{ $article->subtitle }}</p>
                                <p class="small text-muted mt-2">
                                    {{ $article->user->name }} – {{ $article->created_at->format('d/m/Y') }}
                                </p>
                                <a href="{{ route('articles.show', $article) }}"
                                   class="btn btn-primary mt-auto">
                                    Leggi articolo
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
