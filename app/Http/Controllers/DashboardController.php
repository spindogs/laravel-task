<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
