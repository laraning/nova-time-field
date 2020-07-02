const Timezones = {
    computed: {
        timezoneAdjustments() {
            return this.field.timezoneAdjustments || false;
        },

        /**
         * Get the user's local timezone.
         */
        userTimezone: function userTimezone() {
            return Nova.config.userTimezone ? Nova.config.userTimezone : moment.tz.guess();
        },
    },
    methods: {
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
    }
}

export default Timezones
