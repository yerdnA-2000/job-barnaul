<?php

namespace App\libraries\Date;

class HumanDateFormat
{

    /**
     * данный метод написан на коленке (нужно переписать)
     */
    public static function humanDate($time)
    {
        $timestamp = strtotime($time);
        $published = date('d.m.Y', $timestamp);
        $factTime = date('H:i', $timestamp);
        $result = trans('date.today', ['time' => $factTime]);
        return $result;
        if ($published === date('d.m.Y')) {
            return trans('date.today', ['time' => date('H:i', $timestamp)]);
        } elseif ($published === date('d.m.Y', strtotime('-1 day'))) {
            return trans('date.yesterday', ['time' => date('H:i', $timestamp)]);
        } else {
            $formatted = trans('date.later', [
                'time' => date('H:i', $timestamp),
                'date' => date('d F' . (date('Y', $timestamp) === date('Y') ? null : ' Y'), $timestamp)
            ]);

            return strtr($formatted, trans('date.month_declensions'));
        }
    }

}
