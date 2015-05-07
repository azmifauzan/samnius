<?php $this->load->view('header'); ?>
<br/>
<div class="page">
	<div class="grid">
		<div class="row">
			<div class="hero-unit">
			
			<div class="carousel span7" style="height: 315px; margin-left: 5px;" data-role="carousel" data-param-effect="fade" data-param-direction="left" data-param-period="3000" data-param-markers="off">
				<div class="slides">				
				<?php $i=1; foreach($slide as $sl) : ?>
				    <div class="slide image" id="slide<?php echo $i; ?>">
					<?php if($sl->gambar != '') : ?>
					<a href="<?php echo site_url('artikel/baca/'.$sl->web.'/'.$sl->id.'/'.url_title(strtolower($sl->judul))); ?>">
					<img src="<?php echo $sl->gambar; ?>" />
					</a>
					<?php endif; ?>
					<div class="description">
					    <?php echo anchor('artikel/baca/'.$sl->web.'/'.$sl->id.'/'.url_title(strtolower($sl->judul)),$sl->judul); ?><br/><?php echo character_limiter(strip_tags($sl->isi),175); ?>
					</div>
				    </div>
				<?php $i++; endforeach; ?>
				</div>
			</div>
			
			<div class="span4" style="margin-left: 15px;">
				<?php $bg = array('yellow','green','blue','dark','pink','orange','purple','red','green','blue','yellow'); ?>
				<div class="tile double image-slider" data-role="tile-slider" data-param-direction="up" data-param-period="3000">								
					<?php $x=1; foreach($slide2 as $ss) : ?>
					<?php if(($x % 2) == 0) : ?>
					<div class="tile-content bg-color-<?php echo $bg[$x]; ?>">
					    <?php echo anchor('artikel/baca/'.$ss->web.'/'.$ss->id.'/'.url_title(strtolower($ss->judul)),'<h3 style="margin:20px;">'.$ss->judul.'</h3>','style="font-size:35px;"'); ?>
					</div>
					<?php else : ?>
					<div class="tile-content">
					    <a href="<?php echo site_url('artikel/baca/'.$ss->web.'/'.$ss->id.'/'.url_title(strtolower($ss->judul))); ?>">
						<img src="<?php echo $ss->gambar; ?>" />
					    </a>
					</div>
					<?php endif; ?>
					<?php $x++; endforeach; ?>					
				</div>	
			</div>
			
			<div class="span4" style="margin-left: 15px;">
				<div class="tile double image-slider" data-role="tile-slider" data-param-direction="down" data-param-period="3000">
					<?php $c=1; foreach($slide2 as $st) : ?>
					<?php if(($c % 2) == 1) : ?>
					<div class="tile-content bg-color-<?php echo $bg[$c]; ?>">
					    <?php echo anchor('artikel/baca/'.$st->web.'/'.$st->id.'/'.url_title(strtolower($st->judul)),'<h3 style="margin:20px;">'.$st->judul.'</h3>','style="font-size:35px;"'); ?>
					</div>
					<?php else : ?>
					<div class="tile-content">
					    <a href="<?php echo site_url('artikel/baca/'.$st->web.'/'.$st->id.'/'.url_title(strtolower($st->judul))); ?>">
						<img src="<?php echo $st->gambar; ?>" />
					    </a>
					</div>
					<?php endif; ?>
					<?php $c++; endforeach; ?>
				</div>	
			</div>
			</div>
		</div>	
	</div>	
</div>

<div class="page">
	<div class="grid">
		<div class="row">			
			
			<div class="span4">
				<ul class="listview fluid" style="margin-left:0px; margin-bottom: 0px;">
				<?php foreach($headline2->result() as $hl2) : ?>
				<li class="hero-unit">
				<?php if($hl2->gambar != ''): ?>
				<div class="icon">
					<img src="<?php echo $hl2->gambar; ?>" />
				</div>
				<?php endif; ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$hl2->web.'/'.$hl2->id.'/'.url_title(strtolower($hl2->judul)),$hl2->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($hl2->isi),50); ?></p>	
				</div>
				</li>
				<?php endforeach; ?>
				</ul>
			</div>
			
			<div class="span4">
				<div class="fb-activity" data-site="kliping.ripiu.info" data-width="300" data-height="250" data-header="true" data-recommendations="true"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=128368472102";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
			</div>
			
			<div class="span4" style="margin:0px;">
				<?php $c = rand(1,3); ?>
				<?php if($c == 1): ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppc_flash.php?b=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php elseif($c == 2) : ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppc.php?b=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php else : ?>
				<iframe frameborder="0" src="http://sebar.idblognetwork.com/psg_ppa.php?id_blog=2266&sz=300x250" width="310px" height="260px" marginwidth=0 marginheight=0 ></iframe>
				<?php endif; ?>
			</div>
			
		</div>
	</div>	
</div>

<div class="page">
	<div class="grid">
		<div class="row">
			<div class="span4 bg-color-red">
				<img src="images/simple.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Polhukam</h2>
			</div>
			<div class="span4 bg-color-green">
				<img src="images/grid.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Ekonomi</h2>
			</div>
			<div class="span4 bg-color-yellow">
				<img src="images/responsive.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Peristiwa</h2>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<?php foreach($politik->result() as $pl) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$pl->web.'/'.$pl->id.'/'.url_title(strtolower($pl->judul)),$pl->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($pl->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
			
			<div class="span4">
				<?php foreach($ekonomi->result() as $ek) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$ek->web.'/'.$ek->id.'/'.url_title(strtolower($ek->judul)),$ek->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($ek->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
			
			<div class="span4">
				<?php foreach($peristiwa->result() as $pw) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$pw->web.'/'.$pw->id.'/'.url_title(strtolower($pw->judul)),$pw->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($pw->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
		</div>
	</div>	
</div>

<div class="page">
	<div class="grid">
		<div class="row">
			<div class="span4 bg-color-blue">
				<img src="images/simple.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Gaya Hidup</h2>
			</div>
			<div class="span4 bg-color-darken">
				<img src="images/grid.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Olahraga</h2>
			</div>
			<div class="span4 bg-color-purple">
				<img src="images/responsive.png" class="place-right" style="margin: 10px;">
				<h2 class="fg-color-white">&nbsp;Teknologi</h2>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<?php foreach($gaya->result() as $gy) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$gy->web.'/'.$gy->id.'/'.url_title(strtolower($gy->judul)),$gy->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($gy->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
			
			<div class="span4">
				<?php foreach($olahraga->result() as $ol) : ?>
				<div class="data">
					<h4><?php echo anchor('artikel/baca/'.$ol->web.'/'.$ol->id.'/'.url_title(strtolower($ol->judul)),$ol->judul); ?></h4>
					<p><?php echo character_limiter(strip_tags($ol->isi),60); ?></p>
				</div><hr/>
				<?php endforeach; ?>
			</div>
			
			<div class="span4">
				<?php foreach($tekno->result() as $tk) : ?>
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