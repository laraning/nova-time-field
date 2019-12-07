<?php

namespace Laraning\NovaTimeField;

use DateTime;
use Exception;
use Carbon\Carbon;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class TimeField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-time-field';

    /**
     * Create a new field.
     *
     * @param string      $name
     * @param string|null $attribute
     * @param mixed|null  $resolveCallback
     *
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback ?? function ($value) {
            return Carbon::createFromFormat('H:i:s', $value)->format($this->format());
        });
    }

    public function withTwelveHourTime()
    {
        return $this->withMeta(['twelveHourTime' => true]);
    }

    /**
     * Returns the format used for this field.
     *
     * @return string
     */
    public function format()
    {
        return ($this->meta['twelveHourTime'] ?? false) ? 'h:i A' : 'H:i';
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param string                                  $requestAttribute
     * @param object                                  $model
     * @param string                                  $attribute
     *
     * @return void
     */
    protected function fillAttributeFromRequest(
        NovaRequest $request,
        $requestAttribute,
        $model,
        $attribute
    ) {
        if ($request->exists($requestAttribute)) {
            $sentData = $request[$requestAttribute];
            if ($this->nullable && $sentData === null) {
                $model->{$attribute} = null;
            } else {
                $validatedFormat = $this->validatedTimeFormat($sentData);
                if (! $validatedFormat) {
                    throw new Exception('The field must contain a valid time.');
                }
                $newDate = Carbon::createFromFormat($validatedFormat, $sentData)->format('H:i:s');
                $model->{$attribute} = $newDate;
            }
        }
    }

    /**
     * Validate format of given time and return correct format.
     *
     * @param string $timeString
     *
     * @return mixed string|bool
     */
    protected function validatedTimeFormat($timeString)
    {
        $allowedFormats = [
            'H:i',
            'H:i:s',
            $this->format(),
        ];
        foreach ($allowedFormats as $format) {
            if (DateTime::createFromFormat($format, $timeString) !== false) {
                return $format;
            }
        }

        return false;
    }
}
