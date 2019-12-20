<section id="mu-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-contact-area">
          <!-- start title -->
          <div class="mu-title">
            <h2>Get in Touch</h2>
          </div>
          <!-- end title -->
          <!-- start contact content -->
          <div class="mu-contact-content">           
            <div class="row">
              <div class="col-md-6">
                <div class="mu-contact-left">
                  <form id="contactForm" class="contactform">                  
                    <p class="comment-form-author">
                      <label for="name">Name</label>
                      <input type="text" required="required" size="30" value="" name="name" id="name">
                    </p>
                    <p class="comment-form-email">
                      <label for="email">Email</label>
                      <input type="email" required="required" aria-required="true" value="" name="email" id="email">
                    </p>
                    <p class="comment-form-comment">
                      <label for="message">Message</label>
                      <textarea required="required" aria-required="true" rows="8" cols="45" name="message" id="message"></textarea>
                    </p>                
                    <p class="form-submit">
                      <!-- <input type="submit" value="Send Message" class="mu-post-btn" name="submit"> -->
                      <button type="submit" class="mu-post-btn" name="submit"><span id="contactBtn">Send Message</span></button>
                    </p>        
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-contact-right">
                  <img src="<?php echo base_url('assets/frontend/img/slider/slider4.jpg') ?>" class="contact-image">
                </div>
              </div>
            </div>
          </div>
          <!-- end contact content -->
         </div>
       </div>
     </div>
   </div>
</section>