<?php

namespace ddouggs\event_manager;

use ddouggs\event_manager\Event;

abstract class Events
{
    public static $events = array();

    // Registra evento
    public function register(string $name, Event $event)
    {
        if (isset($name) && !empty($name)) {
            self::$events[$name] = $event;
            return true;
        }
        return false;
    }

    // Acessa evento
    public function access(string $name)
    {
        if (isset(self::$events[$name])) {
            return self::$events[$name];
        }
        return null;
    }
}
