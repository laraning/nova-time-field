<template>
    <panel-item :field="field">
        <template slot="value">
            <p class="text-90">
                {{ localizedValue }}
            </p>
        </template>
    </panel-item>
</template>

<script>
import Timezones from "../mixins/Timezones";

export default {
    mixins: [Timezones],
    props: ['field'],

    computed: {
        localizedValue() {

            console.log(this.field.value)

            return this.timezoneAdjustments ?
            this.fromAppTimezone(this.field.value) :
            this.field.value
        }
    },
}
</script>
