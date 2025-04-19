@extends("layouts.layout")
<!-- Fejléc kiszedés -->
 
@section("title", "Adományozok")
<!-- Cím adás az oldalnak változó által -->

@section("content")
<!-- Kontent kiszedés -->
    
<main id="donation-page"> 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card donation-card">
                    <div class="card-body text-center">
                        <div class="event-container">
                            <div class="event-image-container">
                                <img src="{{ asset($event->image_name) }}" alt="Event Image" class="event-image">
                            </div>
                            <div class="event-text">
                                <h1 class="event-title">{{ $event->title }}</h1>
                            </div>
                        </div>

                        <hr class="mb-4">
                        
                        <!-- Google Maps beágyazott térkép -->
                        <div class="map-container my-4">
                            <iframe
                                id="mapFrame"
                                class="responsive-map"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="event-details text-start">
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <p><strong>Közzétéve:</strong> {{ \Carbon\Carbon::parse($event->posted_time)->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <p><strong>Esemény kezdete:</strong> {{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <p><strong>Résztvevők száma:</strong> {{ $event->participants_count ?? 0 }}</p>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <p><strong>Helyszín:</strong>
                                        <a class="copy-text" onclick="copyText(this)" id="copyLink"
                                        data-location="{{ $event->location }}">
                                            {{ $event->location }}
                                        </a>
                                    </p>   
                                </div>
                            </div>

                            <p><strong>Rövid leírás:</strong> {{ $event->short_information }}</p>
                            <p><strong>Leírás:</strong> {{ $event->information }}</p>
                            
                            <div class="card-footer text-center">
                                <form action="{{ route('event.like') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-brown like-btn">{{ $event->likes_count ?? 0 }} 👍</button>
                                </form>

                                <form action="{{ route('event.participate') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-warning participate-btn">Részt veszek</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><br>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mapFrame = document.getElementById("mapFrame");
        const location = @json($event->location); // Laravel változó JS-ben

        if (mapFrame && location) {
            const mapUrl = "https://www.google.com/maps?q=" + encodeURIComponent(location) + "&output=embed";
            mapFrame.src = mapUrl;
            console.log("Térkép URL beállítva:", mapUrl);
        } else {
            console.warn("Térkép betöltés sikertelen.");
        }
    });

    function copyText(element) {
        const location = element.getAttribute('data-location');
        const mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(location);

        navigator.clipboard.writeText(mapUrl)
            .then(() => {
                alert('Lementetted ezt a helyszínt:\n' + location);
            })
            .catch(err => {
                console.error('Másolás sikertelen:', err);
                alert('Nem sikerült lementeni a helyszínt.');
            });
    }
</script>
@endsection
