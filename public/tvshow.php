<?php

declare(strict_types=1);

use Html\AppWebPage;

if (isset($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
    $tvshowId = (int)$_GET['tvshowId'];
} else {
    header('Location: index.php');
    exit();
}

if (isset($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
    $seasonId = (int)$_GET['seasonId'];
} else {
    header('Location: index.php');
    exit();
}

try {
    $tvshow = TvShow::findById($tvshowId);
} catch (\Entity\Exception\EntityNotFoundException) {
    http_response_code(404);
    exit();
}

try {
    $season = \Entity\Season::findById($seasonId);
} catch (\Entity\Exception\EntityNotFoundException) {
    http_response_code(404);
    exit();
}

$webpage = new \Html\AppWebPage();

$webpage->setTitle("Séries TV : {$webpage->escapeString($tvshow->getName())}");

$posterSeason = $season->getPosterId();


$webpage->appendContent('<div class="List">');

$webpage->appendContent(
    <<<HTML
        <div class="showList">
            <img src="poster.php?{$tvshow->getPosterId()}">
            <span class="show_name">{$tvshow->getName()}</span>
            <span class="show_originalName">{$tvshow->getOriginalName()}</span>
            <span class="show_overview">{$tvshow->getOverview()}</span>
        </div>
    HTML
);

foreach ($season as $seasons) {
    $webpage->appendContent(
        <<<HTML
            <div class="season">
                <img src="poster.php?posterId={$season->getPosterId()}">
                <span class="seasonTitle">{$season->getName()}</span>
            </div>
       HTML
    );
}

echo $webpage->toHTML();
