<!-- Section: Design Block -->
<section class="text-center text-lg-start">
    <style>
        .cascading-right {
            margin-right: -50px;
        }

        @media (max-width: 991.98px) {
            .cascading-right {
                margin-right: 0;
            }
        }
        .front_image{

            height:534px;
        }
    </style>

    @include('link')

    <!-- Jumbotron -->
    <div class="container py-4">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right bg-body-tertiary"
                    style="
            backdrop-filter: blur(30px);
            ">
                    <div class="card-body p-5 shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Sign up now</h2>
                        <form id="hs_login">
                           <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="form3Example3" class="form-control" name="phone_number" />
                                <label class="form-label" for="form3Example3">Phone number</label>
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="form3Example4" class="form-control" name="password"/>
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>

                       
                            <!-- Submit button -->
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">
                                Sign up
                            </button>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>or sign up with:</p>
                             <a href="/register">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-link btn-floating mx-1">
                                    Register Here
                                </button>
                            </a> 


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4 front_image"
                    alt="" />
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


<script> 
    $(document).ready(function (){
       
        $("#hs_login").on("submit",function (e){
            e.preventDefault(); 
            var form = $(this); 
            var formData = new FormData(form[0]); // Create FormData object
              console.log(formData);
          
    
            // Make AJAX request
            $.ajax({
            url: "/login",
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
                        }else if(response.status == "300"){
                            toastr.error(response.message);
                        }else if(response.status == "redirect"){
                            window.location.assign("/deshbord");}
                 }
            });
        });
    });
    
    </script> 