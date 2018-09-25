<?php

$url = 'http://news.yahoo.com/iphone-camera-good-photojournalist-using-cover-olympics-191007578.html';

//get html source code
$webSource = file_get_contents($url);

//get title
$title = getTitle($webSource);

//get the content of the article
$content = getContent($webSource);


//Display the scraped data
echo $url . '<br />';
//echo $websource . '<br />';
echo $title . "<br />";
echo $content . "<br />";

function getTitle($webSource)
{
    $title;

    //search for the <h1 class="headline">
    $split = explode('<h1 class="headline">',$webSource);

    /* Split[0] will contain all the text before '<h1 class="headline">', and split[1] will contain everything after it */

    //if <h1 class="headline"> is found
    if(count($split) > 1)
    {
        //find the end of the title </h1>
        $end = explode('</h1>', $split[1]);

        /* end[0] will contain all the text after '<h1 class="headline">' and before </h1>, and end[1] will contain everything after it */

        //title should be in the first part
        $title = $end[0];
    }
    else
    {
        return "";
    }

    return trim($title);
}



function getContent($webSource)
{
    $content = '';
    $split = explode('<p class="first">',$webSource);

    if(count($split) > 1)
    {
        $end = explode('</p>',$split[1]);
        $content = $end[0];
    }
    else
    {
        return "";
    }

    return trim($content);
}
?>
