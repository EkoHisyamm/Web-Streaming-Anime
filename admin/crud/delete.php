<?php
	require_once 'config.php';
	$th = [];
	$limit = 10;

	$current = $_POST['showdata'];

	switch ($current) {
		case 'movie':
		mysqli_query($con, 'DELETE FROM `movies` WHERE `id`='.$_POST['idDel'].' ');
		array_push($th, 'judul', 'durasi', 'rate','rilis','type','studio','status');
		$sql = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`, `rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM `movies` ORDER BY `id` DESC');
		break;

		case 'episode':
		mysqli_query($con, 'DELETE FROM `episode` WHERE `id`='.$_POST['idDel'].' ');
		array_push($th, 'judul', 'episode');
		$sql = mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` ORDER BY `id` DESC');
		break;
	}

	while ($a = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
		$result[] = $a;
	}

	$pages = 1;
	$lenght = mysqli_num_rows($sql);
	$result = limitSql($sql, $pages, $limit);

	?>
		<thead>
			<tr>
				<?php
					$i = 0;
					foreach ($th as $a) {
						$i++;
						if ($i > 2) {
							$hidden = 'hidden';
						}
						?>
							<th class="<?php echo $hidden ?>"><?php echo $a ?></th>
						<?php
					}
				?>
				<th style="width: 50px">Action</th>
			</tr>
		</thead>
	<?php

	foreach ($result as $row) {
		?>
		<tbody id="bodylist" >
			<tr>
				<?php
					$i = 0;
					foreach ($th as $c) {
						$i++;
						$hidden = "";
						if ($i > 2) {
							$hidden = 'hidden';
						}
						?>
							<td class="<?php echo $hidden ?>"><?php echo $row[$c] ?></td>
						<?php
					}
				?>
				<td>
					<a href="add<?php echo $current ?>.php?id=<?php echo $row['id'] . '&current=' . $current . '&pages=' . $pages . '&action=edit' ?>" name="edit" title='Update Record' data-toggle='tooltip'><span class='fas fa-edit'></span></a>
					<a href="#" name="deletes" data-id="<?php echo $row['id']; ?>" title='Delete Record' class="deletes"> <span class='fas fa-trash-alt'></span></a>
				</td>
			</tr>
		</tbody>
		<?php
	}
?>

<script type="text/javascript">
	$(document).ready(function() {
		var val = "<?php echo "$current" ?>";
		
		$(".deletes").click(function() {
      var id = $(this).data("id");
      swal({
        title: "Beneran mau hapus?",
        text: "Sekali lu hapus, kagak bisa di backup lho!!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Nice, Berhasil Terhapus!", {
            icon: "success",
          });
          $.ajax({
            method: "POST",
            url: "crud/delete.php",
            data : {idDel : id, showdata : val},
            success: function(data){;
              $('#deletemodal').modal('hide');
              $('#listmovies').html(data);
            }
          });
        } else {
          swal("Pikirkan dengan baik sebelum menghapus!");
        }
      });
    });
	});
</script>