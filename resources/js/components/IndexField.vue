<template>
    <span class="whitespace-no-wrap">{{ localizedValue }}</span>
</template>

<script>
import Timezones from "../mixins/Timezones";

export default {
    mixins: [Timezones],
    props: ['field'],

    computed: {
        localizedValue() {
            return this.timezoneAdjustments ?
                this.fromAppTimezone(this.field.value) :
            this.field.value
        }
    },
}
</script>
