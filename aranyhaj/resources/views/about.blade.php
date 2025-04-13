@extends("layouts.layout")
<!-- Fejléc kiszedés -->
 
@section("title", "Rólunk")
<!-- Cím adás az oldalnak változó által -->

@section("content")
    <!-- Kontent kiszedés -->

    <main>
        <div id="aboutAlignCenter">

            <div class="gallery">
                <div class="slides">
                    <div class="slide"><img src="{{ asset('images/kep1.png') }}" alt="Image 1"></div>
                    <div class="slide"><img src="{{ asset('images/kep2.png') }}" alt="Image 2"></div>
                    <div class="slide"><img src="{{ asset('images/kep3.png') }}" alt="Image 3"></div>
                </div>
                <button id="prev" class="nav-button">&lt;</button>
                <button id="next" class="nav-button">&gt;</button>
            </div> <br>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let currentIndex = 0;
                    const slides = document.querySelector('.slides');
                    const totalSlides = document.querySelectorAll('.slide').length;

                    // Képváltás funkció
                    function showSlide(index) {
                        if (index >= totalSlides) {
                            currentIndex = 0;  // Vissza az első képre
                        } else if (index < 0) {
                            currentIndex = totalSlides - 1;  // Vissza az utolsó képre
                        }
                        slides.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
                    }

                    // Előző gomb
                    document.getElementById("prev").addEventListener("click", function () {
                        currentIndex--;
                        showSlide(currentIndex);
                    });

                    // Következő gomb
                    document.getElementById("next").addEventListener("click", function () {
                        currentIndex++;
                        showSlide(currentIndex);
                    });

                    // Alapértelmezett kép
                    showSlide(currentIndex);
                });
            </script>

            <div id="aboutText">
                <p style="max-width:900px">Mi, azért hoztuk létre ezt az oldalt, mert hiszünk abban, hogy közösen nagy
                    dolgokat érhetünk el. Az adománygyűjtés számunkra nemcsak egy lehetőség, hanem egy küldetés, amely segít
                    jobbá tenni a világot.</p>
            </div> <br>

            <div id="aboutAlignLeft">
                <p><b> Hogyan segíthetsz? </b></p>
                <ul>
                    <li>Oszd meg a történetünket</li>
                    <li>Csatlakozz hozzánk</li>
                    <li>Adományozz bármilyen formában</li>
                    <li>Támogasd kezdeményezésünket</li>
                </ul>
            </div>

            <div id="aboutAlignCenter">
                <p><b>Lépj velünk kapcsolatba,</b> Ha szeretnél többet megtudni rólunk vagy támogatni a munkánkat, ne habozz
                    írni nekünk!</p>
            </div>
        </div>
    </main>


@endsection
<!-- Lezárás -->