<?php

declare(strict_types=1);

use Entity\TvShow;
use Html\AppWebPage;

if (isset($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
    $tvshowId = (int)$_GET['tvshowId'];
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


$webpage = new \Html\AppWebPage();

$webpage->setTitle("{$webpage->escapeString($tvshow->getName())}");


$webpage->appendContent('<div class="List">');

$season = $tvshow->getSeason();

$webpage->appendContent(
    <<<HTML
        <div class="showList">
            <img src="poster.php?posterId={$tvshow->getPosterId()}">
            <div class="text">
                <div class="show_titles">
                    <span class="show_name">{$tvshow->getName()}</span>
                    <span class="show_originalName">{$tvshow->getOriginalName()}</span>
                </div>
                <span class="show_overview">{$tvshow->getOverview()}</span>
            </div>
        </div>
    HTML
);

foreach ($season as $seasons) {
    $webpage->appendContent(
        <<<HTML
            <a class="link_season" href="http://localhost:8000/season.php?seasonId={$seasons->getId()}">
            <div class="season">
                <img src="poster.php?posterId={$seasons->getPosterId()}">
                <span class="seasonTitle">{$seasons->getName()}</span>
            </div>
            <a/>
       HTML
    );
}

$webpage->appendContent('</div>');

echo $webpage->toHTML();

