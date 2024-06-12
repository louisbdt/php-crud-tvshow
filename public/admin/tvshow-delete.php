<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TvShow;

try {
    if (isset($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $tvshow = TvShow::findById((int)$_GET['tvshowId']);
        $tvshow->delete();
        header('Location: /index.php');
        exit;
    } else {
        throw new ParameterException();
    }
} catch (ParameterException $e) {
    var_dump($e);
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
