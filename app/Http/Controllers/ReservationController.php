<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterDishesByRestaurantRequest;
use App\Http\Requests\FilterRestaurantsByMealRequest;
use App\Http\Requests\SaveDataReservationRequest;
use App\Http\Requests\Step3Request;
use App\Models\SampleData;
use App\Services\Reservation\FilterRestaurantTask;
use App\Services\Reservation\ReservationTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReservationController extends Controller
{

    protected $service;

    public function __construct(ReservationTask $service)
    {
        $this->service = $service;
    }

    /**
     * Show tabs reservation
     */
    public function show()
    {
        try {
            $data['meals'] = $this->service->getMeals();

            return view('reservation', $data);
        } catch (Exception $e) {

            return back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Filter restaurants by meal
     * 
     * @return Response
     * 
     * @throws Exception
     */
    public function filterRestaurantsByMeal(FilterRestaurantsByMealRequest $request)
    {
        try {
            $results = $this->service->filterRestaurantsByMeal($request->meal);

            return Response::json($results);
        } catch (Exception $e) {

            return Response::json($e->getMessage());
        }
    }

    /**
     * Filter dishes by restaurant
     * 
     * @return Response
     * 
     * @throws Exception
     */
    public function filterDishesByRes(FilterDishesByRestaurantRequest $request)
    {
        try {
            $params = $request->only([
                'meal',
                'restaurant',
            ]);

            $results = $this->service->filterDishesByRes($params);

            return Response::json($results);
        } catch (Exception $e) {

            return Response::json($e->getMessage());
        }
    }

    /**
     * Filter dishes by restaurant
     * 
     * @return Response
     * 
     * @throws Exception
     */
    public function validateStep3(Step3Request $request)
    {
        return Response::json($request->all());
    }

    /**
     * Save data reservation form
     * 
     * @throws Exception
     */
    public function submitReservation(SaveDataReservationRequest $request)
    {
        try {
            $params = $request->only([
                'meal',
                'restaurant',
                'amount_people',
                'dishes',
                'quantities',
            ]);

            $this->service->saveDataReservation($params);

            return redirect()->route('reservations');
        } catch (Exception $e) {

            return Response::json($e->getMessage());
        }
    }

    /**
     * get list reservations
     * 
     * @return array
     * 
     * @throws Exception
     */
    public function index()
    {
        try {
            $data['data'] = $this->service->getReservations();

            return view('index', $data);
        } catch (Exception $e) {

            return Response::json($e->getMessage());
        }
    }
}
