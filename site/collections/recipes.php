<?php

return function ($site) {
    return $site->find('recipes')->children()->visible();
};
