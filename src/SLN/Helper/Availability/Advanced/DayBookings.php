<?php

class SLN_Helper_Availability_Advanced_DayBookings extends SLN_Helper_Availability_AbstractDayBookings
{
    private $cache;

    /**
     * @return SLN_Wrapper_Booking[]
     */
    public function getBookingsByHour($hour, $minutes = null)
    {
        if (!isset($hour)) {
            $hour = $this->getDate()->format('H');
        }
        if(isset($this->cache[$hour.$minutes])){
            return $this->cache[$hour.$minutes];
        }
        $ret = array();
   
        $now = clone $this->getDate();
        $now->setTime($hour, $minutes ? $minutes : 0);
 
        foreach ($this->getBookings() as $b) {
            if (SLN_Plugin::getInstance()->getSettings()->get('reservation_interval_enabled')) {
                $minutes = SLN_Plugin::getInstance()->getSettings()->get('minutes_between_reservation');
                // cool in php 5.3
                //$getEndsAt = $b->getEndsAt()->add(new DateInterval("PT".SLN_Plugin::getInstance()->getSettings()->get('minutes_between_reservation')."M"));
                $getEndsAt = $b->getEndsAt()->modify('+'.$minutes.' minutes');
            }else{
                $getEndsAt = $b->getEndsAt();
            }

            if ($b->getStartsAt() <= $now && $getEndsAt > $now) {
                $ret[] = $b;
            }
        }

        if(!empty($ret)){
            SLN_Plugin::addLog(__CLASS__.' - checking hour('.$hour.')');
            SLN_Plugin::addLog(__CLASS__.' - found('.count($ret).')');
            foreach($ret as $b){
               SLN_Plugin::addLog(' - ' . $b->getId(). ' => '.$b->getStartsAt()->format('H:i').' - '.$b->getEndsAt()->format('H:i'));
            }
        }else{
            SLN_Plugin::addLog(__CLASS__.' - checking hour('.$hour.') EMPTY');
        }
        $this->cache[$hour] = $ret;
        return $ret;
    }
}
