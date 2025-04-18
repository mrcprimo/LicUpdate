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
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

                        <script>
                            $.ajax({
                                url: `{{ route('weather.history') }}`,
                                method: 'GET',
                                success:function(result){
                                    console.log(result)
                                },
                                error:function(error){
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