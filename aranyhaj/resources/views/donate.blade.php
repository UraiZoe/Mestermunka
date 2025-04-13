@extends("layouts.layout")
<!-- Fejléc kiszedés -->

@section("title", "Adományozok")
<!-- Cím adás az oldalnak változó által -->

@section("content")
    <!-- Kontent kiszedés -->
     
    <main>
        <div class="container">
            <div class="row justify-content-center text-center flex-column flex-sm-row flex-md-row flex-lg-row">
                <!-- First Card: Adományozás menete -->
                <div class="col-12 mb-4">
                    <div class="card w-100">
                        <div class="card-body">
                            <h1>Adományozás menete:</h1>
                            <div id="aboutAlignLeft">
                                <ol>
                                    <li>Ellenőrizd a hajhosszúságot – A minimális hossz 35cm</li>
                                    <li><a href="/salons" id="salonChoseOnDonatePage">Válassz egy szalont </a>– Keresd meg a
                                        hozzád legközelebb esőt.</li>
                                    <li>Lépj kapcsolatba velük – Egyeztess időpontot a hajvágásra és az adományozás
                                        részleteiről.</li>
                                    <li>Tiszta, száraz hajjal érkezz a vágásra!</li>
                                </ol>
                            </div>
                            <img id="donationImage" src="{{ asset('images/donation.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- Second Card: További információ -->
                <div class="col-12 mb-4">
                    <div class="card w-100">
                        <div class="card-body">
                            <p>Ha bizonytalan vagy, érdemes tudnod, hogy a hajadományozással valódi segítséget
                                nyújthatsz azoknak, akiknek szükségük van rá. Minden egyes adomány számít, és
                                akár egy frizura is mosolyt csalhat valaki arcára. Ha kérdésed van, bátran
                                keresd a kiválasztott szalont vagy minket – segítünk!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><br>
@endsection
<!-- Lezárás -->