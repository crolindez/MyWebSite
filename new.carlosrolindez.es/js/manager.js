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

		$("input#listoffiles").attr("value",serialized);
  });

	// $("tr.folder").click(function() {
	// 	$(this).toggleClass("activated");
	// 	$("input#listoffiles").attr("value",$(this).data("file"));
	// });
})

var currentFolder="";

function showfolder(folder) {
  $("tr.file").removeClass("activated");

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
}

function upfolder() {
  if (currentFolder=="") {return;}
  if (currentFolder=="./data/") {return;}

  $("tr.file").removeClass("activated");

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
}

function setCookie(cname, cvalue) {

    document.cookie = cname + "=" + cvalue + ";" ;
}
