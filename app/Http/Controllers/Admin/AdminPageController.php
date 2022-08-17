<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
/**
 * show dashboard
 */
public function showDashboard()
{
    return view('admin.pages.dashboard');
}
}
