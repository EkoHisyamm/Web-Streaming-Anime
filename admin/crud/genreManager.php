<?php 
	require_once 'config.php';
	$genres = 'genre';
	$th = [];
	$limit = 10;

	$current = $_POST['genreTask'];

	switch ($current) {
		case 'edits':
		$query 	= 'UPDATE `genre` SET `nama`="'.ucfirst($_POST['nameGenre']).'", `info`="'.$_POST['infoGenre'].'" WHERE `id`='.$_POST['idGenre'].' ';
		mysqli_query($con, $query);
		$sql = mysqli_query($con, 'SELECT `nama`,`id`,`info` FROM `genre` ORDER BY `id` DESC');
		break;
		
		case 'delete':
		mysqli_query($con, 'DELETE FROM `genre` WHERE `id`='.$_POST['idDel'].' ');
		$sql = mysqli_query($con, 'SELECT `nama`,`id`,`info` FROM `genre` ORDER BY `id` DESC');
		break;

		case 'add':
		mysqli_query($con, 'INSERT INTO `genre` (`nama`,`info`) VALUES ("' . ucfirst($_POST['name']) . '", "' . ucfirst($_POST['desc']) . '")');
		$sql = mysqli_query($con, 'SELECT `nama`,`id`,`info` FROM `genre` ORDER BY `id` DESC');
		break;

		case 'search':
		$sql = mysqli_query($con, 'SELECT `nama`,`id`,`info` FROM `genre` WHERE `nama` LIKE "%' . $_POST['search'] . '%"');	
		break;

		case 'kosong':
		$sql = mysqli_query($con, 'SELECT `nama`,`id`,`info` FROM `genre` ORDER BY `id` DESC');
		break;
	}

	array_push($th, 'nama', 'info');

	$pages = 1;
	$lenght = mysqli_num_rows($sql);
	$result = limitSql($sql, $pages, $limit);
	
	?>
		<thead>
			<tr>
				<?php
				foreach ($th as $a) {
					?>
					<th><?php echo $a ?></th>
					<?php
				}
				?>
				<th style="width: 50px">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($result as $row) {
				$temp = implode(',', $row); 
				?>
				<tr>
					<?php
					foreach ($th as $c) {
						?>
						<td><?php echo $row[$c] ?></td>
						<?php
					}
					?>
					<td>
						<a href="#editmodal" name="edit" data-id="<?php echo $temp; ?>" title='Update Record' data-toggle='modal' class="edit"> <span class='fas fa-edit'></span></a>
						<a href="#" class="delete" data-id="<?php echo $row['id'] ?>" title='Delete Record' > <span class='fas fa-trash-alt'></span></a>
					</td>
				</tr>
				<?php
			}
			?>

			<!-- MODAL EDIT -->
			<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Banner</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="descBanner" class="text-primary">Nama:</label><br>
								<input class="form-control" rows="3" id="namaEdit" placeholder="isi deskrisi...">
							</div>
							<div class="form-group">
								<label for="descBanner" class="text-primary">Deskripsi:</label><br>
								<textarea class="form-control" rows="3" placeholder="isi deskrisi..."></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="saveEdit" >Edit Data</button>
						</div>
					</div>
				</div>
			</div>
		</tbody>
	<?php
?>

<script>
	$(document).ready(function() {
		$(".delete").click(function() {
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
            url: "crud/genreManager.php",
            data : {idDel : id, genreTask : 'delete'},
            success: function(data){;
              $('#genrelist').html(data);
            }
          });
        } else {
          swal("Pikirkan dengan baik sebelum menghapus!");
        }
      });
    });

    $('.edit').click(function() {
      datas = $(this).data("id");
      datas = datas.split(",");
      $('#namaEdit').val(datas[0]);
      $('#descEdit').val(datas[2]);
    });

    $('#saveEdit').click(function() {
      nama = $('#namaEdit').val();
      desc = $('#descEdit').val();

      swal({
        title: "Beneran mau Edit?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Nice, Berhasil Mengedit!", {
            icon: "success",
          });
          $.ajax({
            method : 'POST',
            url: "crud/genreManager.php",
            data : {genreTask : 'edits', nameGenre : nama, idGenre : datas[1], infoGenre : desc},
            success: function(data) {
              $('#editmodal').modal('hide');
              $('#genrelist').html(data);
            }
          });
        } else {
          swal("Pikirkan dengan baik sebelum menghapus!");
        }
      });
    });
	})
</script>