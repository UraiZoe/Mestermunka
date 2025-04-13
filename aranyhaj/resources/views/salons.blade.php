@extends("layouts.layout")

@section("title", "Szalonok")

@section("content")

    <main>
        <h1 id="eventTitle" class="text-center">Szalonok</h1>
        <div class="search-container text-center">
            <input type="text" id="search" class="form-control" placeholder="Keresés szalon név vagy város alapján..."><br>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($salons as $salon)
                            <div class="col-12 col-md-6 col-lg-4 mb-4 salon-card">
                                <div class="card h-100 shadow">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center">{{ $salon->salon_name }}</h5>
                                        <img id="postImage" src="{{ $salon->image_name }}" alt="Szalon Kép"
                                            class="img-fluid rounded my-3 d-block mx-auto">
                                        <p class="card-text text-center">{{ $salon->short_information }}</p>
                                        <div class="mt-auto">
                                            <p class="card-text">
                                                <strong>Szalon helye:</strong>
                                                <a id="copyLink" class="copy-text" onclick="copyText(this)"
                                                    data-location="{{ $salon->location }}">
                                                    @php
                                                        $location = $salon->location;
                                                        $words = explode(' ', $location); // Szavakra bontjuk
                                                        $shortenedLocation = implode(' ', array_slice($words, 0, 2));
                                                    @endphp
                                                    {{ $shortenedLocation }}...
                                                </a>
                                            </p>
                                        </div>
                                        <a id="button" href="{{ route('salons.show', $salon->id) }}" class="btn btn-dark">Továbbiak</a>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </div>
        </div>
        <div id="no-results" style="display: none; text-align: center;">
            Nincs ilyen találat.
        </div>

        <script>
            // Kereső mező
            document.addEventListener("DOMContentLoaded", function () {
                const searchInput = document.getElementById("search");
                const cards = document.querySelectorAll(".salon-card");
                const noResultsDiv = document.getElementById("no-results");

                function filterSalons() {
                    const searchText = searchInput.value.toLowerCase();
                    let hasResults = false;

                    cards.forEach(card => {
                        // Lekérdezzük a szalon nevét
                        const salonName = card.querySelector(".card-title").textContent.toLowerCase();
                        // Lekérdezzük a szalon helyét a linkből
                        const salonLocation = card.querySelector(".copy-text").textContent.toLowerCase();

                        // Ellenőrizzük, hogy a név vagy hely tartalmazza-e a keresett szöveget
                        const matchesSearch = salonName.includes(searchText) || salonLocation.includes(searchText);
                        card.style.display = matchesSearch ? "block" : "none";

                        if (matchesSearch) {
                            hasResults = true;
                        }
                    });

                    // Ha nincs találat, mutassuk az üzenetet, különben rejtsük el
                    noResultsDiv.style.display = hasResults ? "none" : "block";
                }

                // Keresés esemény figyelése
                searchInput.addEventListener("input", filterSalons);
            });

            // Szalon helyének másolása
            function copyText(element) {
                const location = element.getAttribute('data-location');

                // URL kódolás JavaScript-ben
                const mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(location);

                // A felhasználó számára kiírjuk a helyszínt, és adunk egy linket a térképre
                alert('Lemmentetted ezt a helyszínt: ' + location + '\n url ként!');
            }

        </script>
    </main><br>
@endsection