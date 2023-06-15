<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Carbon\Carbon;
use Filament\Widgets\PieChartWidget;

class ReservationsChart extends PieChartWidget
{
    protected static ?string $heading = 'Reservations Chart';

    protected function getData(): array
{
    $reservations = Reservation::where('reservation_status', 'Completada')->get();

    $data = []; 

    foreach ($reservations as $reservation) {
        $reservationDate = $this->parseReservationDateTime($reservation->reservation_datetime);
        $month = $reservationDate->format('F');

        if (isset($data[$month])) {
            $data[$month]++;
        } else {
            $data[$month] = 1;
        }
    }

    return $data;
}

    protected function parseReservationDateTime($dateTimeString): Carbon
    {
        $parts = explode(' ', $dateTimeString);
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

        return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime);
    }
}
