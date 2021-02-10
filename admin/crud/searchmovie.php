<?php
if (isset($_POST['search'])) {
	require_once 'config.php';
	$th = [];
	$limit = 10;

	if($_POST['different'] == "movie"){
		$sql = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`,
			`rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM `movies` WHERE `judul` LIKE "%' . $_POST['search'] . '%"');
		array_push($th, 'judul', '', 'durasi', 'rate','rilis','type','studio','status');
	}

	while ($a = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
		$result[] = $a;
	}

	$pages = 1;
	$lenght = mysqli_num_rows($sql);
	$result = limitSql($sql, $pages, $limit);

	if (empty($result)) {
		$pages = ceil($lenght / $limit);
		header('Location: ?current=' . $current . '&pages=' . $pages);
	} 

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
		<tbody>
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
					<a href="#deletemodal" name="delete" data-id="<?php echo $row['id']; ?>" title='Delete Record' data-toggle='modal' class="delete"> <span class='fas fa-trash-alt'></span></a>
				</td>
			</tr>
		</tbody>

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
						<form method="post" action="">
							<input type="hidden" class="id" name="id" id="id" />
							<div class="card-body">
								<div class="form-group">
									<p for="Confirm">data yang telah dihapus tidak dapat di kembalikan</p>
								</div>
							</div>
							<div class="modal-footer">
								<button name="delete" type="submit" class="btn btn-danger">Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		var id;
		$(".delete").click(function() {
			id = $(this).data("id");
		});

		var val = "<?php echo "$current" ?>";
		$("#deleteModal").click(function() {
			$.ajax({
				url: "crud/delete.php",
				method: "POST",
				data : {idDel : id, showdata : val},
				success: function(data){;
					$('#listmovies').html(data);
				}
			});
		});

		$('#search').on('keyup', function() {
			$.ajax({
				method: "POST",
				url:    "crud/searchmovie.php",
				data: { search : $(this).val(), different : val },
				success: function(data){
					$('#listmovies').html(data);
				}
			});
		});
	});
</script>