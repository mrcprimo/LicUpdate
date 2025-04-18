@include('includes.head')

<body>
    @include('components.navbar')
    <div class="container-fluid">
        <div class="card" style="border-radius: 10px; width: 50rem; margin: auto">
            <div class="card-body text-center">
                <div class="card-title fw-bold h3 text-primary text-center">
                    <span>ABOUT </span><span style="color: #ffbf00;">LICUPDATE</span>
                </div>
                <p class="card-text">
                    Real-time flood warning and monitoring system: Delivering timely alerts and accurate updates to keep you and your commmunity informed, prepared, and safe during critical moments.
                </p>
                <img src=" {{ asset('assets/licab.jpg') }} " class="img-fluid rounded mb-3" alt="Licab, Nueva Ecija">
                <div class="card-title fw-bold h3 text-primary text-center">
                    <span>STAY ALERT, </span><span style="color: #ffbf00;">STAY SAFE</span>
                </div>
                <P>
                    Floods can be unpredictable, but with LicUpdate, you can take control of your safety. Join us in building a more resilient and prepared community.
                </P>
            </div>
        </div>
    </div>
</body>