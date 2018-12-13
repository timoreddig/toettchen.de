<?php

return function ($site) {
    return $site->find('messages')->children()->visible();
};
