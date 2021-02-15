$(document).ready(function() {
	var action = $('.action').val();
	var judul_p = $('.title').val();  

	$judul = $('.judul');
	$episode = $('.episode');
	$durasi = $('.durasi');
	$status = $('.status');
	$type = $('.type');
	$studio = $('.studio');
	$rilis = $('.rilis');
	$score = $('.score');
	$sinopsis = $('.sinopsis');
	$cover = $('.cover-link');
	$genre = $('.genre');

	var arr = [
	$judul,
	$episode,
	$durasi,
	$status,
	$type,
	$studio,
	$rilis,
	$genre,
	$score,
	$sinopsis,
	$cover,
	];

	switch ($('.action').val()) {
		case 'edit':
		$('.btn-submit').attr('name', 'edit');
		$('.btn-submit').attr('value', 'edit');
		break;
	}

	$('.btn-submit').on('click', function(event) {
		$button = $(this);
		$form = $('.form');
		$form = $form.children().children().text();
		var a = 0;
		$.each(arr, function(index, value) {
			if (arr[index].val() == "") {
				a += 1;
			};
		});
		if (a == 0 && $('.msg').text() == "") {
			$('.btn-submit').attr('type', 'submit');
			swal("Nice, Berhasil Mengupload!", {
        icon: "success",
      });
		} else {
			swal("isi semua data dan pastikan series tersedia dan belum ada!", {
        icon: "error",
      });
		}
	})

	$('.judul').on('blur', function(event) {
		$judul = $(this);
		$msg = $('.msg');
		$btn = $('.btn-submit');

		$.ajax({
			url: "crud/chek.php",
			method: "POST",
			data: {
				title: $judul.val(),
				judul: judul_p
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				if (!data) {
					$judul.attr('style', 'border-color: red; margin-bottom: 10px; font-size: 20px;');
					$msg.text('anime ini sudah ada');
				} else {
					$judul.removeAttr('style');
					$judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
					$msg.text('');
				}
			}
		});
	})

	$('.btn-preview-link').on('click', function(event) {
		var cover = $('.cover-link').val();
		if ($('.cover-link').val() != "") {
			if ($('.btn-preview-link').text() == "preview") {
				$('.btn-preview-link').text("hide");
				$('.preview-link').attr("src", cover);
			} else {
				$('.btn-preview-link').text("preview");
				$('.preview-link').removeAttr("src");
			}
		}
	})

	$('.grab').on('click', function(event) {
		$link = $('.link').val();
		$.ajax({
			url: "crud/graber.php",
			method: "POST",
			data: {
				link: $link,
				judul: judul_p
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				$a = data;
				$judul.val(data.judul);
				$episode.val(data.episode);
				$durasi.val(data.durasi);
				$status.val(data.status);
				$type.val(data.tipe);
				$studio.val(data.studio);
				$rilis.val(data.rilis);
				$score.val(data.score);
				$('.note-editable').text(data.sinopsis);
				$sinopsis.text(data.sinopsis);
				$cover.val(data.gambar);
				$('.appen').append(data.genre);
				var a = $('.appen').children().toArray();
				var gen = [];
				$.each(a, function(key, value) {
					var genre = value.getAttribute('title');
					if (genre != null) {
						gen.push(genre);
					}
				});
				var genre = "";
				$.each(gen, function(key, value) {
					genre += value + ",";
				});
				genre = genre.substr(0, genre.length - 1);
				$genre.val(genre);
				if (!data.cek) {
					$('.judul').attr('style', 'border-color: red; margin-bottom: 10px;');
					$('.msg').text('anime ini sudah ada');
				}
				else {
					$judul.removeAttr('style');
					$judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
					$msg.text('');
				}
			}
		});
	})
	
	// Summernote
	$('#summernote').summernote();

  // CodeMirror
  CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
  	mode: "htmlmixed",
  	theme: "monokai"
  })
});