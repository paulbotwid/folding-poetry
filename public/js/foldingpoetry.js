// vars

// var colors = [ "#F932FC", "#30E16C", "#FF4242", "#555", "#0B62E6", "#A01E7D", "#139B99" ];


$(document).ready(function(){

	// for production
	// console.log = function() {};

	window.sr = ScrollReveal({
		duration: 650,
		delay: 160,
		scale: 0.95
	});

	wp_id_global = $("#wp_id").html();
	console.log("The wp id is: " + wp_id_global);

	run_help = true;
	help = false;

	//VARS
	line1 = $("#line1");
	line2 = $("#line2");
	var click = new Audio('audio/click.mp3');
	click.volume = 0.15;

	// Check if returning
	if ( Cookies.get("returning") === undefined ) {
		returning = false;
	} else {
		returning = true;
	}

	// SET TIMEOUT FOR MESSAGE OVERLAY
	count = 15; // countdown amount in seconds
	var minutes = 6; // should be same as php timeout
	timerDelay = 60000*minutes - count*1000; // val passed to timeout message
	timeout = setTimeout(function(){
		timeoutMessage();
	},timerDelay);
	//////////

	// Type the latest line (lastLine2)
	// type_last_line2();

	// Focus input when scrolling to top
	var helped = false;
	var page_top = $('header').waypoint({
  	handler: function(direction) {
			if (direction == "up") {
				$("#line1").focus();
				auto_help(helped);
				helped = true;
			}
  	},
		offset: -25
	});

	/* START
	 * Replace all SVG images with inline SVG
	 */
	jQuery('img.svg').each(function(){
	    var $img = jQuery(this);
	    var imgID = $img.attr('id');
	    var imgClass = $img.attr('class');
	    var imgURL = $img.attr('src');

	    jQuery.get(imgURL, function(data) {
	        // Get the SVG tag, ignore the rest
	        var $svg = jQuery(data).find('svg');

	        // Add replaced image's ID to the new SVG
	        if(typeof imgID !== 'undefined') {
	            $svg = $svg.attr('id', imgID);
	        }
	        // Add replaced image's classes to the new SVG
	        if(typeof imgClass !== 'undefined') {
	            $svg = $svg.attr('class', imgClass+' replaced-svg');
	        }

	        // Remove any invalid XML tags as per http://validator.w3.org
	        $svg = $svg.removeAttr('xmlns:a');

	        // Replace image with new SVG
	        $img.replaceWith($svg);

	    }, 'xml');

	});
	/* END
	 * Replace all SVG images with inline SVG
	 */

	 // hover welcome links 
	 $(".welcome-link").hover(
		 function(){
		 	var thing = $(this).data("highlight");
		 	thing = $("#" + thing);
		 	thing.addClass("highlight");
		 }, 
		 function(){
		 	$(".highlight-field").removeClass("highlight");
		 });

	// POem line hover
	$(".poem-line").hover(poemLineMouseOn, poemLineMouseOff);

	// Line full actions
	$(".poemInput").keyup(function(){
		var length = $(this).val().length;
		var max = $(this).attr("maxlength");
		var position = $(".poemInput").index(this);
		caretPosition = getCaretPosition($(this)); // Get the position of the caret in the active field
		console.log("caret: "+caretPosition);

		if ($(this).is("#line1") && length == max && $("#line2").val().length === 0) {
			// play audio
			click.play();
			var line1_text = $(this).val();
			var lastIndex = line1_text.lastIndexOf(" ");
			var new_line1_text = line1_text.substring(0, lastIndex);
			$("#line1").val(new_line1_text);

			var last_word = line1_text.split(" ").pop();
			$("#line2").val(last_word).focus();
		}
	});

	// cancel on keypress
	$(".poemInput").keydown(function(e){
		if ( (e.which === 8 || e.which === 13 || e.which === 27) && help === true ) {
			help_cancel();
		} else if ( (e.which === 8 || e.which === 37) && caretPosition === 0 && $(this).is("#line2")) {
			$("#line1").focus();
		} else if ( e.which === 39 && caretPosition === $(this).val().length && $(this).is("#line1") ) {
			$("#line2").focus().get(0).setSelectionRange(0,0);
		}
	});

	$(".help-me").click(function(){
		help_click();
	});

	$(".poemInput").click(function(){
		if ( help === true ) {
			help_cancel();
		}
	});

	// get live text from span
	$(".help-line").on("DOMSubtreeModified", function(){
		var theText = $(this).text();
		var theInput = $(this).data("title");
		theInput = $("#"+theInput);

		if (run_help === true) {
			theInput.val(theText);
			// remove dot
			$(".ti-placeholder").empty();
		}
	});

	// Location  start
	jQuery.ajax( {
	  url: '//freegeoip.net/json/',
	  type: 'POST',
	  dataType: 'jsonp',
		timeout: 10000,
	  success: function(location) {
			console.log("success");

	    var city = location.city;
	    var country = location.country_name;

	    if (city && country) {
				$("#location").attr("value", city + ", " + country);
				console.log("You're in " + city + ", " + country);
			} else if (country) {
				$("#location").attr("value", country);
				console.log("You're in " + country);
	    }
	  },
		error: function() {
			var made_up_place = made_up_places[Math.floor(Math.random() * made_up_places.length)];
			$("#location").attr("value", made_up_place);
			console.log("You're in " + made_up_place);
		}
	} );

	// Set font-size class depending on lastline2 length
	var length_of_last = $("#hidden-last-line").text().length;
	console.log("last line length: " + length_of_last);
	if (length_of_last<11) {
		console.log("less than 11");
		$(".poemInput, .last-line-2").css("font-size", "4.3vw");
	}

	// unload
	$(window).on('beforeunload', function(){
      unload_the_poem();
   });

	 // copy link
	 $("#pass-on").click(function(){
		 copy_content('#pass_on_link');
		 $(this).after("<br><span class='small'>Copied!</span>");
	 });


}); // doc ready end

