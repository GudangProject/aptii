<?php

use App\Models\Admin\Configuration;

function website(){
    $data = Configuration::latest()->first();

    return $data;
}

