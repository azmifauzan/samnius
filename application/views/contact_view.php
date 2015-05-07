<?php $this->load->view('header'); ?> 

<div class="container">
	<div class="row">
		<div class="span10 hero-unit offset1">
			<h1>Contact Us</h1>
			
		</div>
	</div>
</div>
<!-- /container -->
<div class="container">
	<div class="row">
		<div class="span3 offset1 pagesidebar font12 verticalseparator">
			<p class="oswald brown font18">
				 CONTACT US DIRECTLY
			</p>
			<br/>
			<p class="font14 grey8">
				<img src="<?php echo base_url(); ?>assets/img/mail.png" alt=""> Email us: kreatifroom@gmail.com
			</p>
			<br/>
			<p class="font14 grey8">
				<img src="<?php echo base_url(); ?>assets/img/home.png" alt=""> Address: Jl Sukamenak<br/>
				<span class="leftmargin">Bandung, Indonesia 40287</span>
			</p>
			<br/>
			<p class="font14 grey8">
				<img src="<?php echo base_url(); ?>assets/img/info.png" alt=""> Phone: (022) 541-0154
			</p>
		
			
		</div>
		<div class="span7 justify">
			<?php echo form_open('contact/send','class="form-horizontal"'); ?>
				<div class="control-group">
					<label class="control-label" for="inputName">Name</label>
					<div class="controls">
						<input type="text" id="inputName" name="nama" placeholder="Name" class="input-xxlarge">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" id="inputEmail" name="email" placeholder="Email" class="input-xxlarge">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputComment">Message</label>
					<div class="controls">
						<textarea rows="5" name="message" id="inputComment" placeholder="Your message here..." class="input-xxlarge"></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="submit" name="submit" class="btn" value="Send">
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<!-- /container-->

<?php $this->load->view('footer'); ?>