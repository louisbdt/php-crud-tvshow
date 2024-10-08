<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\AppWebPage;
use Html\Form\TvShowForm;

try {
    $tvshow = null;
    if (isset($_GET["tvshowId"])) {
        if (ctype_digit($_GET["tvshowId"])) {
            $tvshowId = (int)$_GET["tvshowId"];
            $tvshow = TvShow::findById($tvshowId);
        } else {
            throw new ParameterException("Non conforme");
        }
    }
    $form = new TvShowForm($tvshow);
    $page = new AppWebPage("Ajout d'un TvShow");
    $page->appendContent($form->getHtmlForm('tvshow-save.php'));
    echo $page->toHTML() ;
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

