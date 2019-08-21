<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex items-center">
                <time-picker
                    class="w-full form-control form-input form-input-bordered"
                    :class="{ 'border-danger': hasError }"
                    :field="field"
                    :placeholder="placeholder"
                    :value="value"
                    :twelveHourTime="twelveHourTime"
                    @change="handleChange"
                />
            </div>

            <div class="help-text error-text mt-2 text-danger" v-if="hasError">
                {{ firstError}}
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
        }
    },
}
</script>
