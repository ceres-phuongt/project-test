<?php


namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Models\Car;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $listCar = Car::search($keyword)->paginate(10);

        return view('frontend/theme::theme.search', compact('listCar'));
    }
}
