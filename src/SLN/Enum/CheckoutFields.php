<?php

class SLN_Enum_CheckoutFields
{
    private static $fields;

    private static $settingsLabels;

    public static function toArray()
    {
        return self::$fields;
    }

    public static function toArrayFull()
    {
        $ret = self::$fields;

        $ret['password']         = __('Password', 'salon-booking-system');
        $ret['password_confirm'] = __('Confirm your password', 'salon-booking-system');

        return $ret;
    }

    public static function getLabel($key)
    {
        return isset(self::$fields[$key]) ? self::$fields[$key] : '';
    }

    public static function getSettingLabel($key)
    {
        return isset(self::$settingsLabels[$key]) ? self::$settingsLabels[$key] : '';
    }

    public static function init()
    {
        self::$fields = array(
            'firstname' => __('First name', 'salon-booking-system'),
            'lastname'  => __('Last name', 'salon-booking-system'),
            'email'     => __('e-mail', 'salon-booking-system'),
            'phone'     => __('Mobile phone', 'salon-booking-system'),
            'address'   => __('Address', 'salon-booking-system'),
        );

        self::$settingsLabels = array(
            'firstname' => __('First name', 'salon-booking-system'),
            'lastname'  => __('Last name', 'salon-booking-system'),
            'email'     => __('Email address (not editable)', 'salon-booking-system'),
            'phone'     => __('Telephone', 'salon-booking-system'),
            'address'   => __('Address', 'salon-booking-system'),
        );
    }
}

SLN_Enum_CheckoutFields::init();
