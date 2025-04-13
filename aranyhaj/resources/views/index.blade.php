@extends("layouts.layout")
<!-- Fejléc kiszedés -->
 
@section("title", "Üdvözlünk!")
<!-- Cím adás az oldalnak változó által -->

@section("content")
    <!-- Kontent kiszedés -->

    <main>
        <!-- Első "kártya" a fő menüben gombbal. Leírás, hogy miért jó hajat adományozni.-->
        <div id="FirstContentMainPage" class="card px-3 px-md-5 mt-5 mx-auto" style="max-width: 90%;">
            <h3><b>Adj reményt egy kis szeretettel! </b></h3><br>
            <p style="max-width: 85%;">Üdvözlünk a hajadományozás közösségében! A platform célja, hogy összekössük azokat,
                akik segíteni szeretnének, azokkal, akiknek szükségük van rá. A hajadományozás nem csupán egy gesztus
                – lehetőség arra, hogy valaki újra önmagára találjon. Csatlakozz hozzánk, és légy részese egy olyan
                közösségnek,
                ahol minden hajszál egy új mosolyt jelenthet valakinek!</p>
            <a id="button" href="/donate" class="btn btn-dark d-block mx-auto">Adományozni szeretnék</a>
        </div>

        <!-- Második "kártya" a fő menüben képpel. Válaszok kérdésekkre a kontexusa a szövegnek.-->
        <div id="SecondContentMainPage" class="card px-3 px-md-5 mt-5 mb-5 mx-auto" style="max-width: 90%;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3><b>Miért fontos a hajadományozás?</b></h3>
                    <p>A parókák sokak számára nemcsak esztétikai, hanem érzelmi támogatást is jelentenek. <br>
                        Egy hajadomány nem csupán fizikai ajándék – ez egy új kezdet és egy mosoly forrása is lehet! </p>
                    <h3><b>Hogyan tudsz segíteni?</b></h3>
                    <ul>
                        <li><b>Adományozd el a hajad – </b>Tudj meg többet az adományozás feltételeiről!</li>
                        <li><b>Támogasd a kezdeményezést –</b> és vegyél részt az eseményeinken</li>
                        <li><b>Oszd meg a történetünket –</b> Minél többen tudnak róla, annál több emberhez érhet el a
                            segítség!</li>
                    </ul>
                </div>
                <div class="col-lg-4 text-center">
                    <img id="girl" src="{{ asset('images/girl.png') }}" alt="Mosolygó lány" class="img-fluid rounded">
                </div>
            </div>
        </div>

        <div id="ThirdContentMainPage" class="d-flex justify-content-center gap-4 flex-wrap">
            <div id="buttonImage" class="card text-center">
                <a href="/events">
                    <img src="{{ asset('images/event.png') }}" class="card-img-top" alt="events">
                </a>
                <div class="card-body">
                    <a id="button" href="/events" class="btn btn-dark">Események</a>
                </div>
            </div>

            <div id="buttonImage" class="card text-center">
                <a href="/salons">
                    <img src="{{ asset('images/salon.png') }}" class="card-img-top" alt="salons">
                </a>
                <div class="card-body">
                    <a id="button" href="/salons" class="btn btn-dark">Szalonok</a>
                </div>
            </div>

            <div id="buttonImage" class="card text-center">
                <a href="/donate">
                    <img src="{{ asset('images/donate.png') }}" class="card-img-top" alt="donations">
                </a>
                <div class="card-body">
                    <a id="button" href="/donate" class="btn btn-dark">Adományozok</a>
                </div>
            </div>
        </div>
        </div><br>
    </main>
@endsection
<!-- Lezárás -->