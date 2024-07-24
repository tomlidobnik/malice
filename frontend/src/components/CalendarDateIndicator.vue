<template>
    <div class="calendar-date-indicator">{{ selectedMonth }}</div>
</template>

<script>
export default {
    props: {
        selectedDate: {
            type: Object,
            required: true,
        },
    },

    computed: {
        selectedMonth() {
            const monthEnglish = this.selectedDate.format("MMMM");
            const year = this.selectedDate.format("YYYY");

            let monthSlovenian;
            switch (monthEnglish) {
                case "January":
                    monthSlovenian = "Januar";
                    break;
                case "February":
                    monthSlovenian = "Februar";
                    break;
                case "March":
                    monthSlovenian = "Marec";
                    break;
                case "April":
                    monthSlovenian = "April";
                    break;
                case "May":
                    monthSlovenian = "Maj";
                    break;
                case "June":
                    monthSlovenian = "Junij";
                    break;
                case "July":
                    monthSlovenian = "Julij";
                    break;
                case "August":
                    monthSlovenian = "Avgust";
                    break;
                case "September":
                    monthSlovenian = "September";
                    break;
                case "October":
                    monthSlovenian = "Oktober";
                    break;
                case "November":
                    monthSlovenian = "November";
                    break;
                case "December":
                    monthSlovenian = "December";
                    break;
                default:
                    monthSlovenian = monthEnglish;
            }

            return `${monthSlovenian} ${year}`;
        },
    },
};
</script>

<style scoped>
.calendar-date-indicator {
    font-size: 24px;
    font-weight: 600;
    color: var(--grey-00);
}
</style>
