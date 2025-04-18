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
                            <th scope="col" class="text-primary"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $weather)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($weather->created_at)->format('F j, Y') }}                                </td>
                                <td>{{ $weather->precipitation }}mm</td>
                                <td>
                                    <!-- Icon -->
                                     <td>{{ $weather->description }}</td>
                                </td>
                            </tr>
                        @endforeach
                        <!-- <tr>
                            <td>March 15, 2025</td>
                            <td>64.19 mm/min</td>
                            <td>
                                <i class='bx bx-cloud text-success'></i>
                                Cloudy
                            </td>
                        </tr>
                        <tr>
                            <td>March 16, 2025</td>
                            <td>98.01 mm/min</td>
                            <td>
                                <i class='bx bx-cloud-rain text-primary'></i>
                                Rainy
                            </td>
                        </tr>
                        <tr>
                            <td>March 17, 2025</td>
                            <td>18.26 mm/min</td>
                            <td>
                                <i class='bx bx-sun text-warning'></i>
                                Sunny
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>