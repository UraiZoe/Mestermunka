@extends("layouts.layout")

@section("title", "Regisztráció")

@section("content")

    <h2 class="text-center">Regisztráció</h2>
    <div class="container d-flex justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <!-- Card kezdete -->
            <div class="card shadow-lg text-white">
                <div class="card-body text-black" id="logCards">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Felhasználónév</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Felhasználónév"
                                required>
                            <small id="nameError" class="form-text text-danger" style="display: none;">
                                A név legfeljebb 45 karakter hosszú lehet.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email cím</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Pl.: aranyhaj@gmail.com" required>
                            <small id="emailError" class="form-text text-danger" style="display: none;">
                                Az email címnek nem megfelelő.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Lakcím</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Saját lakcímed" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Jelszó</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Jelszó" required>
                                <button id="yellowButtonEye" type="button" class="btn btn-dark">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <small id="passwordError" class="form-text text-danger" style="display: none;">
                                A jelszónak legalább 8 karakterből kell állnia!
                            </small>
                        </div>
                        <div class="mb-5">
                            <div class="d-grid">
                                <button id="button" class="btn btn-dark">Regisztráció</button>
                            </div>
                            <a id="notRegistedProfilLink" class="text-center" href="/login">Van már fiókom</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nameField = document.getElementById("name");
            const emailField = document.getElementById("email");
            const passwordField = document.getElementById("password");
            const togglePassword = document.getElementById("yellowButtonEye");

            const nameError = document.getElementById("nameError");
            const emailError = document.getElementById("emailError");
            const passwordError = document.getElementById("passwordError");

            // Név validáció (max 45 karakter)
            nameField.addEventListener("input", function () {
                if (nameField.value.length > 45) {
                    nameError.style.display = "block";
                } else {
                    nameError.style.display = "none";
                }
            });

            // Email validáció (@ karakter)
            emailField.addEventListener("input", function () {
                if (!emailField.value.includes("@")) {
                    emailError.style.display = "block";
                } else {
                    emailError.style.display = "none";
                }
            });

            // Jelszó validáció (min. 8 karakter)
            passwordField.addEventListener("input", function () {
                if (passwordField.value.length < 8) {
                    passwordError.style.display = "block";
                } else {
                    passwordError.style.display = "none";
                }
            });

            togglePassword.addEventListener("click", function () {
                const type = passwordField.type === "password" ? "text" : "password";
                passwordField.type = type;

                const icon = togglePassword.querySelector("i");
                if (type === "password") {
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            });
        });
    </script>
@endsection