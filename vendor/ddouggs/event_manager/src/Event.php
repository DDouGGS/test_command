<?php

namespace ddouggs\event_manager;

use ddouggs\event_manager\Observers;
use ddouggs\event_manager\EventInterface;

class Event implements EventInterface
{
    protected $observers;

    public function __construct()
    {
        $this->observers = new Observers();
    }

    // Adicionar observador para o evento
    public function attach(string $name, $observer)
    {
        try {
            if (isset($name) && !empty($name)) {
                return $this->observers->attach($name, $observer);
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    // Exclui observador para o evento
    public function deattach(string $name)
    {
        try {
            if (isset($name) && !empty($name)) {
                return $this->observers->deattach($name);
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    // Dispara o evento
    public function notify()
    {
        return $this->observers->notify();
    }

    // Limpa os observadores
    public function clear()
    {
        return $this->observers->clear();
    }
}
