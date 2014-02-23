<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="">SERAHAN BUKU</a> > MAKLUMAT PELAJAR</h3></td>
		<td align="right"></td>
	</tr>
</table>
<table border="1" cellpadding="5" width="350px">
	<tr>
		<td><label>Nama Penuh</label></td>
		<td><?php echo $student->is_students_name; ?></td>
	</tr>
	<tr>
		<td><label>Kelas</label></td>
		<td><?php echo $student->is_students_year . " - " . $student->is_class_title; ?></td>
	</tr>
	<tr>
		<td><label>Jantina</label></td>
		<td><?php echo $student->is_gender_title; ?></td>
	</tr>
	<tr>
		<td><label>Agama</label></td>
		<td><?php echo $student->is_religion_title; ?></td>
	</tr>
	<tr>
		<td><label>Bangsa</label></td>
		<td><?php echo $student->is_race_title; ?></td>
	</tr>
	<tr>
		<td><label>Anak Yatim</label></td>
		<td><?php echo $student->is_orphan_title; ?></td>
	</tr>
</table>
