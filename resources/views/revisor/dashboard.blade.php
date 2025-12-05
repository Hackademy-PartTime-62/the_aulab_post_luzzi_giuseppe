<x-layout>
    <div class="container py-5">
        <h1 class="fw-bold mb-4 text-center">Dashboard Revisore</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if($articles->isEmpty())
            <div class="alert alert-info text-center">
                Nessun articolo in attesa di revisione.
            </div>
        @else
            <div class="row">
                @foreach($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}"
                                     class="card-img-top" style="height:200px; object-fit:cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="fw-bold">{{ $article->title }}</h5>
                                <p class="text-muted">{{ $article->subtitle }}</p>
                                <p class="small text-muted">
                                    Autore: <strong>{{ $article->user->name }}</strong>
                                </p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <form method="POST" action="{{ route('revisor.accept', $article) }}">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Accetta</button>
                                    </form>
                                    <form method="POST" action="{{ route('revisor.reject', $article) }}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Rifiuta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
