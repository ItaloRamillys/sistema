$(function(){
	$('#file-upload1').change(function(){
	  const file = $(this)[0].files[0]
	  const fileReader = new FileReader()
	  fileReader.onloadend = function(){
	    $('#img_profile').attr('src', fileReader.result);
	    $('#img_profile').attr('class', fileReader.result);
	  }
	  fileReader.readAsDataURL(file)
	})
});