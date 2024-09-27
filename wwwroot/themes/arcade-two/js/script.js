"use strict";
if ($('#tpl-comment-section').length) {
	const gameId = $('#tpl-comment-section').attr('data-id');
	const commentSystem = new CommentSystem(gameId);
}
const formSearch = document.querySelector("form.search-bar");
if (formSearch) {
	formSearch.addEventListener("submit", function(event) {
		event.preventDefault();
		const input = formSearch.querySelector("input[name='slug']");
		const sanitizedValue = input.value.replace(/ /g, "-");
		input.value = sanitizedValue;
		if (input.value.length >= 2) {
			formSearch.submit();
		}
	});
}
var is_fullscreen = false;
function open_fullscreen() {
	let game = document.getElementById("game-area");
	if(is_fullscreen){
		// Exit fullscreen
		is_fullscreen = false;
		if(is_mobile_device()){
			game.style.position = "absolute";
			document.getElementById("mobile-back-button").style.display = "none";
			document.getElementById("game-player").style.display = "none";
		} else {
			if (game.requestFullscreen) {
				game.requestFullscreen();
			} else if (game.mozRequestFullScreen) { /* Firefox */
				game.mozRequestFullScreen();
			} else if (game.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
				game.webkitRequestFullscreen();
			} else if (game.msRequestFullscreen) { /* IE/Edge */
				game.msRequestFullscreen();
			}
		}
	} else {
		// Enter fullscreen
		is_fullscreen = true;
		if(is_mobile_device()){
			document.getElementById("game-player").style.display = "block";
			game.style.position = "fixed";
			document.getElementById("mobile-back-button").style.display = "flex";
		} else {
			if (game.requestFullscreen) {
				game.requestFullscreen();
			} else if (game.mozRequestFullScreen) { /* Firefox */
				game.mozRequestFullScreen();
			} else if (game.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
				game.webkitRequestFullscreen();
			} else if (game.msRequestFullscreen) { /* IE/Edge */
				game.msRequestFullscreen();
			}
		}
	}
};
function is_mobile_device(){
	if (navigator.userAgent.match(/Android/i)
	|| navigator.userAgent.match(/webOS/i)
	|| navigator.userAgent.match(/iPhone/i)
	|| navigator.userAgent.match(/iPad/i)
	|| navigator.userAgent.match(/iPod/i)
	|| navigator.userAgent.match(/BlackBerry/i)
	|| navigator.userAgent.match(/Windows Phone/i)) {
		return true;
	} else {
		return false;
	}
}
if($('iframe#game-area').length){
	load_leaderboard({type: 'top', amount: 10});
	drag_back_btn(document.getElementById("mobile-back-button"));
	if(is_mobile_device()){
		if($('#allow_mobile_version').length){
			document.getElementById('mobile-play').style.display = 'block';
			document.getElementById('game-player').style.display = 'none';
		}
	}
}
function drag_back_btn(elem) {
	let is_drag = false;
	let pos_1 = 0, pos_2 = 0;
	let last_y = elem.style.top;
	let touchstart_y = 0;
	elem.addEventListener("touchend", function(e) {
		if(is_drag){
			is_drag = false;
		}
	}, false);
	elem.addEventListener("touchmove", function(e) {
		e.preventDefault();
		let touch = e.changedTouches[0];
		if(!is_drag){
			if(touchstart_y < touch.clientY+5 || touchstart_y > touch.clientY-5){
				// Trigger "dragstart"
				pos_2 = e.clientY;
				is_drag = true;
			}
		}
		if(is_drag){
			pos_1 = pos_2 - touch.clientY;
			pos_2 = touch.clientY;
			elem.style.top = (pos_2) + "px";
		}
	}, false);
	elem.addEventListener("touchstart", function(e) {
		let touch = e.changedTouches[0];
		last_y = elem.style.top;
		touchstart_y = touch.clientY;
	}, false);
	elem.addEventListener("click", function(e) {
		e.preventDefault();
		if(last_y == elem.style.top){
			open_fullscreen();
		}
	}, false);
}
function load_leaderboard(conf){
	if($('#content-leaderboard').length){
		let g_id = $('#content-leaderboard').data('id');
		$.ajax({
			url: '/includes/api.php',
			type: 'POST',
			dataType: 'json',
			data: {'action': 'get_scoreboard', 'game-id': g_id, 'conf': JSON.stringify(conf)},
			complete: function (data) {
				if(data.responseText){
					if(JSON.parse(data.responseText).length){
						show_leaderboard(JSON.parse(data.responseText));
					}
				}
			}
		});
	}
}
function show_leaderboard(data){
	let html = '<table class="table table-striped table-dark"><thead class="thead-dark"><tr><th scope="col">#</th><th scope="col">Username</th><th scope="col">Score</th><th scope="col">Date</th></tr></thead><tbody>';
	let index = 1;
	data.forEach((item)=>{
		html += '<tr><th scope="row">'+index+'</th><td>'+item.username+'</td><td>'+item.score+'</td><td>'+item.created_date.substr(0, 10)+'</td></tr>';
		index++;
	});
	html += '</tbody></table>';
	$('#content-leaderboard').html(html);
}
(function(){
	$('#mobile-play-btn').on('click', function(e) {
		open_fullscreen();
	});
	$('.b-action #favorite').on('click', function(e) {
		e.preventDefault();
		let data_id = $('.game-content').attr('data-id');
		let btn = $(this);
		$.ajax({
			url: '/includes/vote.php',
			type: 'POST',
			dataType: 'json',
			data: {'favorite': true, 'action': 'favorite', 'id': data_id},
			success: function (data) {
				//console.log(data.responseText);
			},
			error: function (data) {
				//console.log(data.responseText);
			},
			complete: function (data) {
				console.log(data.responseText);
				btn.addClass('active');
				btn.addClass('disabled');
			}
		});
	});
	$('.b-action #upvote').on('click', function(e) {
		e.preventDefault();
		let data_id = $('.game-content').attr('data-id');
		let btn = $(this);
		$.ajax({
			url: '/includes/vote.php',
			type: 'POST',
			dataType: 'json',
			data: {'vote': true, 'action': 'upvote', 'id': data_id},
			success: function (data) {
				//console.log(data.responseText);
			},
			error: function (data) {
				//console.log(data.responseText);
			},
			complete: function (data) {
				console.log(data.responseText);
				btn.addClass('active');
				btn.addClass('disabled');
			}
		});
	});
	$('.b-action #downvote').on('click', function(e) {
		e.preventDefault();
		let data_id = $('.game-content').attr('data-id');
		let btn = $(this);
		$.ajax({
			url: '/includes/vote.php',
			type: 'POST',
			dataType: 'json',
			data: {'vote': true, 'action': 'downvote', 'id': data_id},
			success: function (data) {
				//console.log(data.responseText);
			},
			error: function (data) {
				//console.log(data.responseText);
			},
			complete: function (data) {
				console.log(data.responseText);
				btn.addClass('active');
				btn.addClass('disabled');
			}
		});
	});
	$('.user-avatar').on('click', function(){
		
		let element = $(this).next();
		if (element.is(":hidden")) {
			element.removeClass('hidden');
		} else element.addClass('hidden');
	});
	$('#btn_prev').on('click', function() {
		$('.profile-gamelist ul').animate({
			scrollLeft: '-=150'
		}, 300, 'swing');
	});
	$('#btn_next').on('click', function() {
		$('.profile-gamelist ul').animate({
			scrollLeft: '+=150'
		}, 300, 'swing');
	});
	$('#f_prev').on('click', function() {
		$('.favorite-gamelist ul').animate({
			scrollLeft: '-=150'
		}, 300, 'swing');
	});
	$('#f_next').on('click', function() {
		$('.favorite-gamelist ul').animate({
			scrollLeft: '+=150'
		}, 300, 'swing');
	});
	$('#t-prev').on('click', function() {
		$('.list-1-wrapper').animate({
			scrollLeft: '-=150'
		}, 300, 'swing');
	});
	
	$('#t-next').on('click', function() {
		$('.list-1-wrapper').animate({
			scrollLeft: '+=150'
		}, 300, 'swing');
	});
	$('.delete-comment').on('click', function() {
		let id = $(this).attr('data-id');
		$.ajax({
			url: '/includes/comment.php',
			type: 'POST',
			dataType: 'json',
			data: {'delete': true, 'id': id},
			success: function (data) {
				//console.log(data.responseText);
			},
			error: function (data) {
				//console.log(data.responseText);
			},
			complete: function (data) {
				if(data.responseText === 'deleted'){
					$('.id-'+id).remove();
				}
			}
		}, this);
	});
	let game_id;
})();

