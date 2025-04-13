@extends("layouts.layout")

@section("title", "Fiókom")

@section("content")

    <main class="container py-5 d-flex justify-content-center">
        @auth
            <div class="card shadow-lg p-4 text-center" style="max-width: 600px; width: 100%;">
                <h1 class="mb-4">Fiókom</h1>
                <!-- Profilkép -->
                <div class="text-center">
                    <img src="{{ Auth::user()->image_name }}" alt="Profilkép" 
                        class="img-fluid rounded-circle shadow"
                        style="max-width: 155px; max-height: 155px; object-fit: cover; width: 155px; height: 155px;">
                    <p class="mt-3">
                        <button id="button" class="btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#profilePictureModal">Profilkép módosítása</button>
                    </p>
                </div>

                <!-- Felhasználói adatok -->
                <p><strong>Felhasználónév:</strong> {{ Auth::user()->user_name }}</p>
                <p><strong>Jogosultság:</strong>
                    @if(Auth::user()->admin == 1)
                        Szalontulajdonos
                        @if(Auth::user()->salons->isNotEmpty())
                            - Szalon neve: {{ Auth::user()->salons->first()->salon_name }}
                        @else
                            - Nincs szalonhoz rendelve
                        @endif
                    @elseif(Auth::user()->admin == 2)
                        Admin
                    @elseif(Auth::user()->admin == 0)
                        Felhasználó
                    @else
                        Hibás adat: {{ Auth::user()->admin }}
                    @endif
                </p>
                <p><strong>Email cím:</strong> {{ Auth::user()->email }}</p>

                <p><strong>Lakcím:</strong> {{ Auth::user()->address }}</p><br>

                <button id="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#EmailAddressModal">
                    Email cím módosítása
                </button><br>
                <button id="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#AddressModal">
                    Lakcím módosítása
                </button><br>
                <button id="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#PasswordModal">
                    Jelszó módosítása
                </button>
            </div>
        @else
            <div class="text-center">
                <h2>Bejelentkezés szükséges</h2>
                <a href="{{ route('login') }}" class="btn btn-dark">Bejelentkezés</a>
            </div>
        @endauth
    </main>

    <!-- Profilkép módosító Modal -->
    <div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilePictureModalLabel">Profilkép módosítása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                </div>
                <form action="{{ route('profile.updateUrl') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="profileUrlTb">Új profilkép URL:</label>
                        <input type="text" class="form-control mb-2" name="profileUrlTb" placeholder="Profilkép URL"
                            value="{{ Auth::user()->image_name }}">
                    </div>
                    <div class="modal-footer">
                        <button id="button" type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>
                        <button id="button" type="submit" class="btn btn-dark">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Email cím módosító Modal -->
    <div class="modal fade" id="EmailAddressModal" tabindex="-1" aria-labelledby="EmailAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EmailAddressModalLabel">Email cím módosítása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                </div>
                <form action="{{ route('email.change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="profileEmail">Új email cím:</label>
                        <input type="email" class="form-control mb-2" name="profileEmail" placeholder="Email cím"
                            value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="modal-footer">
                        <button id="button" type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>
                        <button id="button" type="submit" class="btn btn-dark">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Lakcím módosító Modal -->
    <div class="modal fade" id="AddressModal" tabindex="-1" aria-labelledby="AddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddressModalLabel">Lakcím módosítása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                </div>
                <form action="{{ route('address.change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="profileAddress">Új lakcím:</label>
                        <input type="text" class="form-control mb-2" name="profileAddress" placeholder="Lakcím"
                            value="{{ Auth::user()->address }}" required>
                    </div>
                    <div class="modal-footer">
                        <button id="button" type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>
                        <button id="button" type="submit" class="btn btn-dark">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Jelszó módosító Modal -->
    <div class="modal fade" id="PasswordModal" tabindex="-1" aria-labelledby="PasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PasswordModalLabel">Jelszó módosítása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                </div>
                <form action="{{ route('password.change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="current_password">Jelenlegi jelszó:</label>
                        <input type="password" class="form-control mb-2" name="current_password"
                            placeholder="Jelenlegi jelszó" required>

                        <label for="password">Új jelszó:</label>
                        <input type="password" class="form-control mb-2" name="password" placeholder="Új jelszó" required>

                        <label for="password_confirmation">Új jelszó megerősítése:</label>
                        <input type="password" class="form-control mb-2" name="password_confirmation"
                            placeholder="Új jelszó megerősítése" required>
                    </div>
                    <div class="modal-footer">
                        <button id="button" type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>
                        <button id="button" type="submit" class="btn btn-dark">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("openModalBtn").addEventListener("click", function () {
            var myModal = new bootstrap.Modal(document.getElementById("profilePictureModal"));
            myModal.show();
        });
    </script>
    <!-- jQuery és Bootstrap JS betöltése -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection