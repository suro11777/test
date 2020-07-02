<?php


namespace App\Services\Admin;


use App\Models\Event;

class EventService extends BaseService
{
    /**
     * EventService constructor.
     */
    public function __construct(Event $event)
    {
        $this->set_model($event);
    }

    /**
     * @return mixed
     */
    public function getAllEvents()
    {
        $events = $this->baseModel->get(['id', 'name'])->pluck('name', 'id');
        return $events;
    }
}
