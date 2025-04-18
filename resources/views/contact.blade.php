@include('includes.head')

<body>
    @include('components.navbar')
    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "Message sent!",
            text: "Your message is successfully sent!",
            icon: "success"
        });
    </script>
    @endif

    <div class="container-fluid">
        <div class="card" style="border-radius: 10px; width: 50rem; margin: auto">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <div class="card-title fw-bold h3 text-primary text-center">
                            <span>GET IN</span><span style="color: #ffbf00;"> TOUCH</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="fName" class="form-control firstname" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="lName" class="form-control lastname" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="cNumber" class="form-control contactnumber" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Contact Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="email" name="emailAdd" class="form-control emailaddress" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <textarea class="form-control comment" name="userQuery" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;"></textarea>
                                <label for="floatingTextarea">What do you have in mind?</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <input type="submit" onclick="sendEmail()" name="submitBtn" value="Submit" class="btn btn-primary" style="width: 100%;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>