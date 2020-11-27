function readURL(input, showdivId) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(showdivId).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $(showdivId).attr('src', '');
  }
}

$(function() {
  $("#userImg").change(function() {
    let showdivId = $(this).attr('data-view');
    if (showdivId) {
      showdivId = '#'+showdivId;
    }
    readURL(this, showdivId);
  });

  $("#aadhaarImg").change(function() {
    let showdivId = $(this).attr('data-view');
    if (showdivId) {
      showdivId = '#'+showdivId;
    }
    readURL(this, showdivId);
  });

  $("#panImg").change(function() {
    let showdivId = $(this).attr('data-view');
    if (showdivId) {
      showdivId = '#'+showdivId;
    }
    readURL(this, showdivId);
  });
});
