<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistem Pengurusan Buku Teks</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu|Volkhov' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/side-menu.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/window-size.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/misc.js" type="text/javascript"></script>
</head>
<body>
<!--
<div id="header-wrapper">
</div>
-->
<div id="main-wrapper">
<div id="side-menu">
<h3><a href="<?php echo site_url(); ?>">MENU UTAMA</a></h3>
<ul id="menu-list">
	<li><span>Urusan Buku</span>
		<ul>
			<li><a href="<?php echo site_url('books/manage'); ?>">Kemaskini</a></li>
			<li><a href="<?php echo site_url('books/stocks'); ?>">Stok</a></li>
		</ul>
	</li>
	<li><span>Transaksi</span>
		<ul>
			<li><a href="<?php echo site_url('books/checkout'); ?>">Penyerahan</a></li>
			<li><a href="<?php echo site_url('books/checkin'); ?>">Pemulangan</a></li>
		</ul>
	</li>
	<li><a href="<?php echo site_url('reports/all'); ?>">Laporan</a>
		<ul>
			<li><a href="<?php echo site_url('reports/checkout'); ?>">Pengeluaran</a></li>
			<li><a href="<?php echo site_url('reports/checkin'); ?>">Kemasukan</a></li>
		</ul>
	</li>
	<li><span>Profail</span>
		<ul>
			<li><a href="<?php echo site_url('profiles/students'); ?>">Maklumat Pelajar</a></li>
		</ul>
	</li>
	<li><span>Tetapan</span>
		<ul>
			<li><a href="<?php echo site_url('settings/structure'); ?>">Struktur Sistem</a></li>
		</ul>
	</li>
	<li><a href="<?php echo site_url('archives'); ?>">Arkib</a>
		<ul>
			<li><a href="#">2010/2011</a></li>
		</ul>
	</li>
</ul>
</div>
<div id="body-wrapper">
