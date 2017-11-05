var addingPlaylistId = "INSERT-PLAYLIST-ID-HERE";

var innerWindowHeight = window.innerHeight;
var innerWindowWidth = window.innerWidth;
var currentVideo = 0;

var menu = false;

var previouslyVideo = getCookie("PreviouslyVideo");
if(previouslyVideo == null){
	previouslyVideo = "No Previously Video";
}

$(document).ready(function(){
	$(window).load(function(){
		$("#LoadingScreen_Wrapper").hide();
	});
	$("#AddtoPlaylist_Wrapper").hide();
	$("#Last_Video_Button").hide();
	$("#Menu_Button").click(function(){
		if(menu == false){
			$("#Menu_Wrapper").show();
			menu = true;
		}
		else {
			$("#Menu_Wrapper").hide();
			menu = false;
		}
	});
	if($("#Authorize_Text_Wrapper").children().length == 0){
    	$("#Authorize_Wrapper").hide();
	}
	else {
		var authorizeLink = $("#Authorize_Text_Wrapper p a").attr("href");
		$("#Authorize_Text_Wrapper").empty();
		$("#Authorize_Text_Wrapper").append("<br><p id='Authorize_Text_U' class='sr_font'>You have to </p><div id='Authorize_Button' class='sr_font'><a href="+authorizeLink+">Authorize this App</a></div><p id='Authorize_Text_Use' class='sr_font'>to use it</p>");
		$("#Authorize_Wrapper").show();
	}
});

function playlistEnabled(){
	$('.post-auth').show();
	$("#Nav_Authorize_Wrapper").fadeOut(250);
	$("#Nav_Authorized_Wrapper").fadeIn(250).delay(1000).fadeOut(250);
}

function createVideoPlayer(videoList){
	videoTitlePlayer = "<p class='video_title_player sr_font'>"+videoList[currentVideo].vT+"</p><p class='channel_title_player sr_font'>"+videoList[currentVideo].cT+"</p>"
	addtoPlaylist = "<a href='javascript:addVideoToPlaylist()'><div id='AndToPlaylist_Button'><p class='sr_font'>Add to Playlist</p></div><div id='AddToPlaylist_Icon' class='sr_sfa_addto_playlist'></div></a>";
	outputPreviouslyVideo = "<p id='Previously_Watched_Headline'>Previously watched</p><p id='Previously_Watched_Title'>"+previouslyVideo+"</p><a href='javascript:setPreviouslyVideo("+videoList[currentVideo].vN+")'><div id='Previously_Watched_Button'><p id='Previously_Watched_Button_Text'>Set Previously watched Video</p></div></a>";
	if(currentVideo == 0){
		if(innerWindowWidth > 1100){
			video = "<iframe class='player' type='text/html' width='1010' height='568.125' src='http://www.youtube.com/embed/"+videoList[currentVideo].id+"' frameborder='0' allowfullscreen></iframe>";
		}
		if(innerWindowWidth < 1100){
			video = "<iframe class='player' type='text/html' src='http://www.youtube.com/embed/"+videoList[currentVideo].id+"' frameborder='0' allowfullscreen></iframe>";
		}

	}
	else{
		if(innerWindowWidth > 1100){
				video = "<iframe class='player' type='text/html' width='1010' height='568.125' src='http://www.youtube.com/embed/"+videoList[currentVideo].id+"?autoplay=1' frameborder='0' allowfullscreen></iframe>";
		}
		if(innerWindowWidth < 1100){
				video = "<iframe class='player' type='text/html' src='http://www.youtube.com/embed/"+videoList[currentVideo].id+"?autoplay=1' frameborder='0' allowfullscreen></iframe>";
		}
	}
	$("#Player_Wrapper").prepend(videoTitlePlayer);
    $("#Player").append(video);
	$("#AddtoPlaylist_Wrapper").append(addtoPlaylist);
	$("#Previously_Watched_Wrapper").empty();
	$("#Previously_Watched_Wrapper").append(outputPreviouslyVideo);
}

function enableAddToPlaylistButton(){
	$("#AndToPlaylist_Button_Disabled").hide();
	$("#AndToPlaylist_Button").show();
	setTimeout(function(){$(".post-auth").fadeOut(1000);}, 5000);
}

function LastVideo() {
	$(".video_title_player, .channel_title_player").remove();
	$("#Player, #AddtoPlaylist_Wrapper").empty();
	currentVideo -= 1;
	if(currentVideo <= 0){
		if(innerWindowWidth > 1280){
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").show();
			$("#Last_Video_Icon").hide();
			$("#Next_Video_Icon").hide();
		}
		else {
			$("#Last_Video_Icon").hide();
			$("#Next_Video_icon").show();
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").hide();
		}
	}
	else {
		if(innerWindowWidth > 1280){
			$("#Last_Video_Button").show();
			$("#Next_Video_Button").show();
			$("#Last_Video_Icon").hide();
			$("#Next_Video_Icon").hide();
		}
		else {
			$("#Last_Video_Icon").show();
			$("#Next_Video_Icon").show();
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").hide();
		}
	}
	createVideoPlayer(videoList);
}

function NextVideo() {
	$(".video_title_player, .channel_title_player").remove();
	$("#Player, #AddtoPlaylist_Wrapper").empty();
	currentVideo += 1;
	if(currentVideo >= videoList.length-1){
		if(innerWindowWidth > 1280){
			$("#Last_Video_Button").show();
			$("#Next_Video_Button").hide();
			$("#Last_Video_Icon").hide();
			$("#Next_Video_icon").hide();
		}
		else {
			$("#Last_Video_Icon").show();
			$("#Next_Video_icon").hide();
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").hide();
		}
	}
	else {
		if(innerWindowWidth > 1280){
			$("#Last_Video_Button").show();
			$("#Next_Video_Button").show();
			$("#Last_Video_Icon").hide();
			$("#Next_Video_Icon").hide();
		}
		else {
			$("#Last_Video_Icon").show();
			$("#Next_Video_Icon").show();
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").hide();
		}
	}
	createVideoPlayer(videoList);
}

function thisVideo(h) {
	$(".video_title_player, .channel_title_player").remove();
	$("#Player, #AddtoPlaylist_Wrapper").empty();
	currentVideo = h;
	if(currentVideo <= 0){
		if(innerWindowWidth > 1280){
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").show();
			$("#Last_Video_Icon").hide();
			$("#Next_Video_icon").hide();
		}
		else {
			$("#Last_Video_Icon").hide();
			$("#Next_Video_icon").show();
			$("#Last_Video_Button").hide();
			$("#Next_Video_Button").hide();
		}
	}
	else {
		if(currentVideo >= videoList.length-1){
			if(innerWindowWidth > 1280){
				$("#Last_Video_Button").show();
				$("#Next_Video_Button").hide();
				$("#Last_Video_Icon").hide();
				$("#Next_Video_icon").hide();
			}
			else {
				$("#Last_Video_Icon").show();
				$("#Next_Video_icon").hide();
				$("#Last_Video_Button").hide();
				$("#Next_Video_Button").hide();
			}
		}
		else {
			if(innerWindowWidth > 1280){
				$("#Last_Video_Button").show();
				$("#Next_Video_Button").show();
				$("#Last_Video_Icon").hide();
				$("#Next_Video_icon").hide();
			}
			else {
				$("#Last_Video_Icon").show();
				$("#Next_Video_icon").show();
				$("#Last_Video_Button").hide();
				$("#Next_Video_Button").hide();
			}
		}
	}
	createVideoPlayer(videoList);
}

var current_page = 1;
var records_per_page = 15;

function prevPage(){
	if (current_page > 1) {
		current_page--;
		changePage(current_page);
	}
}

function nextPage(){
	if (current_page < numPages()) {
		current_page++;
		changePage(current_page);
	}
}

function prevTen(){
	if (current_page > 1) {
		current_page -= 10;
		if(current_page < 1){
			current_page = 1;
		}
		changePage(current_page);
	}
}

