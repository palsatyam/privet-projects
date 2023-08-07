  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-11 col-lg-9 mx-auto">






          <div class="map_form_container">
            <div class="form_container">
              <div class="heading_container heading_center">
                <h2 class="contact_heading">
                  Contact <span>Us</span>
                </h2>
              </div>

<h4 class="sent-notification"></h4>
              <form id="myForm" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input  type="text" class="form-control" id="name" placeholder="First Name" />
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="lname" placeholder="Last Name" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" id="eamil" placeholder="Email" />
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="phone" placeholder="Phone Number" />
                  </div>
                </div>
                <div class="form-group ">
                  <textarea class="message-box" id="body"  placeholder="Message"></textarea>
                </div>
                <div class="btn-box">
                  <button type="button" onclick="sendEmail()" class="submit_btn">Send</button>
                </div>
              </form>


              <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
   <script type="text/javascript">
    function sendEmail(){
      var name = $("#name");
      var lname = $("#lname");
      var email = $("#email");
      var phone = $("#phone");
      var body = $("#body");

      if(isNotEmpty(name) && isNotEmpty(lname) && isNotEmpty(email) && isNotEmpty(phone) && isNotEmpty(body)){
        $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                dataType: 'json',
                data:{
                  name: name.val(),
                  lname: lname.val(),
                  email: email.val(),
                  phone: phone.val(),
                  body: body.val()
                }, success:function(response){
                  $('#myForm')[0].reset();
                  $('.sent-notification').text("Message sent Successfully.");
                }
          });
      }
    }


    function isNotEmpty(caller){
      if(caller.val()==""){
        caller.css('border','1px solid red');
        return false;
      }
      else{
        caller.css('border','');
        retrn true;
      }
    }
   </script>



            </div>
            <div class="map_container">
              <div class="map">
                <div id="googleMap"></div>
              </div>
              <div class="btn-box">
                <button id="showForm" class="map_btn">
                  Form
                </button>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </section>