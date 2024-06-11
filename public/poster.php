<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if(isset($_GET['posterId']) && ctype_digit($_GET['posterId'])) {
        $poster = \Entity\Poster::findById((int)$_GET['posterId']);
    } else {
        throw new ParameterException("L'identifiant du poster n'est pas correct");
    }
    header('Content-Type: image/jpeg');
    echo $poster->getJpeg();
} catch (EntityNotFoundException | ParameterException) {
    header('Location: /img/default.png');
} catch (Exception) {
http_response_code(500);
}