<?php

namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Repositories\Interfaces\CarInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * [$carRepository description]
     * @var [type]
     */
    protected $carRepository;
    public function __construct(CarInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function cart()
    {
        $cookieData = stripslashes(Cookie::get('cart'));
        $cartData = json_decode($cookieData, true);

        return view('frontend/theme::theme.cart', compact('cartData'));
    }

    public function addToCart(Request $request)
    {

        $carId = $request->input('carId');
        $quantity = $request->input('quantity');

        if (Cookie::get('cart')) {
            $cookieData = stripslashes(Cookie::get('cart'));
            $cartData = json_decode($cookieData, true);
        } else {
            $cartData = array();
        }

        $listItemId = array_column($cartData, 'id');

        if (in_array($carId, $listItemId)) {
            foreach ($cartData as $key => $values) {
                if ($cartData[$key]["id"] == $carId) {
                    $newQuantity = (int) $cartData[$key]["quantity"] + $quantity;
                    $cartData[$key]["quantity"] = $newQuantity;

                    $dataItem = json_encode($cartData);
                    $minutes = 30*24*60;

                    Cookie::queue(Cookie::make('cart', $dataItem, $minutes));

                    return response()->json(
                        ['status'=> $cartData[$key]["name"] . ' added to Cart']
                    );
                }
            }
        } else {
            $car = $this->carRepository->find($carId);

            if ($car) {
                $name = $car->name;
                $price = $car->price;

                $arrItem = array(
                'id'       => $carId,
                'name'     => $name,
                'quantity' => $quantity,
                'price'    => $price,
                );

                $cartData[] = $arrItem;

                $dataItem = json_encode($cartData);
                $minutes = 24 * 30 * 60;
                Cookie::queue(Cookie::make('cart', $dataItem, $minutes));

                return response()->json(['status'=> $name . ' Added to Cart']);
            }
        }
    }

    public function loadAjaxCart()
    {
        if (Cookie::get('cart')) {
            $cookieData = stripslashes(Cookie::get('cart'));
            $cartData = json_decode($cookieData, true);
            $totalCart = count($cartData);

            echo json_encode(array('totalCart' => $totalCart));
            die;
            return;
        } else {
            $totalCart = "0";

            echo json_encode(array('totalCart' => $totalCart));
            die;
            return;
        }
    }

    public function updateCart(Request $request)
    {

        $carId = $request->input('carId');
        $quantity = $request->input('quantity');

        if (Cookie::get('cart')) {
            $cookieData = stripslashes(Cookie::get('cart'));
            $cartData = json_decode($cookieData, true);
        } else {
            $cartData = array();
        }

        $listItemId = array_column($cartData, 'id');

        if (in_array($carId, $listItemId)) {
            foreach ($cartData as $key => $values) {
                if ($cartData[$key]["id"] == $carId) {
                    $cartData[$key]["quantity"] = $quantity;

                    $dataItem = json_encode($cartData);
                    $minutes = 30*24*60;

                    Cookie::queue(Cookie::make('cart', $dataItem, $minutes));
                }
            }
        } else {
            $car = $this->carRepository->find($carId);

            if ($car) {
                $name = $car->name;
                $price = $car->price;

                $arrItem = array(
                'id'       => $carId,
                'name'     => $name,
                'quantity' => $quantity,
                'price'    => $price,
                );

                $cartData[] = $arrItem;

                $dataItem = json_encode($cartData);
                $minutes = 24 * 30 * 60;
                Cookie::queue(Cookie::make('cart', $dataItem, $minutes));
            }
        }
        $cookieData = stripslashes(Cookie::get('cart'));
        $cartData = json_decode($cookieData, true);

        $html = view('frontend/theme::theme.cartAjax', compact('cartData'))->render();
        return response()->json(['html' => $html]);
    }

    public function removeFromCart(Request $request)
    {
        $carId = $request->input('carId');

        if (Cookie::get('cart')) {
            $cookieData = stripslashes(Cookie::get('cart'));
            $cartData = json_decode($cookieData, true);
        } else {
            $cartData = array();
        }

        $listItemId = array_column($cartData, 'id');

        if (in_array($carId, $listItemId)) {
            foreach ($cartData as $key => $values) {
                if ($cartData[$key]["id"] == $carId) {
                    unset($cartData[$key]);

                    $dataItem = json_encode($cartData);
                    $minutes = 30*24*60;

                    Cookie::queue(Cookie::make('cart', $dataItem, $minutes));
                }
            }
        }

        $newData = stripslashes(Cookie::get('cart'));
        $newCartData = json_decode($cookieData, true);

        $html = view('frontend/theme::theme.cartAjax', compact('newCartData'))->render();
        return response()->json(['html' => $html]);
        // return;
    }
}
