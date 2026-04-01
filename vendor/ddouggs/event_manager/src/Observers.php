<?php

namespace ddouggs\event_manager;

use ddouggs\event_manager\ObserversInterface;

class Observers implements ObserversInterface
{
    protected $observers = array();

    // Adicionar observador para o evento
    public function attach(string $name, $observer)
    {
        if (isset($name) && !empty($name)) {
            $this->observers[$name] = $observer;
            return true;
        }
        return false;
    }

    // Exclui observador para o evento
    public function deattach(string $name)
    {
        if (isset($name) && !empty($name)) {
            unset($this->observers[$name]);
            return true;
        }
        return false;
    }

    // Dispara o evento
    public function notify()
    {
        foreach ($this->observers as $key => $value) {
            try {
                if (!$value()) {
                    throw new \Exception(sprintf("Erro durante a execução do observer %s.", $key));
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        return true;
    }

    // Limpa os observadores
    public function clear()
    {
        self::$observers = array();
        return empty(self::$observers) ? true : false;
    }
}
