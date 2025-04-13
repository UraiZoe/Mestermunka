@extends("layouts.layout")
<!-- Fejléc kiszedés -->
@section("title", "Admin felület")
<!-- Cím adás az oldalnak változó által -->

@section('content')
<!-- Kontent kiszedés -->
    
    <main id="admin-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card donation-card">
                        <div class="card-body text-center">
                            <h1 class="text-center my-4">Admin Felület</h1>
                            <hr>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Felhasználók kiiratása -->
                            <h3>Felhasználók</h3>
                            <hr><br>
                            <div class="container">
                                <div class="row">
                                    @foreach($users as $user)
                                        <div class="col-12 col-md-4 col-lg-4 mb-4 salon-card">
                                            <div class="card h-100 shadow">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="text-center">
                                                        <img id="image" class="rounded-circle img-fluid" src="{{ $user->image_name }}" alt="Felhasználó Profilkép" 
                                                            style="max-width: 155px; max-height: 155px; object-fit: cover; width: 155px; height: 155px; margin: 0 auto;">
                                                    </div>
                                                    <h4 class="card-title">{{ $user->user_name }}</h4>
                                                    <p class="card-text">{{ $user->email }}</p>
                                                    <p class="card-text">{{ $user->address }}</p>
                                                </div>
                                                <div class="card-footer d-flex justify-content-between text-center">
                                                    <button id="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                                        data-target="#viewUserModal{{ $user->id }}">
                                                        Megtekintés</button>
                                                    @if($user->admin != 2)
                                                        <button id="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                                            data-target="#makeAdminModal{{ $user->id }}">
                                                            Admin jog</button>
                                                    @else
                                                        <button id="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                                            data-target="#removeAdminModal{{ $user->id }}">
                                                            Admin jog visszavonása</button>
                                                    @endif
                                                    <button id="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                                        data-target="#deleteUserModal{{ $user->id }}">Törlés</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Felhasználó admin adás -->
                                        <div class="modal fade" id="makeAdminModal{{ $user->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="makeAdminModalLabel{{ $user->id }}" aria-hidden="true"
                                            data-backdrop="false">
                                            <div class="modal-dialog userModalPosition" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="makeAdminModalLabel{{ $user->id }}">
                                                            Felhasználó adminná tétele</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Bezárás">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <p>Biztosan adminná szeretnéd tenni
                                                                <strong>{{ $user->name }}</strong> felhasználót?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark"
                                                                data-dismiss="modal">Mégsem</button>
                                                            <button type="submit" class="btn btn-dark">Igen, admin lesz</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- admin jog visszavonás -->
                                        <div class="modal fade" id="removeAdminModal{{ $user->id }}" tabindex="-1" role="dialog"
                                            data-backdrop="false">
                                            <div class="modal-dialog userModalPosition" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Admin jog visszavonása</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Biztosan vissza szeretnéd vonni <strong>{{ $user->user_name }}</strong>
                                                        admin jogát?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.removeAdmin', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button id="button" type="submit"
                                                                class="btn btn-dark">Visszavonás</button>
                                                        </form>
                                                        <button id="button" type="button" class="btn btn-dark"
                                                            data-dismiss="modal">Mégse</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Felhasználó adatok megtekintése -->
                                        <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                                            data-backdrop="false">
                                            <div class="modal-dialog userModalPosition" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Felhasználó adatai</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Név:</strong> {{ $user->user_name }}</p>
                                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                                        <p><strong>Jogosultság:</strong>
                                                            @if ($user->admin == 2)
                                                                Admin
                                                            @elseif ($user->admin == 1)
                                                                Szalontulajdonos
                                                            @else
                                                                Felhasználó
                                                            @endif
                                                        </p>
                                                        <p><strong>Létrehozva:</strong>
                                                            {{ $user->created_at->format('Y-m-d H:i') }}</p>
                                                        <p><strong>Utoljára frissítve:</strong>
                                                            {{ $user->updated_at->format('Y-m-d H:i') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="button" type="button" class="btn btn-dark"
                                                            data-dismiss="modal">Bezárás</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true"
                                            data-backdrop="false">
                                            <div class="modal-dialog userModalPosition" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">
                                                            Felhasználó törlése</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Bezárás">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Biztosan törölni szeretnéd <strong>{{ $user->name }}</strong>
                                                            felhasználót?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-dark">Igen, törlöm</button>
                                                        </form>
                                                        <button type="button" class="btn btn-dark"
                                                            data-dismiss="modal">Mégse</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Szalon kiilistázása -->

                                    <div class="container">
                                        <div class="row">
                                            <hr>
                                            <h3>Szalonok</h3><br>
                                            <a href="{{ route('admin.createSalonForm') }}" class="btn btn-dark btn-fixed">Új
                                                Szalon hozzáadása</a>
                                            <div class="mb-3"></div>
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
                                                            <a href="{{ route('admin.editSalon', $salon->id) }}"
                                                                class="btn btn-dark btn-sm">Szerkesztés</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>

                                    <!-- Esemény rész -->
                                    <div class="container">
                                        <hr>
                                        <h3>Események</h3>
                                        <hr>
                                        <button id="button" class="btn btn-dark btn-fixed"
                                            onclick="window.location.href='{{ route('admin.createEventForm') }}'">Új Esemény
                                            hozzáadása</button>
                                        <div class="mt-3"></div>
                                        <div class="row">
                                            @foreach($events as $event)
                                                <div class="col-12 col-md-6 col-lg-4 mb-4 event-card">
                                                    <!-- Használjuk a grid rendszer osztályait -->
                                                    <div class="card h-100 shadow">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h5 class="card-title large">{{ $event->title }}</h5>
                                                                </div>
                                                                <div class="col-6 text-end">
                                                                    <p class="mb-0 small bold">
                                                                        <strong>Időpont:</strong>
                                                                        {{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d H:i') }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <img id="postImage" src="{{ asset($event->image_name) }}"
                                                                alt="Event Image" class="img-fluid rounded my-3">
                                                            <p class="text-center">{{ $event->short_information }}</p>

                                                            <div class="col-md-8 mb-1">
                                                                <p class="small"><strong class="text-center">Helyszín:</strong>
                                                                    {{ $event->location }}</p>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center small">
                                                                <a href="{{ route('events.show', $event->id) }}"
                                                                    class="btn btn-dark btn-hover">Továbbiak</a>
                                                                <p class="card-text mb-0 ms-3">
                                                                    <strong>Résztvevők:</strong>
                                                                    <a href="" class="participants-count"
                                                                        data-event-id="{{ $event->id }}">{{ $event->participants_count ?? 0 }}</a>
                                                                </p>
                                                                <p class="card-text mb-0 ms-3">
                                                                    <strong>Likok:</strong>
                                                                    <a href="" class="like-count"
                                                                        data-event-id="{{ $event->id }}">{{ $event->likes_count ?? 0 }}</a>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer text-center">
                                                            <a href="{{ route('admin.editEvent', $event->id) }}" id="button"
                                                                class="btn btn-dark btn-sm mr-2">Esemény szerkesztése</a>
                                                            <a href="{{ route('admin.eventDetails', $event->id) }}" id="button"
                                                                class="btn btn-dark btn-sm mr-2">Részvételi adatok</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection