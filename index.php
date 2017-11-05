<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
      	<meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SR Subs Feed Advanced</title>
        <link href="css/main_stylesheet.css" rel="stylesheet">
        <link href="css/content_stylesheet.css" rel="stylesheet">
    	<link href="css/sr_sfa_iconfonts_stylesheet.css" rel="stylesheet">
    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/auth.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="http://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    </head>
    <body>
        <?php

        require __DIR__."/php/settings.php";
        require __DIR__."/php/main.php";
        echo $errorOutput;

        ?>
        <div id="LoadingScreen_Wrapper"></div>
        <div id="Authorize_Wrapper">
            <div id="Authorize_Content_Wrapper">
                <p id="Authorize_Text_Welcome" class="sr_font">Welcome to</p>
                <div id="Authorize_Logo"></div>
                <div id="Authorize_Interaction_Wrapper">
                    <div id="Authorize_Text_Wrapper">
                        <? echo $htmlBody?>
                    </div>
                    <div class="breakline"></div>
                    <P id="Authorize_Settings_Headline" class="sr_font">Settings</p>
                    <P id="Authorize_Settings_Subheadline" class="sr_font">Click on one of the following Buttons to change Presettings</p>
                    <div id="Authorize_Settings_Wrapper">
                        <a class="sr_font authorize_settings_buttons" href="?smallTest"><p class="authorize_settings_buttons_text">Small Test</p></a>
                        <a class="sr_font authorize_settings_buttons" href="?middleTest"><p class="authorize_settings_buttons_text">Middle Test</p></a>
                        <a class="sr_font authorize_settings_buttons" href="?bigTest"><p class="authorize_settings_buttons_text">Big Test</p></a>
                        <a class="sr_font authorize_settings_buttons" href="?giantTest"><p class="authorize_settings_buttons_text">Giant Test</p></a>
                        <a class="sr_font authorize_settings_buttons" href="?bem"><p class="authorize_settings_buttons_text">BEM</p></a>
                        <a class="sr_font authorize_settings_buttons_disabled" ><p class="authorize_settings_buttons_disabled_text">Custom</p></a>
                    </div>
                </div>
                <p id="Authorize_App_Version" class="sr_font">Version 1.0</p>
                <div id="Authorize_More_Infos">
                    <p id="Authorize_Info" class="sr_font"><a href="https://github.com/SunsetRainfall/Youtube-Subscriptions-Feed-Advanced/blob/master/README.md" target="_blank">Info</a></p>
                    <p id="Authorize_About" class="sr_font"><a href="https://github.com/SunsetRainfall/Youtube-Subscriptions-Feed-Advanced/blob/master/about.md" target="_blank">About this Web App</a></p>
                </div>
            </div>
        </div>
        <div class="pre-auth">
            <a href="javascript:startingAuthJs()" id="login-link">
  		        <div id="Nav_Authorize_Wrapper">
          			<p id="Nav_Authorize_Headline">AUTHORIZE</p>
                    <p id="Nav_Authorize_Text">to add Videos to Playlist</p>
                    <div id="Addto_Authorize_Icon" class="sr_sfa_addto_authorize"></div>
      		    </div>
            </a>
      	</div>
        <div class="post-auth">
            <div id="Nav_Authorized_Wrapper">
                <div id="Addto_Authorized_Icon" class="sr_sfa_addto_authorized"></div>
            </div>
        </div>
        <div id="Added_To_Playlist_Message"><p>+</p></div>
        <div id="Navi_Wrapper_Rs">
    		<div id="Nav_Logo_Wrapper"><div id="Nav_Logo"></div></div>
    		<div id="Menu_Button">
    			<div id="Menu_Bar_Wrapper">
                    <div class="menu_bar"></div>
        			<div class="menu_bar"></div>
        			<div class="menu_bar"></div>
                </div>
    		</div>
            <div id="Menu_Wrapper">
                <div id="Links_Wrapper">
<!--                <p id="NewestVideo_Text" class="sr_font"><a href="#INFO">NEWEST VIDEOS</a></p>  -->
                    <p id="Info_Text" class="sr_font"><a href="https://github.com/SunsetRainfall/Youtube-Subscriptions-Feed-Advanced/blob/master/README.md" target="_blank">Info</a></p>
                    <p id="About_Text" class="sr_font"><a href="https://github.com/SunsetRainfall/Youtube-Subscriptions-Feed-Advanced/blob/master/about.md" target="_blank">About this Web App</a></p>
                </div>
                <P id="Navi_Settings_Headline" class="sr_font">Settings</p>
                <P id="Navi_Settings_Subheadline" class="sr_font">Click on one of the following Buttons to change Presettings</p>
                <div id="Navi_Settings_Wrapper">
                    <a class="sr_font navi_settings_buttons" href="?smallTest"><p class="navi_settings_buttons_text">Small Test</p></a>
                    <a class="sr_font navi_settings_buttons" href="?middleTest"><p class="navi_settings_buttons_text">Middle Test</p></a>
                    <a class="sr_font navi_settings_buttons" href="?bigTest"><p class="navi_settings_buttons_text">Big Test</p></a>
                    <a class="sr_font navi_settings_buttons" href="?giantTest"><p class="navi_settings_buttons_text">Giant Test</p></a>
                    <a class="sr_font navi_settings_buttons" href="?bem"><p class="navi_settings_buttons_text">BEM</p></a>
                </div>
                <div id="Previously_Watched_Wrapper" class="sr_font">
                    <p id="Previously_Watched_Headline">Previously watched</p>
                    <p id="Previously_Watched_Title">[PLACEHOLDER]</p>
                    <a><div id="Previously_Watched_Button"><p id="Previously_Watched_Button_Text">Set Previously watched Video</p></div></a>
                </div>
            </div>
    	</div>
        <div id="Main_Wrapper">
            <div id="Player_Wrapper">
                <div id="Player"></div>
                <? echo $player?>
            </div>
            <div id="Video_Options">
                <a href="javascript:LastVideo()"><div id="Last_Video_Button"><p class="sr_font">Last Video</p></div><div id="Last_Video_Icon" class="sr_sfa_last_video"></div></a>
                <a href="javascript:NextVideo()"><div id="Next_Video_Button"><p class="sr_font">Next Video</p></div><div id="Next_Video_Icon" class="sr_sfa_next_video"></div></a>
                <div id="AddtoPlaylist_Wrapper"></div>
                <p id="Pagesite_Title" class="sr_font">Page</p>
                <a href="javascript:nextTen()"><div id="Next_10_Button"><p class="sr_font">+10</p><div id="Next_10_Icon"></div></div></a>
                <a href="javascript:nextPage()"><div id="Next_Page_Button"><p class="sr_font">+1</p><div id="Next_Page_Icon"></div></div></a>
                <a href="javascript:prevPage()"><div id="Prev_Page_Button"><p class="sr_font">-1</p><div id="Prev_Page_Icon"></div></div></a>
                <a href="javascript:prevTen()"><div id="Prev_10_Button"><p class="sr_font">-10</p><div id="Prev_10_Icon"></div></div></a>
            </div>
            <div id="Subs_Feed_Wrapper"></div>
        </div>
        <? echo $htmlBody2?>
    </body>
</html>
