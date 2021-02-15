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
		$sql = mysqli_query($con, 'SELECT `nama`,`info` FROM `genre` WHERE `nama` LIKE "%' . $_POST['search'] . '%"');	
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
						<a href="#deletemodal" class="delete" data-id="<?php echo $row['id'] ?>" title='Delete Record' data-toggle='modal'> <span class='fas fa-trash-alt'></span></a>
					</td>
				</tr>
				<?php
			}
			?>

			<!-- MODAL DELETE -->
			<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="delete">Delete Data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="padding: 0;">
							<input type="hidden" class="id" name="id" id="id" />
							<div class="card-body">
								<div class="form-group">
									<p for="Confirm">data yang telah dihapus tidak dapat di kembalikan</p>
								</div>
							</div>
							<div class="modal-footer">
								<button id="deleteModal" type="button" class="btn btn-danger">Delete</button>
							</div>
						</div>
					</div>
				</div>
			</div>

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
								<textarea class="form-control" rows="3" id="descEdit" placeholder="isi deskrisi..."></textarea>
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
		var val = "<?php echo "$genres" ?>";


		$(".delete").click(function() {
      id = $(this).data("id");
    });

    $("#deleteModal").click(function() {
      console.log(id);
      $.ajax({
        method: "POST",
        url: "crud/genreManager.php",
        data : {genreTask : 'delete' , idDel : id, showdata : val},
        success: function(data){;
          $('#deletemodal').modal('hide');
          $('#genrelist').html(data);
        }
      });
    });

    $('.edit').click(function() {
      datas = $(this).data("id");
      datas = datas.split(",");

      $('#namaEdit').val(datas[0]);
      $('#descBanner').val(datas[2]);
    });

    $('#saveEdit').click(function() {
    	nama = $('#namaEdit').val();
      desc = $('#descEdit').val();

      $.ajax({
        method : 'POST',
        url: "crud/genreManager.php",
        data : {genreTask : 'edits', nameGenre : nama, idGenre : datas[1], infoGenre : desc},
        success: function(data) {
          $('#editmodal').modal('hide');
          $('#genrelist').html(data);
        }
      });
    });
	})
</script>