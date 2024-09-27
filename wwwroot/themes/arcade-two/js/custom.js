/*

Custom script

This file will not be overwritten by the updater

*/
"use strict";


function resizeContainer(){
	console.log(`resizeContainer()`);

    // device is mobile
    if(is_mobile_device()){
        return;
    }

    // // the game is compatible for mobile only
    // let data_is_portrait_only = $('.game-content').attr('data-is-mobile');
    // console.log(`data_is_portrait_only:${data_is_portrait_only}`);
    // let is_portrait_only = data_is_portrait_only != "0";
    // if(!is_portrait_only){
    //     return;
    // }
    
	let contentHeight = window.innerHeight;
    let contentOffsetTop = 0;
	console.log(`window.innerWidth:${window.innerWidth}`);
    let game_container = document.querySelector(".game-container");
    let game_content = document.querySelector(".game-content");
    let game_iframe_container = document.querySelector(".game-iframe-container");
    let game_iframe = document.querySelector(".game-iframe");
	if(game_content){
		console.log(`content.clientWidth:${game_content.clientWidth}`);
		console.log(`content.clientHeight:${game_content.clientHeight}`);
		console.log(`content.offsetTop:${game_content.offsetTop}`);
        contentOffsetTop = game_content.offsetTop;
		contentHeight = window.innerHeight - game_content.offsetTop;

        let single_title = document.querySelector(".single-title");
        let game_info = document.querySelector(".game-info");
        if( game_info && single_title && single_title.clientHeight > 0){
            console.log(`single_title.top:${single_title.getBoundingClientRect().top}, game_info.top:${game_info.getBoundingClientRect().top}, single_title.clientHeight:${single_title.clientHeight}`);
            contentHeight -= 5 + single_title.getBoundingClientRect().bottom - game_info.getBoundingClientRect().top;// (single_title.getBoundingClientRect().top - game_info.getBoundingClientRect().top) + single_title.clientHeight;
            console.log(`contentHeight:${contentHeight}`);
        }

        game_content.style.height = `${contentHeight}px`;
        game_content.style.minHeight = `320px`;

        // game_container.style.height = `${contentHeight}px`;
        game_iframe_container.style.height = `${contentHeight}px`;
        game_iframe.style.height = `${contentHeight}px`;

        let data_width = $('.game-content').attr('data-width');
        console.log(`data_width:${data_width}`);
        let data_height = $('.game-content').attr('data-height');
        console.log(`data_height:${data_height}`);

        let designWidth = parseFloat(data_width);
        let designHeight = parseFloat(data_height);

        if(designWidth < designHeight){
            game_iframe.style.width = `${contentHeight * designWidth/designHeight}px`;
            game_iframe.style.margin = `0 auto`;
        }
	}

//	resizeIframe();
}

document.addEventListener("DOMContentLoaded", function () {
    resizeContainer();
    window.addEventListener("load", ()=>{
        console.log(`window.event.onload`);
        resizeContainer();
    })
    window.addEventListener("resize", ()=>{
        console.log(`window.event.resize`);
        resizeContainer();
    })
});
