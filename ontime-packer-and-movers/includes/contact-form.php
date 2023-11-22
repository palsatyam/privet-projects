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
            <form id="contactUs">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="fname" placeholder="First Name" />
                  <div id="status_f_name"></div>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="lname" placeholder="Last Name" />
                  <div id="status_l_name"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" id="email" placeholder="Email" />
                  <div id="status_email"></div>
                  
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="phone" placeholder="Phone Number" />
                  <div id="status_phone"></div>
                </div>
              </div>
              <div class="form-group ">
                <textarea class="message-box" id="msg" placeholder="message"></textarea>
                <div id="status_msg"></div>
              </div>


              <div class="btn-box">
                <input type="hidden" id="identifier" value="<?= md5("contactUs") ?>">
                <button type="button" id="processCFData" style="background-color:#10c695">Send</button>
                <div id="status_cf"></div>
              </div>
            </form>


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