<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow p-4">

                    <h2 class="text-center mb-4">Registrati</h2>

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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NOME --}}
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required
                                   value="{{ old('name') }}">
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required
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

                        {{-- CONFERMA PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Conferma Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        {{-- BOTTONE --}}
                        <button type="submit" class="btn btn-success w-100">
                            Crea Account
                        </button>

                    </form>

                    <p class="mt-3 text-center">
                        Hai già un account?
                        <a href="{{ route('login') }}">Accedi</a>
                    </p>

                </div>

            </div>
        </div>

    </div>

</x-layout>
