<?php

require '../vendor/autoload.php';

use App\People;
use App\PeopleView;

$peopleView = new PeopleView($_REQUEST, 'https://x-24.io/DevTestData.json', 'FName', People::SORT_ORDER_ASCENDING);
extract($peopleView->getData());

include "../views/layout.php";
