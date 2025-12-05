<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow p-4">

                    <h2 class="text-center mb-4">Accedi</h2>

                    {{-- ERRORI VALIDAZIONE --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required
                                   autofocus
                                   value="{{ old('email') }}">
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        {{-- RICORDAMI --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                   name="remember"
                                   class="form-check-input"
                                   id="remember">
                            <label class="form-check-label" for="remember">
                                Ricordami
                            </label>
                        </div>

                        {{-- BOTTONE --}}
                        <button type="submit" class="btn btn-primary w-100">
                            Accedi
                        </button>

                    </form>

                    <p class="mt-3 text-center">
                        Non hai un account?
                        <a href="{{ route('register') }}">Registrati</a>
                    </p>

                </div>

            </div>
        </div>

    </div>

</x-layout>
