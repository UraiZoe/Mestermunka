@extends("layouts.layout")

@section("title", "Szalon módosítása")

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Szalon szerkesztése: {{ $salon->salon_name }}</h3>
                    <a href="{{ route('owner.dashboard') }}" id="yellowButton" class="btn btn-light">Mégsem</a>
                </div>
                <div class="card-body">
                <form id="salonForm" action="{{ route('owner.updateSalon', $salon->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="mb-3">
                        <label for="salon_name" class="form-label">Szalon neve</label>
                        <input type="text" name="salon_name" class="form-control" value="{{ old('salon_name', $salon->salon_name) }}" required>
                        <p class="text-secondary">Maximum 20 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Helyszín</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $salon->location) }}" required>
                        <p class="text-secondary">Javaslat: A helyszínnek tartalmaznia kell: az "út", "körút", "utca", "tér", "sétány", "főút" szót.</p>
                    </div>

                    <div class="mb-3">
                        <label for="short_information" class="form-label">Rövid információ</label>
                        <input type="text" name="short_information" class="form-control" value="{{ old('short_information', $salon->short_information) }}" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="information" class="form-label">Bővebb információ</label>
                        <textarea name="information" class="form-control" rows="4" required>{{ old('information', $salon->information) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image_name" class="form-label">Kép URL</label>
                        <input type="text" name="image_name" id="image_name" class="form-control" value="{{ old('image_name', $salon->image_name) }}">
                    </div>

                    <button id="button" type="submit" class="btn btn-dark mt-3">Szalon frissítése</button>
                </form>
            </div>
        </div>
    </div>
@endsection