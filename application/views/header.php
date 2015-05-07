<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="<?php if(isset($judul)) : echo $judul; else : ?>Samnius - Rangkuman dan Rekomendasi Berita<?php endif; ?>">
    <meta name="author" content="Gavne Lab">
    <meta name="keywords" content="samnius, rangkuman, rekomendasi, digital, informasi, pengetahuan, review, koran, berita <?php if(isset($judul)) echo ','.$judul; ?>">

    <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>css/modern.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/modern-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/site.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>css/extra.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">

    <title><?php if(isset($judul)) : echo $judul; else : ?>Samnius - Rangkuman dan Rekomendasi Berita<?php endif; ?></title>
</head>

<body class="modern-ui" onload="prettyPrint()">
<div class="page">
	<div class="page-header">
		<div class="page-header-content">
			<h1 class="frederika" style="margin:0.4em 0;">Samnius</h1>
		</div>
	</div>
</div>
    
<div class="page">    
	<div class="nav-bar">
		<div class="nav-bar-inner padding10 bg-color-greenLight"> 
			<a href="<?php echo base_url(); ?>" class="oswald"><span class="element"><i class="icon-home"></i> HOME </span></a>
			<span class="divider" style="margin-left: 15px;"></span>
			<span class="element" style="margin-left: 15px;"> POLHUKAM </span>
			<span class="element" style="margin-left: 15px;"> EKONOMI </span>
			<span class="element" style="margin-left: 15px;"> PERISTIWA </span>
			<span class="element" style="margin-left: 15px;"> GAYA HIDUP </span>
			<span class="element" style="margin-left: 15px;"> OLAHRAGA </span>
			<span class="element" style="margin-left: 15px;"> TEKNOLOGI </span>
		</div>
	</div>	
</div>