function nextTen(){
	if (current_page < numPages()){
		current_page += 10;
		if(current_page > numPages()){
			current_page =  numPages();
		}
		changePage(current_page);
	}
}

function changePage(page){
	var btn_next = document.getElementById("Next_Page_Button");
	var btn_next_10 = document.getElementById("Next_10_Button");
	var btn_prev = document.getElementById("Prev_Page_Button");
	var btn_prev_10 = document.getElementById("Prev_10_Button");
	var listing_table = document.getElementById("Subs_Feed_Wrapper");
	var page_span = document.getElementById("Pagesite_Title");
	if (page < 1) page = 1;
	if (page > numPages()) page = numPages();
	listing_table.innerHTML = "";
	for (var i = (page-1) * records_per_page; i < (page * records_per_page) && i < videoList.length; i++) {
		var vN = videoList[i]["vN"];
		listing_table.innerHTML += "<div id='Sub_Video'><div class='text_s channel_title sr_font'>"+videoList[i].cT+"</div><a href='javascript:thisVideo("+vN+")' class='thumbnails_img'><img src='"+videoList[i].vTN+"'></a><a href='javascript:thisVideo("+vN+")' class='video_title sr_font'>"+videoList[i].vT+"</a></div>";
	}
	page_span.innerHTML ="Page " + page + " / " + numPages();
	if (page == 1) {
		btn_prev.style.visibility = "hidden";
		btn_prev_10.style.visibility = "hidden";
	} else {
		btn_prev.style.visibility = "visible";
		btn_prev_10.style.visibility = "visible";
	}

	if (page == numPages()) {
		btn_next.style.visibility = "hidden";
		btn_next_10.style.visibility = "hidden";
	} else {
		btn_next.style.visibility = "visible";
		btn_next_10.style.visibility = "visible";
	}
}

function numPages()
{
	return Math.ceil(videoList.length / records_per_page);
}

function addVideoToPlaylist(){
	addToPlaylist(videoList[currentVideo].id);
	$("#Added_To_Playlist_Message").fadeIn(250).delay(1500).fadeOut(250);
}

function addToPlaylist(id, startPos, endPos){
	var details = {
		videoId: id,
		kind: "youtube#video"
	}
	  if (startPos != undefined) {
	details['startAt'] = startPos;
  }
  if (endPos != undefined) {
	details['endAt'] = endPos;
  }
	var request = gapi.client.youtube.playlistItems.insert({
		part: "snippet",
		resource: {
			snippet: {
				playlistId: addingPlaylistId,
				resourceId: details
			}
		}
	}).execute();
}

function getCookie(cname){
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
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

function setPreviouslyVideo(newPreviouslyVideo){
	var cookieDate = new Date();
	cookieDate.setTime(cookieDate.getTime() + (365*24*60*60*1000));
	var cookieExpires = "expires="+cookieDate.toUTCString();

	var previouslyVideoPagePosition = newPreviouslyVideo/15;
	previouslyVideoPagePosition += 1;
	previouslyVideoPagePosition = Math.floor(previouslyVideoPagePosition);

	var cookiePreviouslyVideo = videoList[newPreviouslyVideo].vT+" on Page "+previouslyVideoPagePosition;
	document.cookie = "PreviouslyVideo="+cookiePreviouslyVideo+";" +cookieExpires;
	previouslyVideo = getCookie("PreviouslyVideo");

	outputPreviouslyVideo = "<p id='Previously_Watched_Headline'>Previously watched</p><p id='Previously_Watched_Title'>"+previouslyVideo+"</p><a href='javascript:setPreviouslyVideo("+videoList[currentVideo].vN+")'><div id='Previously_Watched_Button'><p id='Previously_Watched_Button_Text'>Set Previously watched Video</p></div></a>";
	$("#Previously_Watched_Wrapper").empty();
	$("#Previously_Watched_Wrapper").append(outputPreviouslyVideo);
}
