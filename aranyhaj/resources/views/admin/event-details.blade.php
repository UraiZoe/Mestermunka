@extends('layouts.layout')
<!-- Fejléc kiszedés -->
 
@section('content')
<!-- Kontent kiszedés -->
    
    <div class="container mt-5">
        <!-- Fejléc -->
        <div class="d-flex justify-content-center">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center"
                style="width: 80%; height:70px; max-width: 900px;">
                <h2 class="mb-0">Esemény adatai</h2>
                <div class="d-flex">
                    <a href="{{ route('owner.dashboard') }}" class="btn btn-light me-2">Mégsem</a>
                </div>
            </div>
        </div>

        <!-- Esemény adatai -->
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm mb-4" style="width: 80%; max-width: 900px;">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset($event->image_name) }}" class="img-fluid rounded" alt="{{ $event->title }}"
                            style="max-width: 400px; height: auto;">
                    </div>
                    <p><strong>Esemény neve:</strong> {{ $event->title }}</p>
                    <p><strong>Helyszín:</strong> {{ $event->location }}</p>
                    <p><strong>Időpont:</strong> {{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d H:i') }}</p>
                    <p><strong>Rövid információ:</strong> {{ $event->short_information }}</p>
                    <p><strong>Teljes információ:</strong> {{ $event->information }}</p>
                </div>
            </div>
        </div>

        <!-- Résztvevők Kiiratása -->
        <div class="d-flex justify-content-center">
            <div class="card mb-3" style="width: 80%; max-width: 900px;">
                <div class="card-body">
                    <h3 class="mb-3 text-center">Résztvevők</h3>
                    @if ($participants->isEmpty())
                        <p class="text-center">Nincsenek résztvevők.</p>
                    @else
                        <div class="row">
                            @foreach($participants as $interaction)
                                <div class="col-6 col-sm-4 col-md-3 mb-3">
                                    <div class="card" style="width: 100%;"><br>
                                        <img src="{{ asset($interaction->user->image_name) }}" class="card-img-top rounded-circle"
                                            alt="{{ $interaction->user->user_name }}"
                                            style="width: 80px; height: 80px; object-fit: cover; margin: 0 auto;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="font-size: 0.9rem;">{{ $interaction->user->user_name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kedvelések Kiiratása -->
        <div class="d-flex justify-content-center">
            <div class="card mb-3" style="width: 80%; max-width: 900px;">
                <div class="card-body">
                    <h3 class="mb-3 text-center">Likok</h3>
                    @if ($likes->isEmpty())
                        <p class="text-center">Nincsenek likok.</p>
                    @else
                        <div class="row">
                            @foreach($likes as $interaction)
                                <div class="col-6 col-sm-4 col-md-3 mb-3">
                                    <div class="card" style="width: 100%;"><br>
                                        <img src="{{ asset($interaction->user->image_name) }}" class="card-img-top rounded-circle"
                                            alt="{{ $interaction->user->user_name }}"
                                            style="width: 80px; height: 80px; object-fit: cover; margin: 0 auto;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="font-size: 0.9rem;">{{ $interaction->user->user_name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection