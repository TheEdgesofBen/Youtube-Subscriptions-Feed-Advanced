<?
/*______________________________________________________________________________
Youtube Data Api Start
_____________________________________________________________________________ */
if($client->getAccessToken()) {
    $htmlBody2 = "";

    $subscriptionsResponse = $youtube->subscriptions->listSubscriptions('snippet', array(
      'mine' => 'true',
      'maxResults' => $maxSubscriptions
    ));

    foreach ($subscriptionsResponse['items'] as $subscriptions) {
        $subscriptionsId = $subscriptions['snippet']['resourceId']['channelId'];
        $subscriptionsTitle = $subscriptions['snippet']['title'];

        $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
            'id' => $subscriptionsId,
        ));

        foreach ($channelsResponse['items'] as $channel) {
            $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
            $playlistItemsParams = array(
                'playlistId'=> $uploadsListId,
                'maxResults'=> $minMaxResults
            );

            $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', $playlistItemsParams);
            foreach ($playlistItemsResponse['items'] as $playlistItem) {
                $callCounterResults += 1;
                $videoDate = $playlistItem['snippet']['publishedAt'];
                $channelTitle = $playlistItem['snippet']['channelTitle'];
                $videoTitle = $playlistItem['snippet']['title'];
                $videothumbnail = $playlistItem['snippet']['thumbnails']['medium']['url'];
                $videoId = $playlistItem['snippet']['resourceId']['videoId'];
                if($videoDate > $oldestDate){
                    $sorting[$videoNumber] = array(
                                             "id" => $videoId,
                                             "date" => $videoDate,
                                             "cT" => $channelTitle,
                                             "vT" => $videoTitle,
                                             "vTN" => $videothumbnail);
                    $videoNumber += 1;
                }
            }

            if($maxResults > 50 && $callCounterResults == 50){
                if($loopCounterResults == $orgLoopCounterResults){
                    if(isset($playlistItemsResponse['nextPageToken'])){
                        $next_page_token = $playlistItemsResponse['nextPageToken'];
                    }
                }
                while($loopCounterResults > 0){
                    $maxResults -= 50;
                    $playlistItemsParamsSecond = array(
                        'playlistId'=> $uploadsListId,
                        'maxResults'=> 50,
                        'pageToken' => $next_page_token
                    );

                    $playlistItemsResponseSecond = $youtube->playlistItems->listPlaylistItems('snippet', $playlistItemsParamsSecond);
                    foreach ($playlistItemsResponseSecond['items'] as $playlistItemSecond) {
                        $callCounterResults += 1;
                        $videoDate = $playlistItemSecond['snippet']['publishedAt'];
                        $channelTitle = $playlistItemSecond['snippet']['channelTitle'];
                        $videoTitle = $playlistItemSecond['snippet']['title'];
                        $videothumbnail = $playlistItemSecond['snippet']['thumbnails']['medium']['url'];
                        $videoId = $playlistItemSecond['snippet']['resourceId']['videoId'];
                        if($videoDate > $oldestDate){
                            $sorting[$videoNumber] = array(
                                                     "id" => $videoId,
                                                     "date" => $videoDate,
                                                     "cT" => $channelTitle,
                                                     "vT" => $videoTitle,
                                                     "vTN" => $videothumbnail);
                            $videoNumber += 1;
                        }
                    }
                    $loopCounterResults -= 1;
                    if(isset($playlistItemsResponseSecond['nextPageToken'])){
                        $next_page_token = $playlistItemsResponseSecond['nextPageToken'];
                    }
                }
            }
        }
        $maxResults = $orgMaxResults;
        $callCounterResults = 0;
        $loopCounterResults = $orgLoopCounterResults;
    }

    $_SESSION[$tokenSessionKey] = $client->getAccessToken();
}

/*______________________________________________________________________________
Youtube Data Api Items Sorting Function
_____________________________________________________________________________ */

$htmlBody2 .= sortingVideos($sorting, $videoNumber);

function sort_by_date($a, $b) {
    return ($a["date"]>$b["date"])?-1:1;
}

function sortingVideos($sorting="", $videoNumber=""){
    $nextVideoNumber = 0;
    usort($sorting,"sort_by_date");
    for($i = 0; $i < $videoNumber; $i++){
        $nextI = $i+1;
        if($sorting[$i]["vT"] != $sorting[$nextI]["vT"]){
            $newSorting[$nextVideoNumber]["id"] = $sorting[$i]["id"];
            $newSorting[$nextVideoNumber]["date"] = $sorting[$i]["date"];
            $newSorting[$nextVideoNumber]["cT"] = $sorting[$i]["cT"];
            $newSorting[$nextVideoNumber]["vT"] = $sorting[$i]["vT"];
            $newSorting[$nextVideoNumber]["vTN"] = $sorting[$i]["vTN"];
            $newSorting[$nextVideoNumber]["vN"] = $nextVideoNumber;
            $nextVideoNumber++;
        }
        else {
        }
    }
    $htmlBody3 = "<script type='text/javascript'>
        var videoList = ".json_encode($newSorting).";
        createVideoPlayer(videoList);
		changePage(1);
    </script>";
    return $htmlBody3;
}

?>
