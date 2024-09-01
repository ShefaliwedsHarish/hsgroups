<style>
    .gradient-custom-3 {
        background: #84fab0;
        background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
        background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
    }

    .gradient-custom-4 {
        background: #84fab0;
        background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
        background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
    }
</style>


@include('link')


<section class="vh-100 bg-image"
    style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form id="hs_register">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="hs_name" class="form-control form-control-lg" name="hs_name"/>
                                    <label class="form-label" for="form3Example1cg">Your Name</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="number" id="hs_phone_number" class="form-control form-control-lg" name="phone_number"/>
                                    <label class="form-label" for="form3Example3cg">Your Phone Number</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="hs_password" class="form-control form-control-lg" name="password"/>
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="hs_repet_password" class="form-control form-control-lg" name="hs_repet_password"/>
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="file" id="hs_profile" class="form-control form-control-lg" name="hs_profile" />
                                    <label class="form-label" for="form3Example4cdg">Profile</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-success btn-
                                     btn-lg gradient-custom-4 text-body" value="Register">
                                    {{-- <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button> --}}
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="/"
                                        class="fw-bold text-body"><u>Login here</u></a></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script> 
$(document).ready(function (){
   
    $("#hs_register").on("submit",function (e){
        e.preventDefault(); 
        var form = $(this); 
        var formData = new FormData(form[0]); // Create FormData object

      

        // Make AJAX request
        $.ajax({
            url: "/user_register",
            type: "POST", // Use POST method for form submission
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                        if (response.status == "400") {
                            let messages = response.message;
                            for (let key in messages) {
                                if (messages.hasOwnProperty(key)) {
                                    let errorMessage =messages[key].join(", ");
                                    toastr.error(errorMessage);
                                }
                            }
                           
                        }else if(response.status == "200"){
                            toastr.success(response.message);
                        }else if(response.status == "redirect"){
                            window.location.assign("/deshbord");}
                 }
        });
    });
});

</script> 