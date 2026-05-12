<?php

namespace MyProject\Available\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateFormat\DateFormat;
use App\Contracts\Interfaces\AvailableInterface;
use Carbon\Carbon;

class Available extends Model implements AvailableInterface
{
    use DateFormat;

    protected $appends = [
        "formats",
        "values"
    ];

    protected $fillable = [
        'availability_type',
        'availability_id',
        'always_available',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'all_day',
        'from_hours',
        'from_minutes',
        'to_hours',
        'to_minutes',
        'from',
        'to',
    ];

    /**
     * VIGTIGT:
     * `$dates` er deprecated. `$casts` er den korrekte måde.
     */
    protected $casts = [
        'from' => 'datetime',
        'to'   => 'datetime',
    ];

    protected $hidden = [
        'availability_type',
        'availability_id',
        'created_at',
        'updated_at',
        'id',
        'always_available',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'all_day',
        'from_hours',
        'from_minutes',
        'to_hours',
        'to_minutes',
    ];

    public function getFormatsAttribute()
    {   
        $format = $this->getDateAllDateFormats();
        $df = $this->getDateFormatFromRequest();

        return [
            "datetime" => $format[$df]["datetime"],
            "date" => $format[$df]["date"],
            "time" => $format[$df]["time"],
            "iso" => $format["iso"]["datetime"]
        ];
    }

    public function getValuesAttribute()
    {   
        $format = $this->getDateAllDateFormats();
        $df = $this->getDateFormatFromRequest();

        return [
            "iso" => [
                "from" => $this->formatDate($this->from, $format["iso"]["datetime"]),
                "to" => $this->formatDate($this->to, $format["iso"]["datetime"]),
            ],
            "date" => [
                "from" => $this->formatDate($this->from, $format[$df]["date"]),
                "to" => $this->formatDate($this->to, $format[$df]["date"]),
            ],
            "time" => [
                "from" => $this->formatDate($this->from, $format[$df]["time"]),
                "to" => $this->formatDate($this->to, $format[$df]["time"]),
            ],
        ];
    }

    private function formatDate($date, $format)
    {
        // Ingen dato
        if (!$date) {
            return null;
        }

        // Allerede Carbon
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        // Parse string til Carbon
        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }
}
