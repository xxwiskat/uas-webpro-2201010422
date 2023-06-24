$(document).ready( function() {

  // hilangkan tombol search
  $('#but-search').hide();


  // membuat event pada saat diketik
  $('#keyword').on('keyup', function() {

    // munculkan loading
    $('.loader').show();


    // ajax menggunakan $.get()
    $.get('ajax/movies.php?keyword=' + $('#keyword').val(), function(data){

      $('#container').html(data);

    });
  });

});