<script>
import flatpickr from 'flatpickr'
import 'flatpickr/dist/themes/airbnb.css'

export default {
    props: {
        field: {
            required: true,
        },
        value: {
            required: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        twelveHourTime: {
            type: Boolean,
            default: true,
        }
    },

    data: () => ({ flatpickr: null }),

    mounted() {
        this.$nextTick(() => {
            this.flatpickr = flatpickr(this.$refs.timePicker, {
                enableTime: true,
                onClose: this.onChange,
                noCalendar: true,
                dateFormat: "H:i",
                allowInput: true,
                time_24hr: !this.twelveHourTime,
            })
        })
    },

    methods: {
        onChange(event) {
            this.$emit('change', this.$refs.timePicker.value)
        },
    },
}
</script>

<template>
  <input
    :disabled="disabled"
    :dusk="field.attribute"
    :class="{'!cursor-not-allowed': disabled}"
    :value="value"
    :name="field.name"
    ref="timePicker"
    type="text"
    :placeholder="placeholder">
</template>

<style scoped>
.\!cursor-not-allowed {
    cursor: not-allowed !important;
}
</style>
