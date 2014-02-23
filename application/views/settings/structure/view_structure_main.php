<table id="page-header" width="100%">
	<tr>
		<td><h3>LAMAN TETAPAN STRUKTUR SISTEM</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
</table>

<div class="strucuture-set">
<table border="1" cellpadding="5" width="100%">
	<thead>
		<tr>
			<td><a href="<?php echo site_url('settings/structure/edit/year'); ?>">Senarai Tahun</a></td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($yearsdata as $value)
			{
				echo "<tr><td>" . $value['is_years_digit'] . " - " . $value['is_years_title'] . "</td></tr>";
			}
		?>
	</tbody>
</table>
</div>
<div class="strucuture-set">
<table border="1" cellpadding="5" width="100%">
	<thead>
		<tr>
			<td><a href="<?php echo site_url('settings/structure/edit/class'); ?>">Senarai Kelas</a></td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($classdata as $value)
			{
				echo "<tr><td>" . $value['is_class_title'] . "</td></tr>";
			}
		?>
	</tbody>
</table>
</div>
<div class="strucuture-set">
<table border="1" cellpadding="5" width="100%">
	<thead>
		<tr>
			<td><a href="<?php echo site_url('settings/structure/edit/race'); ?>">Senarai Kaum</a></td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($racesdata as $value)
			{
				echo "<tr><td>" . $value['is_race_title'] . "</td></tr>";
			}
		?>
	</tbody>
</table>
</div>
<div class="strucuture-set">
<table border="1" cellpadding="5" width="100%">
	<thead>
		<tr>
			<td><a href="<?php echo site_url('settings/structure/edit/religion'); ?>">Senarai Agama</a></td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($religionsdata as $value)
			{
				echo "<tr><td>" . $value['is_religion_title'] . "</td></tr>";
			}
		?>
	</tbody>
</table>
</div>
