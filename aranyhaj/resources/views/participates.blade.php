@extends('layouts.layout')

@section('title', 'Részt vett események')

@section('content')

    <main class="container py-4">
        <h1 id="eventTitle" class="text-center mb-4">Részt vett események</h1>

        <div class="search-container text-center mb-4">
            <input type="text" id="search" class="form-control" placeholder="Keresés esemény név vagy helyszín alapján...">
        </div>

        <div id="no-results" class="text-center text-muted" style="display: none;">
            Nincs találat!
        </div>

        <div class="row">
            @foreach ($events as $event)
                <div class="col-12 col-md-6 col-lg-4 mb-4 event-card">
                    <div class="card h-100 shadow">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title text-center">{{ $event->event->title }}</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="mb-0">
                                        <strong>Időpont:</strong>
                                        <span
                                            class="date">{{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d') }}</span>
                                        <span class="time">{{ \Carbon\Carbon::parse($event->starts_at)->format('H:i') }}</span>
                                    </p>
                                </div>
                            </div>


                            <img src="{{ asset($event->event->image_name) }}" alt="Event Image" class="card-img-top">
                            <p class="text-center">{{ $event->event->short_information }}</p>

                            <p><strong>Helyszín:</strong>
                                <a class="copy-text" onclick="copyText(this)" data-location="{{ $event->event->location }}">
                                    {{ Str::limit($event->event->location, 30) }}
                                </a>
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <a href="{{ route('events.show', $event->event->id) }}" class="btn btn-dark">Továbbiak</a>
                                <span><strong>Résztvevők:</strong> {{ $event->event->participants->count() }}</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            @if($event->userHasParticipated)
                                <form action="{{ route('event.participate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->event->id }}">
                                    <button type="submit" class="btn btn-danger">Mégsem veszek részt</button>
                                </form>
                            @else
                                <form action="{{ route('event.participate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->event->id }}">
                                    <button type="submit" class="btn btn-warning">Részt veszek</button>
                                </form>
                            @endif

                            @if($event->userHasLiked)
                                <button class="btn btn-primary" disabled>Lájkoltad</button>
                            @else
                                <form action="{{ route('event.like') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->event->id }}">
                                    <button type="submit" class="btn btn-outline-primary">👍
                                        {{ $event->event->likes_count ?? 0 }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("search");
            const cards = document.querySelectorAll(".card");
            const noResultsDiv = document.getElementById("no-results");

            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.toLowerCase();
                let hasResults = false;

                cards.forEach(card => {
                    const title = card.querySelector(".card-title").textContent.toLowerCase();
                    const location = card.querySelector(".copy-text").textContent.toLowerCase();
                    const matches = title.includes(searchText) || location.includes(searchText);
                    card.parentElement.style.display = matches ? "block" : "none";
                    if (matches) hasResults = true;
                });

                noResultsDiv.style.display = hasResults ? "none" : "block";
            });
        });

        function copyText(element) {
            const location = element.getAttribute("data-location");
            navigator.clipboard.writeText(location).then(() => {
                alert("Helyszín másolva: " + location);
            });
        }
    </script>
@endsection