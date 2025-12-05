<x-layout>
    <div class="container py-5">
        <h1 class="text-center mb-4 fw-bold">Benvenuto su The Aulab Post</h1>
        <p class="text-center text-muted mb-5">
            Gli articoli più recenti creati dai nostri autori.
        </p>

        @if($latestArticles->isEmpty())
            <p class="text-center text-muted">Nessun articolo disponibile al momento.</p>
        @else
            <div class="row">
                @foreach($latestArticles as $article)
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

