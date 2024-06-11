<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (isset($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $tvshow = \Entity\TvShow::findById((int)$_GET['tvshowId']);
        $tvshow->delete();
        header('Location: /index.php');
    } else {
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
