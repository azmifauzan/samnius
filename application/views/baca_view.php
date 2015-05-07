<?php $this->load->view('header'); ?>
<br/>

<div class="page">
	<div class="grid">
		<div class="row">
			<div class="span8">
				<h2><?php echo $artikel->judul; ?></h2>
				<small><strong><?php echo $site; ?></strong> , <?php echo date('d F Y - H:i',strtotime($artikel->waktu_berita)); ?></small>
				<hr/>
				<?php if($artikel->gambar != '') : ?>
				<img src="<?php echo $artikel->gambar; ?>" />
				<?php endif; ?>
				<div class="body-text">
					<p><?php echo word_limiter(strip_tags($artikel->isi),50); ?></p>
				</div><br/>
				
				<div class="span8">
					<div class="span2">&nbsp;</div>
					<div class="span4">
					<a href="<?php echo $artikel->url; ?>" target="_blank">
					<button type="submit" class="command-button default" style="width: 100%;">
					    <i class="icon-arrow-right-3 place-right" style="font-size: 24pt; margin-top: 5px;"></i>
					    Baca Selengkapnya
					</button>
					</a>
					</div>
				</div>
								
				<div class="span8">
					<br/><hr/>
					<table width="97%" align="right" border="0" style="border: none;">
					<tr align="left">
						<td style="border-right: none;">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>				
						<a class="addthis_counter addthis_pill_style"></a>
						</div>						
						<!-- AddThis Button END -->
						</td>
						<td><!-- script begin here -->
						<script src="http://www.lintas.me/assets/scripts/widget_v2.js?uid=511757e0fb82520f5500294e" type="text/javascript"></script>
						<script type="text/javascript">
						lintasme.init('right'); // options : left, top, bottom, right
						</script>
						<!-- End script --></td>
					</tr>					
					</table>					
				</div>
				
				<div class="8">
					<br/><hr/>
					<h3>Komentar</h3>
					<div class="fb-comments" data-href="<?php echo current_url(); ?>" data-width="600" data-num-posts="10"></div>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=128368472102";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				</div>
			</div>
			
			<div class="span4">
				<?php $c = rand(1,3); ?>
				<?php if($c == 1): ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppc_flash.php?b=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php elseif($c == 2) : ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppc.php?b=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php else : ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppa.php?id_blog=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php endif; ?>
				<br/>
				
				<div class="bg-color-yellow padding5">
					<h2 class="fg-color-white">&nbsp;Kliping Lainnya</h2>
				</div>
				<?php foreach($terkait->result() as $tk) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$tk->web.'/'.$tk->id.'/'.url_title(strtolower($tk->judul)),$tk->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($tk->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
		</div>		
	</div>	
</div>

<?php $this->load->view('footer'); ?>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5117548e550b2b9c"></script>