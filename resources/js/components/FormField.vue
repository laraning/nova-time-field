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
import Timezones from './../mixins/Timezones'
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [HandlesValidationErrors, FormField, Timezones],

    props: ['field'],

    components: { TimePicker },

    computed: {
        placeholder() {
            return this.field.placeholder || moment().format('HH:mm');
        },

        twelveHourTime() {
            return this.field.twelveHourTime || false;
        },

        minuteIncrement() {
            return this.field.minuteIncrement || 5;
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
    },

    beforeDestroy() {
        this.flatpickr.destroy()
    },
}
</script>
