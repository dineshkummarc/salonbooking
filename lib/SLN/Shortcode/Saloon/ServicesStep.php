<?php

class SLN_Shortcode_Saloon_ServicesStep extends SLN_Shortcode_Saloon_Step
{
    private $services;

    protected function dispatchForm()
    {
        $bb     = $this->getPlugin()->getBookingBuilder();
        $values = $_POST['sln'];
        foreach ($this->getServices() as $service) {
            if ($values['services'][$service->getId()]) {
                $bb->addService($service);
            } else {
                $bb->removeService($service);
            }
        }
        $bb->save();

        return true;
    }

    /**
     * @return SLN_Wrapper_Service[]
     */
    public function getServices()
    {
        if (!isset($this->services)) {
            $this->services = array();
            foreach ($this->getPlugin()->getServices() as $service) {
                if (!$service->isSecondary()) {
                    $this->services[] = $service;
                }
            }
        }

        return $this->services;
    }
}