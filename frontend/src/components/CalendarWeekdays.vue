<template>
    <ol class="day-of-week">
        <li v-for="weekday in weekdays" :key="weekday">{{ weekday }}</li>
    </ol>
</template>

<script>
const WEEKDAYS = ["Pon", "Tor", "Sre", "Čet", "Pet", "Sob", "Ned"];

export default {
    name: "CalendarWeekdays",

    computed: {
        weekdays() {
            return WEEKDAYS;
        },
    },
};
</script>

<style scoped>
.day-of-week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}

.day-of-week > * {
    text-align: right;
    padding-right: 5px;
}
</style>
