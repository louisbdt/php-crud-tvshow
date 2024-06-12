<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvshowCollection;
use Html\AppWebPage;

if (isset($_GET['genre']) && ctype_digit($_GET['genre'])) {
    $genreId = (int)$_GET['genre'];
    $line = TvshowCollection::findByGenreId($genreId);
} else {
    $line = TvshowCollection::findAll();
}





$webPage = new AppWebPage("TvShows");

$allgenre = GenreCollection::findAll();
$webPage->appendContent(<<<HTML
    <div class = "box_filter">
    <form class='filter' method ="GET" action="index.php">
        <label>
            Filtre par Genre
            <select name="genre">
HTML);

foreach ($allgenre as $genre) {
    $webPage->appendContent(<<<HTML
    <option value="{$genre->getId()}">{$genre->getName()}</option>
HTML);
}
$webPage->appendContent(<<<HTML
                
            </select>
        </label>
        <button type="submit">Enregistrer</button>
    </form>
    <a class ="rfilter" href='index.php'>Réinitialiser filtre</a>
    </div>
HTML);




$webPage->appendButton("img/ajout.png", "http://localhost:8000/admin/tvshow-form.php");
$webPage->appendContent('<div class="list">');

foreach ($line as $tvShow) {
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
