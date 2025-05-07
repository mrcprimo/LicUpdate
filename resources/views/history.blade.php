@include('includes.head')

<body>
    @include('components.navbar')
    <div class="container-fluid">
        <h3 class="text-primary fw-bold mb-3">Precipitation History</h3>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-primary">Date</th>
                            <th scope="col" class="text-primary">Precipitation</th>
                            <th scope="col" class="text-primary">Weather History</th>
                            <th scope="col" class="text-primary">Warning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

                        <script>
                            $.ajax({
                                url: `{{ route('weather.history') }}`,
                                method: 'GET',
                                success: function(result) {
                                    var body = ''
                                    result.forEach(item => {
                                        // Convert string to Date object
                                        const dateObj = new Date(item.created_at);

                                        // Format the date to "April 17, 2025"
                                        const options = {
                                            year: "numeric",
                                            month: "long",
                                            day: "numeric"
                                        };
                                        const formattedDate = dateObj.toLocaleDateString("en-US", options);

                                        /*

                                        List of weather description
                                        
                                        1. Sunny, Clear, 
                                        2. Partly Cloudy
                                        3. Fog, Mist, Cloudy, Overcast
                                        4. Light Rain, Heavy Rain
                                        5. Thunderstorms
                                        
                                        */
                                        
                                        // Convert the input to lowercase to make the comparison case-insensitive
                                        var original = item.description.toLowerCase();
                                        var icon = '';
                                        // List of weather description categories
                                        if (original.includes("sunny") || original.includes("clear")) {
                                            // description 1
                                            icon = `<i class='bx bx-sun text-primary'></i>`
                                        } else if (original.includes("partly cloudy")) {
                                            // description 2
                                            icon = `<i class='bx bx-cloud text-primary'></i>`
                                        } else if (original.includes("fog") || original.includes("mist") || original.includes("cloudy") || original.includes("overcast")) {
                                            // description 3
                                            icon = `<i class='bx bxs-cloud text-primary'></i>`
                                        } else if (original.includes("light rain") || original.includes("heavy rain")) {
                                            // description 4
                                            icon = `<i class='bx bx-cloud-rain text-primary'></i>`
                                        } else if (original.includes("thunderstorms")) {
                                            // description 5
                                            icon = `<i class='bx bx-cloud-lightning text-primary'></i>`
                                        } else {
                                            console.log("Weather description not recognized.");
                                        }

                                        body += `
                                            <tr>
                                                <td>${formattedDate}</td>
                                                <td>${item.precipitation} mm</td>
                                                <td>${icon}  ${item.description}</td>
                                                <td style='color: ${item.warning};'><b>${item.warning}</b></td>
                                            </tr>
                                        `
                                    });
                                    $('tbody').html(body)
                                },
                                error: function(error) {
                                    console.log(error)
                                }
                            })
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>