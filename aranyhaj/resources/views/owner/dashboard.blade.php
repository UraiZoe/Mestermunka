@extends("layouts.layout")

@section("title", "Szalontulajdonos felület")

@section('content')

    <main id="salon-owner-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card donation-card">
                        <div class="card-body text-center">
                            <h1 class="text-center my-4">Szalontulajdonos Felület</h1>
                            <hr>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            @endif
                                <h4 class="text-center my-4">A Te Szalonjaid:</h4>
                                <div class="container">
                                    <div class="row">
                                        @foreach ($salons as $salon)
                                            <div class="col-12 col-md-6 col-lg-4 mb-4 salon-card">
                                                <div class="card h-100 shadow">
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="card-title text-center">{{ $salon->salon_name }}</h5>
                                                        <img id="postImage" src="{{ $salon->image_name }}" alt="Szalon Kép"
                                                            class="img-fluid rounded my-3">
                                                        <p class="card-text">{{ $salon->short_information }}</p>
                                                        <p class="card-text"><strong>Szalon helye:</strong>
                                                            {{ $salon->location }}</p>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <a href="{{ route('salons.show', $salon->id) }}"
                                                            class="btn btn-dark btn-sm">Továbbiak</a>
                                                        <a href="{{ route('owner.editSalon', $salon->id) }}"
                                                            class="btn btn-dark btn-sm">Szerkesztés</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div><br>
                                <hr>
                                <a href="{{ route('owner.createEvent') }}" id="button"
                                    class="btn text-center btn-fixed btn-dark mt-2">Új esemény létrehozása</a><br>
                                <h4>Szalonhoz tartozó események:</h4>
                                @foreach ($salons as $salon)
                                    <h5>{{ $salon->salon_name }} - Események:</h5>
                                    <div class="container">
                                        <div class="row">

                                            @forelse ($salon->events as $event)
                                                <div class="col-12 col-md-4 col-lg-4 mb-4 event-card">
                                                    <div class="card h-100 shadow">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h5 class="card-title">{{ $event->title }}</h5>
                                                                </div>
                                                                <div class="col-6 text-end">
                                                                    <p class="mb-0"><strong>Időpont:</strong>
                                                                        {{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d H:i') }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <img src="{{ asset($event->image_name) }}" alt="Event Image"
                                                                class="img-fluid rounded my-3">
                                                            <p class="text-center">{{ $event->short_information }}</p>
                                                            <div class="col-md-8 mb-1">
                                                                <p><strong>Helyszín:</strong>
                                                                    <a class="copy-text" onclick="copyText(this)" id="copyLink"
                                                                        data-location="{{ $event->location }}">{{ $event->location }}
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <a href="{{ route('events.show', $event->id) }}"
                                                                    class="btn btn-dark btn-hover">Továbbiak</a>
                                                                <p class="card-text mb-0 ms-3">
                                                                    <strong>Résztvevők:</strong>
                                                                    <a href="">{{ $event->participants_count ?? 0 }}</a>
                                                                </p>
                                                                <p class="card-text mb-0 ms-3">
                                                                    <strong>Likok:</strong>
                                                                    <a href="">{{ $event->likes_count ?? 0}}</a>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer text-center">
                                                            <a href="{{ route('owner.editEvent', $event->id) }}" id="button"
                                                                class="btn btn-dark btn-sm mr-2">Esemény szerkesztése</a>
                                                            <a href="{{ route('owner.eventDetails', $event->id) }}" id="button"
                                                                class="btn btn-dark btn-sm mr-2">Esemény adatai</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <h5><b>Nincsenek események.</b></h5>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main><br>
@endsection