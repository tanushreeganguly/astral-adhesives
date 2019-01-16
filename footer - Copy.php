 <?php $var_url=explode("/",$_SERVER["SCRIPT_NAME"]); ?>
 <section id="footerHolder">
	 
        <div class="newsletter">
          <ul>
            <li>Newsletter</li>
            <li>
				<form name="signup" id="signup" method="post">
					<input type="text" id="signup_email" name="signup_email" placeholder="Your email address" class="textBox" value="">
					<input type="submit" name="submit" value="Sign up" class="signUp_btn">
				</form>
				 <p>
				  <div class="callout callout-danger errorDiv" > <span id="errormessage"></span> </div>
				  <span style="color:008000;" id="thankyou"></span>
				 </p>
            </li>
          </ul>
		  
        </div>

        <div class="footer">
          <div class="container">
            <div class="footer_blurb">
              <ul>
                <li><a href="javascript:void(0);">Products</a></li>
                <li><a href="<?=base_url?>about-us">About Us</a></li>
                <li><a href="javascript:;">Industrial Adhesives</a></li>
                <li><a href="<?=base_url?>gallery">Media</a></li>
                <li><a href="<?=base_url?>career">Career</a></li>
				<li><a href="<?=base_url?>faq">FAQ</a></li>
                <li><a href="javascript:;">Download</a></li>
              </ul>
            </div>

            <div class="footer_blurb">
              <div class="blurb_title">Contact Us</div>
              <p>15/78, C- Civil Lines,</p>
              <p>Kanpur</p>
              <p>Uttar Pradesh</p>
              <p>208001</p>
              <p>India</p>
              <p>Phone: +91-512-3916700, 2331646, 2332986</p>
              <p>Fax: +91-512-2331803</p>
              <p>email: <a href="mailto:chemicals@resinova.com">chemicals@resinova.com</a></p>
              <p>website: <a href="www.resinova.com" target="_blank">www.resinova.com</a></p>
            </div>

            <div class="footer_blurb">
              <div class="map"><img src="<?=base_url?>assets/images/map.jpg" alt="map"></div>
            </div>

          </div>
        </div>

        <div class="footer_bottom">
          <div class="container">
            <div class="creadit"><a href="javascript:;">© 2018 Astraladhesive.com </a></div>
            <div class="created_by">
              <a href="https://bcwebwise.com" target="_blank"><img src="<?=base_url?>assets/images/bcww-fish.png" alt="https://bcwebwise.com"></a>
            </div>
          </div>
          <div class="footerClose open">
            <img src="<?=base_url?>assets/images/footer-close.jpg" alt="Close Circle">
            <div class="ft_close">Open</div>
            <div class="arrow"><img src="<?=base_url?>assets/images/footer-arrow.png" alt="Footer Arrow"></div>
          </div>
        </div>

      </section>
	  <section id="search_con">
        <div class="container">
		<div class="error_log" style="color:red;"></div>
		<form name="search" id="searchdata" method="post" action="<?=base_url?>data_search.php">
          <input type="text" name="data" placeholder="Search" class="search_txtBox">
		  </form>
          <div class="closeSearch">X</div>
        </div>
      </section> 
      <div class="enq_button">
        <a href="<?=base_url?>enquiry"><img src="<?=base_url?>assets/images/icon-chat.png" alt="">
        <span>Intrested? <br /> Enquire Now</span></a>
      </div>
	 <section id="message_section">Successfully Inserted.<a href="javascript:location.reload();">OK</a></section>
	  <section id="enquirysection" style="position:relative;align:right;">
        <div>
		<div class="errMsg"></div>  
		<form id="enguiry"  method="post">
			<table cellspacing="0" width="500">
				<tr><td><input type="text" name="name" placeholder="Full Name" onFocus="if (this.value == 'Full Name*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Full Name*';}" value="Full Name*" id="name"></td></tr>
				<tr><td><textarea rows="2" cols="40" class="textareasec" placeholder="Address*" onFocus="if (this.value == 'Address*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Address*';}" name="address" id="address">Address*</textarea>
				</td></tr>
				<tr>
				<td>
					<select class="round" name="country" id="country">
					  <option value="">Select Country*</option>
					  <option value="India" <?php if($country=='India') echo 'selected';?>>India</option>
					  <option value="Us" <?php if($country=='Us') echo 'selected';?>>Us</option>
					</select>
				</td></tr>
				<tr>
				<td>
					<select class="round" name="state" id="state">
						<option value="">Select State</option>
					</select>
					 <input type="text" class="user stateInput" placeholder="State" required onFocus="if (this.value == 'State*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'State*';}" name="stateInput" id="stateInput" value="State*">

				</td>

				</tr>
				<tr>
				<td>
					<select class="round city" name="city" id="city">
						<option value="">Select City</option>
					</select>
					 <input type="text" class="user cityInput" placeholder="City" required onFocus="if (this.value == 'City*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'City*';}" name="cityInput" id="cityInput" value="City*">

				</td>
				</tr>
				<tr><td><input type="text" name="zip" placeholder="Zip*" onFocus="if (this.value == 'Zip*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Zip*';}" value="Zip*" id="zip" maxlength="8"  onKeyPress="return validateNumbersOnly(event)"></td></tr>
				<tr><td><input type="text" name="mobile" placeholder="Mobile*" onFocus="if (this.value == 'Mobile*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Mobile*';}" value="Mobile*" id="mobile" maxlength="10" onKeyPress="return validateNumbersOnly(event)"></td></tr>
				<tr><td><input type="text" name="email" placeholder="Email ID*" onFocus="if (this.value == 'Email ID*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Email ID*';}" value="Email ID*" id="email"></td></tr>
				
				
				<tr><td>
				<select class="round" name="enquireFor" id="enquireFor">
                <option value="">Enquiring for</option>
                <option value="Sales">Sales</option>
                <option value="Exports">Exports</option> 
				<option value="Dealership">Dealership</option>  				
              </select></td></tr>
			  
				<tr>
				<td><input name="dateofbirth" type="text" class="textbox1 date" id="dateofbirth" placeholder="dd-mm-yy*" readonly="readonly" onFocus="if (this.value == 'dd-mm-yy*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'dd-mm-yy*';}" value="dd-mm-yy*"/>
                    </td></tr>
				<tr><td><textarea rows="2" cols="40" class="textareasec" placeholder="Message" onFocus="if (this.value == 'Message') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Message';}" name="description" id="description"></textarea>
				</td></tr>
				
				<tr><td></td></tr>
				<tr><td> <input type="button" value="SUBMIT" name="submit" id="enquireNow"></td></tr>
			</table>
			</form>
		</div>
		</section>