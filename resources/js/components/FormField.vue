<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="flex items-center">
                <time-picker
                    class="w-full form-control form-input form-input-bordered"
                    :class="{ 'border-danger': hasError }"
                    :id="field.attribute"
                    :field="field"
                    :placeholder="placeholder"
                    :value="value"
                    :dusk="field.attribute"
                    :disabled="isReadonly"
                    :twelveHourTime="twelveHourTime"
                    :minuteIncrement="minuteIncrement"
                    @change="handleChange"
                />
            </div>
        </template>
    </default-field>
</template>

<script>
import TimePicker from './../TimePicker'
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [HandlesValidationErrors, FormField],

    components: { TimePicker },

    computed: {
        placeholder() {
            return moment(new Date()).format('HH:ss')
        },

        twelveHourTime() {
            return this.field.twelveHourTime || false;
        },

        minuteIncrement() {
            return this.field.minuteIncrement || 5;
        },

        /**
         * Get the user's local timezone.
         */
        userTimezone: function userTimezone() {
            return Nova.config.userTimezone ? Nova.config.userTimezone : moment.tz.guess();
        },

        timezoneAdjustments() {
            return this.field.timezoneAdjustments || false;
        },
    },

    methods: {
       onClear(event) {
           if(event.target.value === '') {
             this.flatpickr.close();
           }
       },

        /**
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.timezoneAdjustments ?
            this.fromAppTimezone(this.field.value || '') :
            this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.timezoneAdjustments ?
            this.toAppTimezone(this.value || '') :
            this.value || ''
          )
        },

        /**
         * Convert the given localized date time string to the application's timezone.
         */
        toAppTimezone: function toAppTimezone(value) {
            return value ? moment.tz(value, 'HH:mm', this.userTimezone).clone().tz(Nova.config.timezone).format('HH:mm') : value;
        },

        /**
         * Convert the given application timezone date time string to the local timezone.
         */
        fromAppTimezone: function fromAppTimezone(value) {
            if (!value) {
                return value;
            }

            return moment.tz(value, 'HH:mm', Nova.config.timezone).clone().tz(this.userTimezone).format('HH:mm');
        },
    },

    beforeDestroy() {
        this.flatpickr.destroy()
    },
}
</script>
