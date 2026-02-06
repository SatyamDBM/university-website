<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;

class CmsPageController extends Controller
{
    public function show(string $slug)
    {
        $page = CmsPage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('cms.page', compact('page'));
    }
}
