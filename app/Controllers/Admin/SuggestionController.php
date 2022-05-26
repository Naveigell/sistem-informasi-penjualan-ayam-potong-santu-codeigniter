<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Suggestion;

class SuggestionController extends BaseController
{
    public function index()
    {
        $suggestions = (new Suggestion())->withUser()->get()->getResultObject();

        return view('admin/pages/suggestion/index', compact('suggestions'));
    }
}
