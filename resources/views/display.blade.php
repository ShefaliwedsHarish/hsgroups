@include('link')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>




<div class="top_header">
</div>
<div class="body_part">
    <div class="container">

        <div class="row both_part">
            <div class=" col-2 hs_authpart">
                <div class="hs-iconepart">
                    <div class="row icone">
                        <i class="fa-regular fa-message icone_part" data-id="message_part" ></i>
                    </div>
                    {{-- <div class="row icone">

                        <i class="fa-regular fa-message icone icone_part" data-id=""></i>
                    </div>
                    <div class="row icone">
                        <i class='fas fa-comment icone_part' data-id=""></i>
                    </div>
                    <div class="row icone">
                        <i class='fas fa-user icone_part' data-id=""></i>
                    </div> --}}
                </div>
                <div class="hs-iconepart-bottom">

                    <div class="row icone">
                        <i class="fa fa-cog icone_part" aria-hidden="true" data-id=""></i>
                    </div>
                    <div class="row icone">
                        <i class="fas fa-user icone_part" data-id="profile_part"></i>
                    </div>
                </div>
            </div>

            {{-- chat part  --}}
            <div class="col-4 whatsapp_part message_part" style="display:show">
           
                <div class="whatsapp_top_header">
                    <div class="row">
                        <div class="col-6">
                            <h3>Chat</h3>
                        </div>
                        <div class="col-6 hs_phonenumber_filed">
                            <p class="display_number"> <b> {{ $Auth->phone_number }} </b></p>
                        </div>
                    </div>
                </div>


                <div class="search_field">
                    <form class="d-flex" role="search" id="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="contact_search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                @php
                    $i = 1;
                @endphp

                <div class="hs_number_block ">
                    @foreach ($user as $data)
                                            @if ($i == 1)
                            <div class="data_message active" data-uid="{{ $data->id }}">
                                            @else
                            <div class="data_message" data-uid="{{ $data->id }}">
                                        @endif
                                    <div class="display_single">
                                        <img src="/user_image/{{ $data->image }}" class="hs_profile">
                                        <div class="hs_number"> {{ $data->phone_number }} </div>
                                        <div class="hs_time"> Yesterday </div>
                                    </div>
                            </div>    
                            {{-- THIS DIV CLOSE TWO DIV --}}
                            @php
                                $i = $i + 1;
                            @endphp
                        {{-- </div> --}}
                    @endforeach
                </div>
            </div>

            {{-- profile div --}}

        <div class="col-4  whatsapp_part profile_part" style="display:none">
            <div class="main_header_part">
                <h3>Profile</h3>
            </div>

        <div class="hs_full_part">
            <div class="hs_edit_image_part">
            @if(isset($Auth->image))
            <img src="user_image/{{$Auth->image}}" class="hs_edit_image hs_profile_picture">
            @else
              <img src="user_image/profile.png" class="hs_edit_image">
            @endif
              <div class="hs_add_part">
              <img src="icone/camera.png" class="hs_camera_icon">
              <h5 class="hs_add_profile"> Add Profile <br> 
                     Picture </h5>
              </div>
            </div>
            
                <div class="hs_edit">
                    <p class="hs_edit_heading">Your name</p>
                    <div class="input-group mb-3">
                        <input type="text" class="hs_edit_name"  placeholder="Recipient's username" readonly=""   value="{{$Auth->name}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                      <i class="fas fa-pencil-alt" class="hs_edit_icone"></i>
                      
                        {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-pencil-alt" class="hs_edit_icone"></i></button> --}}
                      </div>
                        {{-- <input type="text" value="" class="hs_edit_name"> --}}
                        
                    
                </div>

                <div class="hs_describtion"> This is not your username or PIN. This name will be visible to your WhatsApp contacts.</div>
            {{-- div.hs_edit_name>p.hs_heading_test>input --}}

            {{-- <div class="hs_edit_name">

            </div> --}}
            <div class="hs_edit_about">
                <p class="hs_edit_aboutpart">About </p>
                <div class="input-group mb-3">
                    <input type="text" class="hs_edit_name"  placeholder="Hey there! I am using WhatsApp" readonly=""   value="{{$Auth->about}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <i class="fas fa-pencil-alt" class="hs_edit_icone"></i>
                  
                    {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-pencil-alt" class="hs_edit_icone"></i></button> --}}
                  </div>
                    {{-- <input type="text" value="" class="hs_edit_name"> --}}
                    

            </div>
        </div>

        </div>


        <div class="col-6 message_part">
            <div class="header_profile_part">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
            <div class="message_block">
                <img src="images/Screenshot.png" class="images_message_container">
            </div>

            <div class="sender_part">
            <div class="send_input">
                <form class="d-flex" role="search" id="search">
                    <input class="form-control me-2 send_message" type="search" placeholder="Type of message"
                        aria-label="Search" name="contact_search">
                    <button class="send_button" type="submit"><img src="/images/send.jpg" class="send_icone"></button>
                </form>
            </div> 
            </div>
        </div>

    </div>

</div>


<script>
    $(document).ready(function() {

        var auth = {{ Auth::id() }}

        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            var html = "";
            if (auth == data.message.sender) {

                html += ' <div class="alert alert-success sender_header" role="alert">';
                html += data.message.message;
                html += '</div>';
            } else if (auth == data.message.recever) {

                html += '<div class="alert alert-light recevier_header" role="alert">';
                html += '<span>' + data.message.message + '</span>';
                html += '</div>';
            }
            jQuery(".message_block").append(html);
            var $messageBlock = $('.message_block');
            $messageBlock.scrollTop($messageBlock[0].scrollHeight);

        });


        $("#search").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);

            // Make AJAX request
            $.ajax({
                url: "/search_value",
                type: "POST", // Use POST method for form submission
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == "400") {
                        toastr.error(errorMessage);
                    }
                }
            });
        });


        $(document).on("click", ".data_message", function() {


            $(".sender_part").hide();
            $(".images_message_container").hide();
            $(".sender_part").show();
            $(".message_block").addClass("message_part_data");
            var user_id = $(this).data('uid');
            $(".send_button").attr("data-recevier", user_id);

            show_messaged(user_id);

        });

        // function for show message
        function show_messaged(user_id) {

            $.ajax({
                url: "/message_id",
                type: "POST",
                data: {
                    'user_id': user_id
                },
                success: function(response) {
                    if (response.status == 200) {

                        var top_bar = "";

                        top_bar += '<ul class="nav">';
                        top_bar += '<li class="nav-item">';
                        top_bar += '<span><img src="/user_image/' + response.sender_data.image +
                            '" class="hs_profile"></span>';
                        top_bar += '</li>';
                        top_bar += '<li class="nav-item">';
                        top_bar += '<span>' + response.sender_data.phone_number + '</span>';
                        top_bar += '</li>';
                        top_bar += '</ul>';


                        if (response.message !== "no message") {
                        var html = "";
                        $.each(response.message, function(key, val) {

                            if (response.auth == val.sender_id) {
                                html +=
                                    ' <div class="alert alert-success sender_header" role="alert">';
                                html += val.message;
                                html += '</div>';
                            } else {
                                html +=
                                    '<div class="alert alert-light recevier_header" role="alert">';
                                html += '<span>' + val.message + '</span>';
                                html += '</div>';
                            }

                        });
                        jQuery(".message_block").html(html);
                    }
                        jQuery(".header_profile_part").html(top_bar);
                        var $messageBlock = $('.message_block');
                        $messageBlock.scrollTop($messageBlock[0].scrollHeight);

                    }
                }
            });
        }


        //   send message
        $(document).on("click", ".send_button", function(e) {
            e.preventDefault();
            var recevier = $(this).attr("data-recevier");
            var message = $(".send_message").val();

            $.ajax({

                url: "/send_message",
                type: "POST",
                data: {
                    'recevier_id': recevier,
                    'message': message
                },
                success: function(response) {
                    if (response.status == 200) {
                        $(".send_message").val(' ');
                        //  show_messaged(user_id);




                    }
                }
            });
        })
    });

    jQuery(document).ready(function (){

   $(document).on("click",".icone_part",function (){

    var part=$(this).data('id');
    $(".whatsapp_part ").hide(); 
    $("."+part).show(); 

   });
})
</script>
