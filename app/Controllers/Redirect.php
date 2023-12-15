<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Redirect extends BaseController
{
    public function order() {
        return redirect()->to('/order');
    }
}
