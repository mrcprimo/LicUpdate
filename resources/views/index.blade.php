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
                                <i id="weather_icon" class="bx me-3 fs-1 text-primary"></i>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            getEmailInput()
        })

        async function getEmailInput() {
            const { value: email } = await Swal.fire({
                title: "Input email address",
                input: "email",
                inputLabel: "Your email address",
                inputPlaceholder: "Enter your email address",
                html: `
                    Enter contact detail to receive warning notification.
                    If you previously entered your email&nbsp;<b><a style='cursor: pointer;' id='skip-link' autofocus>Click here to skip</a></b>,
                `,
                showCancelButton: true,
                didOpen: () => {
                // Attach click event to the link after modal opens
                const skipLink = document.getElementById("skip-link");
                if (skipLink) {
                    skipLink.addEventListener("click", function (e) {
                        e.preventDefault();
                        Swal.close(); // Close the modal
                    });
                }
            }
            });

            if (email) {

                $.ajax({
                    url: `{{ route('user.store') }}`,
                    method: 'GET',
                    data: {
                        emailuser: email
                    },
                    success:function(result){
                        if(result){
                            Swal.fire(`You will recieve warning notification to this email: <b>${email}</b>`)
                        }else{
                            Swal.fire(`Something went wrong. Please try again later.`)
                        }
                    },
                    error:function(error){
                        Swal.fire(`Error: ${error}`);
                    }

                })

                
            }
        }

        const accessKey = '4fe4d4c552a4b275c730f5247fbc12dd'; // Replace with your actual API key
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

                    var original = data.current.weather_descriptions[0];
                    const formatted = original.toLowerCase().replace(/\s+/g, '_');


                    /*

                    List of weather description
                    
                    1. Sunny, Clear, 
                    2. Partly Cloudy
                    3. Fog, Mist, Cloudy, Overcast
                    4. Light Rain, Heavy Rain
                    5. Thunderstorms
                    
                    */
                    
                    // Convert the input to lowercase to make the comparison case-insensitive
                    original = original.toLowerCase();

                    // List of weather description categories
                    if (original.includes("sunny") || original.includes("clear")) {
                        // description 1
                        document.querySelector('#weather_icon').classList.add('bx-sun')
                    } else if (original.includes("partly cloudy")) {
                        // description 2
                        document.querySelector('#weather_icon').classList.add('bx-cloud')
                    } else if (original.includes("fog") || original.includes("mist") || original.includes("cloudy") || original.includes("overcast")) {
                        // description 3
                        document.querySelector('#weather_icon').classList.add('bxs-cloud')
                    } else if (original.includes("light rain") || original.includes("heavy rain")) {
                        // description 4
                        document.querySelector('#weather_icon').classList.add('bxs-cloud-rain')
                    } else if (original.includes("thunderstorms")) {
                        // description 5
                        document.querySelector('#weather_icon').classList.add('bxs-cloud-lightning')
                    } else {
                        console.log("Weather description not recognized.");
                    }

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

        // 24 * 60 * 60 * 1000 = 86,400,000 ms = 24 hours (1 day)
        setInterval(fetchCurrentPrecipitation, 24 * 60 * 60 * 1000);
    </script>


    <script>
        var map = L.map('map').setView([15.4806, 120.7683], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
</body>