@if($articles->count() == 0)

    <p class="text-muted">Nessun articolo in questa sezione.</p>

@else

<table class="table table-bordered table-striped text-center align-middle shadow-sm mt-3">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Data</th>
            <th>Azioni</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->created_at->format('d/m/Y') }}</td>

                <td class="d-flex justify-content-center gap-2">

                    {{-- ACCETTA --}}
                    @if($type == 'pending' || $type == 'rejected')
                        <form method="POST" action="{{ route('revisor.accept', $article) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Accetta</button>
                        </form>
                    @endif

                    {{-- RIFIUTA --}}
                    @if($type == 'pending' || $type == 'accepted')
                        <form method="POST" action="{{ route('revisor.reject', $article) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm">Rifiuta</button>
                        </form>
                    @endif

                </td>
            </tr>
        @endforeach

    </tbody>

</table>

@endif