function random_nr(highnr) {
	return Math.floor(Math.random() * highnr);
}


function validatePoem() {
	var line1 = $("#line1");
	var line2 = $("#line2");
	var line1Val = line1.val().trim();
	var line2Val = line2.val().trim();

	//Validate empty
	if (line2Val === "" ) {
		line2.focus();
		return false;
	} else if ( line1Val === "" ) {
		line1.focus();
		return false;
	} else {
		return true;
	}
}

// poem line hover
function poemLineMouseOn() {
	var color = $(this).data("color");
	var location = $(this).data("location");
	$(".poem-line").not(this).css("opacity", "0.37");
	$("#location_display").html(location).addClass("full-opacity");
	$("html").addClass("location-display");
}
function poemLineMouseOff() {
	$(".poem-line").not(this).css("opacity", "1");
	$("#location_display").removeClass("full-opacity");
	$("html").removeClass("location-display");
}

// RELOAD PAGE
function reload() {
	location.reload();
}

// Set padding color on poems
function padding_color() {
	var color = $(this).css("background-color");
	$(this).css("box-shadow", "5px 0 0 " + color + ", -5px 0 0 " + color);
}

// Last line two type
function type_last_line2() {
	if ( $(".last-line-2").length > 0 ) {
		$(".last-line-2").typeIt({
			autoStart: true,
			startDelay: 150,
			cursor: false,
			speed: 80,
			callback: function() {
				$(".poemInput, .last-line-2").removeClass("transparent-border");
			}
		});
	} else {
		$(".poemInput, .last-line-2").removeClass("transparent-border");
	}

}

