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



	$(".carlos").css("cursor","pointer");
	$(".headblock").css("cursor","pointer");
	$(".selector").css("cursor","pointer");
	$(".linkedin").css("cursor","pointer");

	var change = function () {
		$(".header").css("background-color", "#69A9D3");
		$("div.carlos p").css("color","white");
		$("div.headblock").css({"border-color": "white"});
		$("div.headblock p").css({"color": "white", 	"font-weight": "400"});
		$("div.back").css({"background-image":"none"});
		$("div.block").css({"display":"none"});
	}

	var unchange = function () {
		$(".header").css("background-color", "white");
		$("div.carlos p").css("color","#008bf9");
		$("div.headblock").css({"border-color": "#008bf9"});
		$("div.headblock p").css({"color": "#008bf9", 	"font-weight": "400"});
		$("div.back").css({"background-image":"url(../images/fondoppal_iv.jpg)"});
		$("div.block").css({"display":"none"});
	}

	$("#init").on ('click', function (event) {
		unchange();
		$("div.header-container").css({"display":"block"});
	});

	$("#prof").on ('click', function (event) {
 		change();
		$("#prof p").css({"color": "lightblue"});
		$("div.experience").css({"display":"block"});
	});

	$("#acad").on ('click', function (event) {
		change();
		$("#acad p").css({"color": "lightblue"});
		$("div.academic").css({"display":"block"});
	});

	$("#cont").on ('click', function (event) {
		change();
		$("#cont p").css({"color": "lightblue"});
		$("div.contact").css({"display":"block"});
	});

	$(".linkedin").on ('click', function (event) {
 		window.location.href = "https://www.linkedin.com/pub/carlos-rolindez/29/803/7ab";
	});


	$("#english").on ('click', function (event) {
 		window.location.href = "index.html";
	});

	$("#spanish").on ('click', function (event) {
		window.location.href = "index_es.html";
	});

	$("#juegos").on ('click', function (event) {
 		window.location.href = "apps_es.html";
	});

	$("#games").on ('click', function (event) {
		window.location.href = "apps.html";
	});

	$(".ping_android").on ('click', function (event) {
		window.location.href = "https://play.google.com/store/apps/details?id=es.carlosrolindez.ping&hl=en";
	});

	$(".memoryzar_android").on ('click', function (event) {
		window.location.href = "https://play.google.com/store/apps/details?id=es.carlosrolindez.memoryzar&hl=en"
	});

	$(".ping_androide").on ('click', function (event) {
		window.location.href = "https://play.google.com/store/apps/details?id=es.carlosrolindez.ping&hl=es"
	});

	$(".memoryzar_androide").on ('click', function (event) {
		window.location.href = "https://play.google.com/store/apps/details?id=es.carlosrolindez.memoryzar&hl=es"
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
