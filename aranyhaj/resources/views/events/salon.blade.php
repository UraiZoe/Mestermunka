@extends("layouts.layout")
<!-- Fejléc kiszedés -->
 
@section("title", "Szalon Információ")
<!-- Cím adás az oldalnak változó által -->

@section("content")
<!-- Kontent kiszedés -->
    
<main id="salon-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card salon-card">
                    <div class="card-body">
                        <div class="salon-header text-center">
                            <div class="salon-container">
                                <div class="salon-image-container">
                                    <img src="{{ asset($salon->image_name) }}" alt="Salon Image" class="salon-image">
                                </div>
                                <div class="salon-text">
                                    <h1 class="salon-title">{{ $salon->salon_name }}</h1>
                                </div>
                            </div>
                        </div><hr id="salonHeaderUnderline" class="mb-4">

                        <!-- Google Maps Beágyazott Térkép -->
                        <div class="map-container my-4 text-center">
                            <iframe
                                id="mapFrame"
                                class="responsive-map"
                                width="600"
                                height="450"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="salon-info text-center">
                            <p><strong>Szalon helye:</strong>
                                <a class="copy-text" onclick="copyText(this)" id="copyLink" data-location="{{ $salon->location }}">
                                    {{ $salon->location }}
                                </a>
                            </p>
                            <p><strong>Rövid leírás:</strong> {{ $salon->short_information }}</p>
                            <p><strong>Információ:</strong> {{ $salon->information }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><br>

<script>
    function formatAddress(address) {
        return address.replace(/\s+/g, "+"); 
    }

    // Ensure the location is a valid string
    let address = {!! json_encode($salon->location) !!};
    let formattedAddress = formatAddress(address);
    console.log(formattedAddress); // Debugging

    // Set Google Maps iframe source dynamically
    let mapUrl = `https://www.google.com/maps?q=${formattedAddress}&output=embed`;
    let mapFrame = document.getElementById("mapFrame");
    mapFrame.src = mapUrl;

    function copyText(element) {
        const location = element.getAttribute('data-location');
        const mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(location);

        navigator.clipboard.writeText(mapUrl)
            .then(() => alert('Lemmentetted ezt a helyszínt: ' + mapUrl))
            .catch(error => alert('Nem sikerült lementened: ' + error));
    }
</script>
@endsection
