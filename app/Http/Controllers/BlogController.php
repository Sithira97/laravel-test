<?php

namespace App\Http\Controllers;

use App\Traits\SlaggableTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    use SlaggableTrait;

    public function index() {

        $title = 'THis is a test title';
        $slag = $this->generateSlug($title);
        return $slag;
    }
}
