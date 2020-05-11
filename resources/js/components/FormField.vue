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
import { Errors, FormField, HandlesValidationErrors } from 'laravel-nova'

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
        }
    },

    methods: {
       onClear(event) {
         if(event.target.value === '') {
           this.flatpickr.close();
         }
       }
      },

    beforeDestroy() {
        this.flatpickr.destroy()
    },
}
</script>
