<?php

use Entity\TvShow;
use Html\AppWebPage;
use Entity\Season;

if (isset($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
    $seasonId = (int)$_GET['seasonId'];
} else {
    header('Location: tvshow.php');
    exit();
}

try {
    $season = Season::findById($seasonId);
} catch (\Entity\Exception\EntityNotFoundException) {
    http_response_code(404);
    exit();
}

$webpage = new AppWebPage();

$tvshow = TvShow::findById($season->getTvShowId());

$webpage->setTitle($webpage->escapeString($tvshow->getName()). " : " .$webpage->escapeString($season->getName()));

$webpage->appendButton("Accueil", "http://localhost:8000/index.php");

$webpage->appendContent(
    <<<HTML
        <div class="seasonList">
            <div><img src="poster.php?posterId={$season->getPosterId()}"></div>
            <div class="season_names">
                    <a href="http://localhost:8000/tvshow.php?tvshowId={$season->getTvShowId()}">
                    <span class="tvshow_name">{$tvshow->getName()}</span>
                    </a>
                    <span class="season_name">{$season->getName()}</span>
            </div>
        </div>
    HTML
);
// <span class="season_show_name">{$seaso}</span> </a>

$episodes = $season->getEpisode();

foreach ($episodes as $episode) {
    $webpage->appendContent(
        <<<HTML
            <div class="episodes">
            <div class="title_number">
                <span class="episode_number">{$episode->getEpisodeNumber()} -</span>
                <span class="episode_title">{$episode->getName()}</span>
            </div>    
                <span class="episode_overview">{$episode->getOverview()}</span>
            </div>
        HTML
    );
}

echo $webpage->toHTML();

