# SR Subs Feed Advanced

Welcome the SR Subs Feed Advanced Web App.
This App will show you all subscripton videos of a Youtube Account without the Youtube algorithm that sort out some videos.

## How use the Web App

1. Select one of 6 Options.
    - Small Test: 4 Channels, 10 Videos per Channel, Published at 1-1-2017 or later
    - Middle Test: 10 Channels, 25 Videos per Channel, Published at 1-1-2017 or later
    - Big Test: 50 Channels, 100 Videos per Channel, Published at 1-1-2017 or later
    - Giant Test: 50 Channels, 500 Videos per Channel, Published at 1-1-2016 or later
    - BEM: 50 Channels, 250 Videos per Channel, Published at 1-1-2017 or later
    - **_Not possible right now_** Custom: You can choose Maximum Channels, Maximum Videos, Earliest Date possible 

2. Click on Authorize this App to Authorize this App.

3. Login or select the Google Account that should be used to show the subscription video of that account.

    *After that the Web App will call all Videos and create the Subs Feed. 
    This progress will go 5 sec - 10 min dependant on the number of possibel Videos.*

## How to get started

1. Create a Google API Console project

2. Create a CLIENT ID and CLIENT SECRET in the Google Console API 
    GUIDE -> https://developers.google.com/identity/sign-in/web/devconsole-project

3. Replace the placeholders in the Variables $OAUTH2_CLIENT_ID and $OAUTH2_CLIENT_SECRET in php/settings.php with your CLIENT ID and CLIENT SECRET

4. Replace the placeholder in the Variable OAUTH2_CLIENT_ID in js/auth.php with your CLIENT ID

5. Get the Google API PHP Client and insert the unpacked folder into the php folder
    Github Link -> https://github.com/google/google-api-php-client/releases/tag/v2.2.0
    
6. Replace the path in php/settings.php in line 126 with the right path to vendor/autoload.php in the Google API PHP Client folder

7. *OPTIONAL* to add Videos to a Playlist replace the placeholder in the addingPlaylistId Variable in the main.js file with the playlist id *(you can get that id in the playlist url https://www.youtube.com/playlist?list=PLAYLIST_ID_HERE)*
