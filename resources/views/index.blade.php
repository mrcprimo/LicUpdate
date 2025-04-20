@include('includes.head')

<body>
    <div id="map"></div>
    @include('components.navbar')
    <div class="content-container">
        <div class="container-fluid pt-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100 shadow-sm" style="border-radius:10px">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-droplet me-3 fs-1 text-primary"></i>
                            <div>
                                <div class="card-title text-secondary mb-0">Precipitation</div>
                                <span class="precipitation fw-bold text-primary">XX.XX mm/min</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100 shadow-sm" style="border-radius:10px">
                        <div class="card-body d-flex align-items-center">
                            <image style="mix-blend-mode: multiply;" class="weather-icon">
                            <div>
                                <div class="card-title text-secondary mb-0">Weather Condition</div>
                                <span class="weather-condition fw-bold text-primary">...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100 shadow-sm" style="border-radius:10px">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-calendar me-3 fs-1 text-primary"></i>
                            <div>
                                <div class="card-title text-secondary mb-0">Date</div>
                                <span class="current-date fw-bold text-primary">MM, DD, YYYY</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const accessKey = '5a0736a61e0852b247d9bbc135dfc167'; // Replace with your actual API key
        const locationPre = 'Licab, Nueva Ecija';

        function fetchCurrentPrecipitation() {
            const url = `https://api.weatherstack.com/current?access_key=${accessKey}&query=${encodeURIComponent(locationPre)}`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.success === false) {
                        console.error("Error:", data.error.info);
                        return;
                    }

                    const time = new Date().toLocaleTimeString();
                    const precip = data.current.precip;
                    console.log(data)
                    const today = new Date();

                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = today.toLocaleDateString('en-US', options);

                    const original = data.current.weather_descriptions[0];
                    const formatted = original.toLowerCase().replace(/\s+/g, '_');


                    document.querySelector('.weather-icon').src = data.current.weather_icons
                    document.querySelector('.precipitation').textContent = `${precip}mm`
                    document.querySelector('.weather-condition').textContent = `${data.current.weather_descriptions[0]}`
                    document.querySelector('.current-date').textContent = `${formattedDate}`
                })
                .catch(err => {
                    console.error("Fetch failed:", err);
                });
        }

        // Run immediately once
        fetchCurrentPrecipitation();

        // Then repeat every 60 seconds
        setInterval(fetchCurrentPrecipitation, 60 * 1000);
    </script>


    <script>
        var map = L.map('map').setView([15.4806, 120.7683], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
</body>