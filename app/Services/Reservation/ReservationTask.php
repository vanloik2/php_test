<?php

namespace App\Services\Reservation;

use App\Models\Reservation;
use App\Models\SampleData;
use App\Services\Task;
use Exception;

class ReservationTask extends Task
{

    protected $sampleData;
    protected $reservation;

    public function __construct(
        SampleData $sampleData,
        Reservation $reservation
    ) {
        $this->model = $sampleData;
        $this->reservation = $reservation;
    }

    /**
     * Get meals
     * 
     * @throws Exception
     */
    public function getMeals()
    {
        $meals = [];
        $this->model->getData()->each(function ($item) use (&$meals) {
            $meals[] = $item['availableMeals'] ?? [];
        });

        return array_unique(array_merge(...$meals));
    }

    /**
     * Filter restaurants by meal
     * 
     * @return array
     * 
     * @throws Exception
     */
    public function filterRestaurantsByMeal(string $meal)
    {
        $restaurants = [];
        $this->model->getData()->each(function ($item) use (&$restaurants, $meal) {
            if (
                !empty($item['availableMeals'])
                && is_array($item['availableMeals'])
                && in_array($meal, $item['availableMeals'])
            ) {
                $restaurants[] = $item['restaurant'] ?? '';
            }
        });

        return array_unique($restaurants);
    }

    /**
     * Filter restaurants by meal
     * 
     * @return array
     * 
     * @throws Exception
     */
    public function filterDishesByRes(array $params)
    {
        $dishes = [];
        $this->model->getData()->each(function ($item) use (&$dishes, $params) {
            if (
                !empty($item['availableMeals'])
                && is_array($item['availableMeals'])
                && in_array($params['meal'], $item['availableMeals'])
                && !empty($item['restaurant'])
                && $item['restaurant'] == $params['restaurant']
            ) {
                $dishes[] = $item['name'] ?? '';
            }
        });

        return array_unique($dishes);
    }

    /**
     * Save data reservation form
     * 
     * @return array
     * 
     * @throws Exception
     */
    public function saveDataReservation(array $params)
    {
        $reservations = $this->reservation->getData();
        $dishQuantity = [];
        foreach ($params['dishes'] as $i => $dish) {
            if (empty($dishQuantity[$dish])) {
                $dishQuantity[$dish] = $params['quantities'][$i];
            } else {
                $dishQuantity[$dish] = $dishQuantity[$dish] + $params['quantities'][$i];
            }
        }

        $data = [
            'meal' => $params['meal'],
            'restaurant' => $params['restaurant'],
            'amount_people' => $params['amount_people'],
            'dish_quantity' => $dishQuantity,
        ];

        $reservations[] = $data;

        $this->reservation->saveData($reservations);

        return $data;
    }

    /**
     * get reservations
     * 
     * @return collection
     * 
     * @throws Exception
     */
    public function getReservations()
    {
        return $this->reservation->getData();
    }
}
