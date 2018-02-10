$(function () {
	// var userLang = navigator.language;
	// if (userLang=="es") {
	// 	if (document.documentElement.lang!="es-ES") {
	// 		window.location.href = "index_es.html"
	// 	}
	// }

	$("#first_exp_div").click(function() {

		$("#first_exp_div").addClass("activated");
		$("#first_exp_txt_div").addClass("activated");
		$("#second_exp_div").removeClass("activated");
		$("#second_exp_txt_div").removeClass("activated");

	});

	$("#second_exp_div").click(function() {
		$("#first_exp_div").removeClass("activated");
		$("#first_exp_txt_div").removeClass("activated");
		$("#second_exp_div").addClass("activated");
		$("#second_exp_txt_div").addClass("activated");
	});


	$(document).on('click', 'a[href^="#"]', function (event) {
	    event.preventDefault();

	    $('html, body').animate({
	        scrollTop: $($.attr(this, 'href')).offset().top
	    }, 1000);
	});


	$(".solapa").css("cursor","pointer");

	$("#first_exp_div").css("cursor","pointer");
	$("#second_exp_div").css("cursor","pointer");

	$(window).scroll(function() {
		var pos = $(window).scrollTop();
		var barHeight = $("div.linkbar").height();
		if( pos > (610-barHeight)) {
			$("div.linkbar").css("opacity","0.0");
		} else if (pos > (610-2*barHeight)) {
			$("div.linkbar").css("opacity",((610-barHeight)-pos)/barHeight);
		} else {
			$("div.linkbar").css("opacity","1.0");
		}
	});

	$("#english").on ('click', function (event) {
 		window.location.href = "index.html"
	});

	$("#spanish").on ('click', function (event) {
		window.location.href = "index_es.html"
	});
});



//This is a pen based off of Codewoofy's eyes follow mouse. It is just cleaned up, face removed, and then made to be a little more cartoony. https://codepen.io/Codewoofy/pen/VeBJEP

/*

document.getElementById("follower_area").addEventListener('mousemove', follow);

var eye = document.getElementById("followed");

function follow (event) {
  var x = (eye.offsetLeft) + (eye.offsetWidth / 2);
  var y = (eye.offsetTop) + (eye.offsetHeight / 2);
  var rad = Math.atan2(event.pageX - x, event.pageY - y);
  var rot = (rad * (180 / Math.PI) * -1) + 180;
  eye.style.transform='rotate(' + rot + 'deg)'
};
*/
