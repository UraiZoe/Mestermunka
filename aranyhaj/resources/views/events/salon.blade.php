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
                            </div>
                            <hr id="salonHeaderUnderline" class="mb-4">

                            <!-- Google Maps Beágyazott Térkép -->
                            <div class="map-container my-4 text-center">
                                <iframe id="mapFrame" class="responsive-map" width="600" height="450" style="border:0"
                                    loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>

                            <div class="salon-info text-center">
                                <p><strong>Szalon helye:</strong>
                                    <a class="copy-text" onclick="copyText(this)" id="copyLink"
                                        data-location="{{ $salon->location }}">
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
    function copyText(element) {
            const location = element.getAttribute('data-location');
            const mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(location);

            if (navigator.clipboard) {
                navigator.clipboard.writeText(mapUrl)
                    .then(() => {
                        alert('Lementetted ezt a helyszínt:\n' + location);
                    })
                    .catch(err => {
                        console.error('Nem sikerült a másolás:', err);
                        alert('Nem sikerült lementeni a helyszínt.');
                    });
            } else {
                const textarea = document.createElement('textarea');
                textarea.value = mapUrl;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    alert('Lementetted ezt a helyszínt:\n' + location);
                } catch (err) {
                    console.error('Nem sikerült a másolás:', err);
                    alert('Nem sikerült lementeni a helyszínt.');
                }
                document.body.removeChild(textarea);
            }
        }
</script>

@endsection