document.addEventListener("DOMContentLoaded", function () {
    // Toggle submenu on click
    document.querySelectorAll('.dropdown-submenu > a').forEach(function (element) {
        element.addEventListener('click', function (e) {
            // Prevent default action and stop event propagation
            e.preventDefault();
            e.stopPropagation();

            let submenu = this.nextElementSibling;
            submenu.classList.toggle('show'); // Toggle 'show' class to display or hide submenu
        });
    });

    // Close all submenus when the parent dropdown is closed
    document.querySelectorAll('.dropdown').forEach(function (dropdown) {
        dropdown.addEventListener('hide.bs.dropdown', function () {
            this.querySelectorAll('.submenu').forEach(function (submenu) {
                submenu.classList.remove('show');
            });
        });
    });

    // Stop click events inside dropdown from closing the dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
});

if ($('#tpl-comment-section').length) {
	const gameId = $('#tpl-comment-section').attr('data-id');
	const commentSystem = new CommentSystem(gameId);
}
$(function() {
	const formSearch = document.querySelector("form.search-bar");
	if (formSearch) {
		formSearch.addEventListener("submit", function(event) {
			event.preventDefault();
			const input = formSearch.querySelector("input[name='slug']");
			const sanitizedValue = input.value.replace(/ /g, "-");
			input.value = sanitizedValue;
			if (input.value.length >= 2) {
				formSearch.submit();
			}
		});
	}
	// Load more games
	let last_offset = 0;
	let load_amount = 0;
	const newGamesContainer = $('#new-games-section');

	if (newGamesContainer.length) {
	    load_amount = newGamesContainer.children().length;
	    last_offset = newGamesContainer.children().length;
	    if (load_amount < 12) {
	        $('.btn-load-more-games').remove();
	    } else {
	        $('.btn-load-more-games').click(() => {
	            fetchMoreGames(load_amount, 'new');
	        });
	    }
	}

	async function fetchMoreGames(amount, sort_by) {
	    try {
	        const response = await $.ajax({
	            url: "/includes/fetch.php",
	            type: 'POST',
	            dataType: 'json',
	            data: {amount: amount, offset: last_offset, sort_by: sort_by},
	        });
	        appendFetchedGames(response);
	    } catch (error) {
	        console.log(error);
	    }
	}

	function appendFetchedGames(data) {
		let gameUrlStructure = '/{{}}/{{}}';
	    last_offset += data.length;
	    const templateHTML = $('.item-append-template').html();  // Get the inner HTML of the template
	    console.log(templateHTML);
	    data.forEach((item) => {
	    	let rating = 0;
			item['upvote'] = Number(item['upvote']);
			item['downvote'] = Number(item['downvote']);
			let totalRevs = item['upvote']+item['downvote'];
			if(totalRevs > 0){
				rating = (Math.round((item['upvote']/(item['upvote']+item['downvote'])) * 5));
			}
	        // Clone the HTML template
	        let clonedHTML = templateHTML;
	        // Replace placeholders
	        clonedHTML = clonedHTML.replace(/{{slug}}/g, item['slug']);
			clonedHTML = clonedHTML.replace(/{{thumbnail}}/g, item['thumb_2']);
			clonedHTML = clonedHTML.replace(/{{title}}/g, item['title']);
			clonedHTML = clonedHTML.replace(/{{rating}}/g, rating);
	        // Convert the HTML string to a jQuery object
	        const clonedElement = $(clonedHTML);
	        // Further modifications if necessary, for example, replacing the rating image src
	        // Append the new element to newGamesContainer
	        newGamesContainer.append(clonedElement);
	    });
	    if (data.length < load_amount) {
	        $('.btn-load-more-games').remove();
	    }
	}
	// End
	var $nav = $('nav.greedy');
	var $btn = $('nav.greedy button');
	var $vlinks = $('nav.greedy .links');
	var $hlinks = $('nav.greedy .hidden-links');

	var numOfItems = 0;
	var totalSpace = 0;
	var breakWidths = [];

	// Get initial state
	$vlinks.children().outerWidth(function(i, w) {
		totalSpace += w;
		numOfItems += 1;
		breakWidths.push(totalSpace);
	});

	var availableSpace, numOfVisibleItems, requiredSpace;

	function check() {

		// Get instant state
		availableSpace = $vlinks.width() - 10;
		numOfVisibleItems = $vlinks.children().length;
		requiredSpace = breakWidths[numOfVisibleItems - 1];

		// There is not enought space
		if (requiredSpace > availableSpace) {
			$vlinks.children().last().prependTo($hlinks);
			numOfVisibleItems -= 1;
			check();
			// There is more than enough space
		} else if (availableSpace > breakWidths[numOfVisibleItems]) {
			$hlinks.children().first().appendTo($vlinks);
			numOfVisibleItems += 1;
		}
		// Update the button accordingly
		$btn.attr("count", numOfItems - numOfVisibleItems);
		if (numOfVisibleItems === numOfItems) {
			$btn.addClass('hidden');
		} else $btn.removeClass('hidden');
	}

	// Window listeners
	$(window).resize(function() {
		check();
	});

	$btn.on('click', function() {
		$hlinks.toggleClass('hidden');
	});

	check();

});