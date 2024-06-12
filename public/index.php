<?php

declare(strict_types=1);

use Entity\Collection\TvshowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage("TvShows");
$line = TvshowCollection::findAll();
$webPage->appendButton("img/ajout.png", "http://localhost:8000/admin/tvshow-form.php");
$webPage->appendContent('<div class="list">');

foreach ($line as $tvShow){
    $webPage->appendContent(<<<HTML
<div class="tvshow">
    <a class="tv" href="/tvshow.php?tvshowId={$tvShow->getId()}">
    <img class= "poster" src="poster.php?posterId={$tvShow->getPosterId()}" alt="Poster">
    <div class="tvshow__">
        <span class="name">{$webPage->escapeString($tvShow->getName())}</span>
        <span class="overview">{$webPage->escapeString($tvShow->getOverview())}</span>
    </div>
    </a>
</div>

HTML);
}
$webPage->appendContent('</div>');

echo $webPage->toHTML();