// HELP TEXT START //
function help1Line1() {
	// set up
	$(".last-line-2").addClass("help-active"); // fade last line
	// OK stop element
	var okStop = "<button id='okstop' onclick='help_cancel()'>Got it</button>";
	$("#submit-btn").replaceWith(okStop);
	help = true;
	run_help = true;
	console.log("help = true");
	// HELP TEXT
	var help1 = $("#help-1");
	var theInput = help1.data("title");  theInput = $("#"+theInput);
	theInput.focus();

	help1.typeIt({
		autoStart: true,
		cursor: false,
		speed: 80,
		deleteSpeed: 50,
		callback: function() {
			if (help === true) {
				help2Line2();
			}
		}
	})
		.tiType('okay, so')
		.tiPause(900)
		.tiDelete()
		.tiPause(300)
		.tiType('folding poetry is a place for writing poetry')
		.tiPause(200);
}
function help2Line2() {

	// HELP TEXT
	var help2 = $("#help-2");
	var theInput = help2.data("title"); theInput = $("#"+theInput);
	theInput.focus();
	help2.typeIt({
		autoStart: true,
		cursor: false,
		speed: 80,
		deleteSpeed: 50,
		callback: function(){
			// Check for new poem branch
			if (help === true) {
				if ( $(".last-line-2").length ) {
					help3Line1();
				} else {
					new_poem_help3Line1();
				}
			}

		}
	})
		.tiPause(90)
		.tiType('together')
		.tiPause(900)
		.tiDelete();
}
// CONTINUE POEM PATH
function help3Line1() {
	// HELP TEXT
	var help1 = $("#help-1");
	var theInput = help1.data("title"); theInput = $("#"+theInput);
	theInput.select();

	setTimeout(function(){
		help1.typeIt({
		autoStart: true,
		cursor: false,
		speed: 80,
		deleteSpeed: 50,
		callback: function() {
			if (help === true) {
				help3Line2();
			}
		}
	})
		.tiPause(400)
		.tiType('someone was just here')
		.tiPause(900)
		.tiDelete()
		.tiType('&#8592; they wrote this')
		.tiPause(1100)
		.tiDelete()
		.tiType('now you can build on it')
		.tiPause(900)
		.tiDelete()
		.tiType('continue the poem up here')
		.tiPause(600);
	}, 500);
}

// NEW POEM PATH
function new_poem_help3Line1() {
	var help1 = $("#help-1");
	var theInput = help1.data("title");
	var theInput = $("#"+theInput);
	theInput.select();

	setTimeout(function(){
		help1.typeIt({
		autoStart: true,
		cursor: false,
		speed: 76,
		deleteSpeed: 50,
		callback: function() {
			if (help === true) {
				help3Line2();
			}
		}
	})
		.tiPause(300)
		.tiType('you\'re actually kind of special &lt;3')
		.tiPause(800)
		.tiDelete()
		.tiType('cause you get to start a new poem')
		.tiPause(800)
		.tiDelete()
		.tiType('first, write something up here')
		.tiPause(150);
	}, 500);
}

// COMMON ENDING
function help3Line2() {
	// HELP TEXT
	var help2 = $("#help-2");
	var theInput = help2.data("title");
	theInput = $("#"+theInput);
	theInput.focus();

	help2.typeIt({
		autoStart: true,
		cursor: false,
		speed: 75,
		deleteSpeed: 50,
		callback: function() {
			if (help === true) {
				help5Line1();
			}
		}
	})
		.tiPause(200)
		.tiType('then down here')
		.tiPause(800)
		.tiDelete();
}
function help5Line1() {
	var help1 = $("#help-1");
	var theInput = help1.data("title"); var theInput = $("#"+theInput);
	theInput.select();

	setTimeout(function(){
		help1.typeIt({
			autoStart: true,
			cursor: false,
			speed: 72,
			deleteSpeed: 50,
			callback: function() {
				if (help === true) {
					help5Line2();
				}
			}
		})
			.tiType('the next person will only see')
			.tiPause(200);
	}, 600);
}

function help5Line2() {
	// HELP TEXT
	var help2 = $("#help-2");
	var theInput = help2.data("title"); theInput = $("#"+theInput);
	theInput.focus();

	help2.typeIt({
		autoStart: true,
		cursor: false,
		speed: 81,
		deleteSpeed: 50,
		callback: function() {
			$("#line1").select();
			setTimeout(function(){
				help_cancel();
			},500);
		}
	})
		.tiPause(250)
		.tiType('this second part')
		.tiPause(1300)
		.tiDelete().tiPause(200);
}


// automatic help
function auto_help(helped) {
	if ( returning === false && helped === false ) {
			var line1Val = line1.val().trim();
			var line2Val = line2.val().trim();
			if (line1Val.length === 0 && line2Val.length === 0 ) {
				help1Line1();
				console.log("help!");
			} else {
				console.log("something there...");
			}
	} else {
		console.log("been here before!");
	}
}

