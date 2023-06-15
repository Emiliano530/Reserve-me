<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tables()
    {
        return $this->belongsTo(Table::class, 'id_table');
    }

    protected $fillable = ['guest_number','reservation_datetime','reservation_status','reference_name','associated_event','extras','Cancel_reason','payment_status','id_package','id_table','id_user'];

    public function setReservationDatetimeAttribute($value)
    {
        $parts = explode(' ', $value);
        $day = $parts[1];

        $monthMappings = [
            'ene' => '01',
            'feb' => '02',
            'mar' => '03',
            'abr' => '04',
            'may' => '05',
            'jun' => '06',
            'jul' => '07',
            'ago' => '08',
            'sep' => '09',
            'oct' => '10',
            'nov' => '11',
            'dic' => '12',
        ];
        $month = trans(strtolower(substr($parts[2], 0, 3)));
        $monthNumber = isset($monthMappings[$month]) ? $monthMappings[$month] : $month;

        $year = $parts[3];
        $formattedDate = $year . '-' . $monthNumber . '-' . $day;

        $time12Hr = $parts[4] . ' ' . $parts[5];
        $time24Hr = date('H:i:s', strtotime($time12Hr));

        $dateTime = $formattedDate . ' ' . $time24Hr;
        $this->attributes['reservation_datetime'] = $dateTime;
    }

    public function getReservationDatetimeAttribute()
{
    $date = $this->attributes['reservation_datetime'];

    $dayMappings = [
        'Mon' => trans('Lun'),
        'Tue' => trans('Mar'),
        'Wed' => trans('Mié'),
        'Thu' => trans('Jue'),
        'Fri' => trans('Vie'),
        'Sat' => trans('Sáb'),
        'Sun' => trans('Dom'),
    ];
    $dayOfWeek = $dayMappings[date('D', strtotime($date))];

    $day = date('d', strtotime($date));

    $monthMappings = [
        '01' => trans('Ene'),
        '02' => trans('Feb'),
        '03' => trans('Mar'),
        '04' => trans('Abr'),
        '05' => trans('May'),
        '06' => trans('Jun'),
        '07' => trans('Jul'),
        '08' => trans('Ago'),
        '09' => trans('Sep'),
        '10' => trans('Oct'),
        '11' => trans('Nov'),
        '12' => trans('Dic'),
    ];
    $month = $monthMappings[date('m', strtotime($date))];

    $year = date('Y', strtotime($date));
    $time12Hr = date('g:i A', strtotime($date));

    $formattedDate = $dayOfWeek . ', ' . $day . ' ' . $month . ' ' . $year . ' - ' . $time12Hr;

    return $formattedDate;
}

}
