$(function () {
	$("tr.file, tr.folder").click(function() {
    $(this).toggleClass("activated");

		var serialized="";

		$("tr.file.activated").each(function(){
			serialized += $(this).data("file") + ":";
		});
		$("tr.folder.activated").each(function(){
			serialized += $(this).data("file") + "/:";
		});
		$("input.delete[type=hidden]").attr("value",serialized);
  });

	setheadfolder(getCookie("root_folder"));

	$(".inputfile").each(function() {

			var $input	 = $( this );
			$label	 = $input.next( 'label' );
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{

			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

				if( fileName )
					$label.find( 'span' ).html( "&nbsp;&nbsp;"+fileName );
				else
					$label.html( labelVal );
		});
	});

})

var currentFolder="";

function showfolder(folder) {
  $("tr.file").removeClass("activated");
  $("tr.folder").removeClass("activated");
	$("input.delete[type=hidden]").attr("value","");

  $("tr").css("display","none");
  $("tr").filter(function(){
    return $(this).data("folder")   == folder
  }).css("display","table-row");
  $("thead tr").css("display","table-row");

  currentFolder=folder;
  if (currentFolder=="./data/") {
    $("tr").filter(function(){
      return $(this).data("folder")   == "."
    }).css("display","none");
  } else {
    $("tr").filter(function(){
      return $(this).data("folder")   == "."
    }).css("display","table-row");
  }
	setCookie("root_folder",currentFolder);
	setheadfolder(currentFolder);
}

function upfolder() {
  if (currentFolder=="") {return;}
  if (currentFolder=="./data/") {return;}
	$("input.delete[type=hidden]").attr("value","");

  $("tr.file").removeClass("activated");
	 $("tr.folder").removeClass("activated");

  var parts = currentFolder.split('/');
  parts.pop();
  parts.pop();
  currentFolder = parts.join('/') +'/';

  $("tr").css("display","none");
  $("tr").filter(function(){
    return $(this).data("folder")   == currentFolder
  }).css("display","table-row");
  $("thead tr").css("display","table-row");

  if (currentFolder=="./data/") {
    $("tr").filter(function(){
      return $(this).data("folder")   == "."
    }).css("display","none");
  } else {
    $("tr").filter(function(){
      return $(this).data("folder")   == "."
    }).css("display","table-row");
  }

	setCookie("root_folder",currentFolder);
	setheadfolder(currentFolder);
}

function setCookie(cname, cvalue) {

    document.cookie = cname + "=" + cvalue + ";" ;
}

function getCookie(cname) {
    var name = cname + "=";
//    var decodedCookie = decodeURIComponent(document.cookie);
    var decodedCookie = document.cookie;
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setheadfolder(path) {
		$("#headfolder").text(path.replace('./data/','Storehouse/'));
}
