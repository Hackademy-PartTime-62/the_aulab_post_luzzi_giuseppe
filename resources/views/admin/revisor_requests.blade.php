<x-layout>
    <div class="container py-5">
        <h1 class="mb-4">Richieste Revisore</h1>

        @if ($requests->isEmpty())
            <p class="text-muted">Nessuna richiesta presente.</p>
        @else
            <div class="row">
                @foreach ($requests as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm p-3">

                            <h5>{{ $user->name }}</h5>
                            <p>{{ $user->email }}</p>

                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.revisor.approve', $user) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success">Approva</button>
                                </form>

                                <form action="{{ route('admin.revisor.reject', $user) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger">Rifiuta</button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
