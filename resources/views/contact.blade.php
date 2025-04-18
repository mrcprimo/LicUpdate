@include('includes.head')

<body>
    @include('components.navbar')
    <div class="container-fluid">
        <form action="" method="post">
            <div class="card" style="border-radius: 10px; width: 50rem; margin: auto">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="card-title fw-bold h3 text-primary text-center">
                                <span>GET IN</span><span style="color: #ffbf00;"> TOUCH</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="fName" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="lName" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="cNumber" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Contact Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="email" name="emailAdd" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="userQuery" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;"></textarea>
                                <label for="floatingTextarea">What do you have in mind?</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <input type="submit" name="submitBtn" value="Submit" class="btn btn-primary" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>