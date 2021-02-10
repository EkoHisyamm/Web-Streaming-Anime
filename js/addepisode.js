$(document).ready(function() {
  var action = $('.action').val();
  var judul_p = $('.title').val();
  var eps = $('.eps').val();

  $judul = $('.judul');
  $episode = $('.episode');
  $link = $('.video');

  var arr = [
  $judul,
  $episode,
  $link
  ];

  switch ($('.action').val()) {
    case 'edit':
    $('.btn-submit').attr('name', 'edit');
    $('.btn-submit').attr('value', 'edit');
    break;
  }
  $('.costumfile').on('change', function(event) {
    var test = event.target.files[0].name;
    $('.filename').text(test);
  })

  $('.btn-submit').on('click', function(event) {
    $button = $(this);
    var a = 0;
    $.each(arr, function(index, value) {
      if (arr[index].val() == "") {
        console.log(value);
        a += 1;
      };
    });
    if (a == 0 && $('.msg').text() == "" && $('.msg2').text() == "") {
      $('.btn-submit').attr('type', 'submit');
    } else {
      $('.warning').text('isi semua data dan pastikan series tersedia dan belum ada');
    }
  })

  $('.judul').on('blur', function(event) {
    $msg = $('.msg');
    $.ajax({
      url: "crud/chek.php",
      method: "POST",
      data: {
        title: $judul.val(),
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
        if (data) {
          $judul.attr('style', 'border-color: red; margin-bottom: 10px; font-size: 20px;');
          $msg.text('tambah series dahulu');
        } else {
          $judul.removeAttr('style');
          $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
          $msg.text('');
        }
      }
    });
  })

  $('.episode').on('blur', function(event) {
    $judul = $('.judul');
    $episode = $('.episode');
    $msg = $('.msg2');
    $.ajax({
      url: "crud/chek.php",
      method: "POST",
      data: {
        title: $judul.val(),
        episode: $episode.val(),
        eps: eps
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
        if (!data.episode) {
          $episode.attr('style', 'border-color: red; margin-bottom: 10px;');
          $msg.text('episode ini sudah ada');
        } else {
          $episode.removeAttr('style');
          $episode.attr('style', 'margin-bottom: 10px;');
          $msg.text('');
        }
      }
    });
  })

  $('.grab').on('click', function(event) {
    $.ajax({
      url: "crud/graber.php",
      method: "POST",
      data: {
        anime: $('.link').val(),
      },
      dataType: "json",
      success: function(data) {
        $judul.val(data.judul);
        $episode.val(data.episode);
        $('.appen').append(data.anime);
        var a = $('.appen').children().toArray();
        var gen = "";
        $.each(a, function(key, value) {
          var video = value.text;
          var data = value.getAttribute('data-video');
          switch (video) {
            case 'YUP HD':
            gen = data;
            gen = gen.split('=');
            gen = gen[1];
            break;
            case 'YUP':
            gen = data;
            gen = gen.split('=');
            gen = gen[1];
            break;
            default:
            gen = data;
            break;
          }
        });
        $link.val(gen);
        if (data.cekjudul) {
          $('.msg').text('tambah series dahulu');
          $judul.attr('style', 'border-color: red; margin-bottom:10px; font-size: 20px;');
        } else {
          $judul.removeAttr('style');
          $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
          $('.msg').text('');
        }

        if (!data.cekepisode) {
          $('.msg2').text('episode ini sudah ada');
          $('.episode').attr('style', 'border-color: red;');
        } else {
          $('.msg2').text('');
          $episode.removeAttr('style');
          $episode.attr('style', 'margin-bottom: 10px;');
        }
      }
    });
  });

  // Summernote
  $('#summernote').summernote()

  // CodeMirror
  CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    mode: "htmlmixed",
    theme: "monokai"
  });
})