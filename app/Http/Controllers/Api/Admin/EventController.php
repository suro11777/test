<?php


namespace App\Http\Controllers\Api\Admin;


use App\Services\Admin\EventService;

class EventController extends BaseController
{
    /**
     * EventController constructor.
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->baseService = $eventService;
    }

    /**
     * @return mixed
     */
    public function getAllEvents()
    {
        $events = $this->baseService->getAllEvents();
        return $events;
    }

}