// Help click function
function help_click() {
	console.log("clicked ?");
	if ( help === false ) {
		help1Line1();
	} else {
		help_cancel();
	}

}

function help_cancel() {
	run_help = false;
	$(".help-me").removeClass("help_animate");
	$(".poemInput").val("");
	$("#help-notice").hide();
	$("#line1").focus();
	$(".last-line-2").removeClass("help-active");
	// submit button
	$("#okstop").replaceWith("<input id='submit-btn' type='submit' value='Submit' name='submit'>");
	help = false;
	console.log("help = false");

}


// smooth page scroll
$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1500, 'easeInOutCubic');
        return false;
      }
    }
  });
});

// keep writing
function stay() {
	$.post("../includes/continue_writing.php",
		{
			wp_id: wp_id_global
		}, function(data, status) {
			console.log("return from file: " + data + " Status of the query: " + status);
		});

	clearTimeout(timeout); // reset timers
	clearTimeout(reloadTimer);
	clearTimeout(countdownTimer);
	count = 15;
	$("main").removeClass("blur");
	line1.focus();

	// start timing again
	timeout = setTimeout(function(){
		timeoutMessage();
	},timerDelay);
	$("#message-overlay").hide();
}

// The actual timeout function
function timeoutMessage() {
	countdown();
	$("#message-overlay").css("display", "flex");
	$("main").addClass("blur");
	reloadTimer = setTimeout(letGo, 15000);
}


function countdown() {
	var countdownSpan = $("#countdown");
	countdownSpan.html(count);
	count--;
    if( count > -1 ){
        countdownTimer = setTimeout(function() { countdown(); }, 1000);
    }
}

function letGo() {
	$("#alert-title").html("Sorry, we had to let you go");
	$("#alert-first").html("There are people in line kid");
	$("#alert-second").hide();
	$("#submit-btn").attr("disabled", "disabled");
	$("#stay").html("Reload page").attr("onclick", "reload()");
}

function unload_the_poem() {
		$.ajax({
		  method: 'POST',
		  url: "unload.php",
		  data: {wp_id: wp_id_global},
			success: function(data, status){
		    console.log("return from unload: " + data + " Status of the query: " + status);
		  },
			timout: 1500,
		  async: false
		});
}

function clear_cookies() {
	console.log("clear cookies");
	$.post("clear_cookies.php");
}

// Scroll nav start
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $("header").outerHeight();

// on scroll, let the interval function know the user has scrolled
$(window).scroll(function(event){
  didScroll = true;
});

// run hasScrolled() and reset didScroll status
setInterval(function() {
  if (didScroll) {
    hasScrolled();
    didScroll = false;
  }
}, 250);

function hasScrolled() {
  var scrollPos = $(this).scrollTop();

	if (Math.abs(lastScrollTop - scrollPos) <= delta) return;

	// If they scrolled down (st > lastScrollTop)
	// and are past 200px down (st > 200)
  if (scrollPos > lastScrollTop && scrollPos > 200){
      // Scroll Down
      $('header').addClass('nav-up');
			lastScrollTop = scrollPos;
  } else if (scrollPos < lastScrollTop - 150) {
      // Scroll Up
      if( scrollPos + $(window).height() < $(document).height()) {
          $('header').removeClass('nav-up');
      }
			lastScrollTop = scrollPos;
  }
}

// Scroll nav end

made_up_places = ["Atlantis", "Hogwarts, England", "Neverland", "Hoth", "Desert planet of Tatooine", "Emerald City", "Hill Valley, California", "Sunnydale, California", "Twin Peaks", "Zion", "Pandora", "District 12", "Gotham", "Springfield", "Stars Hollow, Connecticut"];


// Copy link
function copy_content(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


function getCaretPosition(field) {
        var input = field.get(0);
        if (!input) return; // No (input) element found
        if ('selectionStart' in input) {
            // Standard-compliant browsers
            return input.selectionStart;
        } else if (document.selection) {
            // IE
            input.focus();
            var sel = document.selection.createRange();
            var selLen = document.selection.createRange().text.length;
            sel.moveStart('character', -input.value.length);
            return sel.text.length - selLen;
        }
    }

  function welcome_highlight(thing) {
  	thing.addClass("highlight");
  }
