@extends("layouts.layout")

@section("title", "Bejelentkezés")

@section("content")

    <h2 class="text-center">Bejelentkezés</h2>
    <div class="container d-flex justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <!-- Card kezdete -->
            <div class="card shadow-lg text-white">
                <div class="card-body text-black" id="logCards">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email cím</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Pl.: aranyhaj@gmail.com" required>
                            <small id="emailError" class="form-text text-danger" style="display: none;">
                                Az email címnek nem megfelelő.
                            </small>
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
                        <div class="mb-2">
                            <div class="d-grid mt-4">
                                <button id="button" class="btn btn-dark">Bejelentkezés</button>
                            </div>
                            <a id="registedProfilLink" class="text-center" href="/registration">Nincs még fiókom</a>
                            <div class="mt-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><br>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const emailField = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            const passwordField = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            const togglePassword = document.getElementById("yellowButtonEye");

            emailField.addEventListener("input", function () {
                if (!emailField.value.includes("@")) {
                    emailError.style.display = "block";
                } else {
                    emailError.style.display = "none";
                }
            });

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