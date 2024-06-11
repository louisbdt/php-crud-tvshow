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

$webpage->setTitle($webpage->escapeString($season->getName()));

$webpage->appendContent(
    <<<HTML
        <div class="seasonList">
            <img src="poster.php?posterId={$season->getPosterId()}">
            <div class="season_names">
                    <a href="http://localhost:8000/tvshow.php?tvshowId={$season->getTvShowId()}" alt="">
                    <span class="season_name">{$season->getName()}</span>
                    </a>
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
                <span class="episode_number">{$episode->getId()}</span>
                <span class="episode_title">{$episode->getName()}</span>
                <span class="episode_overview">{$episode->getOverview()}</span>
            </div>
        HTML
    );
}

echo $webpage->toHTML();

