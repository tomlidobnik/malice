<template>
    <div class="meal-selection-container">
        <h3>NAROČENA PREHRANA</h3>
        <div class="days">
            <DayColumn v-for="day in weekDates" :key="day" :dayName="day" />
        </div>
    </div>
</template>

<script>
import DayColumn from "./DayColumn.vue";
import isoWeek from "dayjs/plugin/isoWeek";
const dayjs = require("dayjs");
import "dayjs/locale/sl";
import advancedFormat from "dayjs/plugin/advancedFormat"; // For custom formatting
dayjs.extend(advancedFormat);
dayjs.extend(isoWeek);
import customParseFormat from "dayjs/plugin/customParseFormat";
dayjs.extend(customParseFormat);

export default {
    name: "MealSelection",
    components: {
        DayColumn,
    },
    props: {
        selectedDate: {
            type: Object,
            required: true,
            default: function () {
                return {
                    year: dayjs().year(),
                    week: dayjs().isoWeek(),
                };
            },
        },
    },
    data() {
        return {
            weekDays: [
                { name: "pon" },
                { name: "tor" },
                { name: "sre" },
                { name: "čet" },
                { name: "pet" },
                { name: "sob" },
                { name: "ned" },
            ],
            weekDates: [],
        };
    },
    created() {
        this.initializeWeekDates();
    },
    watch: {
        selectedDate(newValue) {
            if (newValue) {
                const { year, week } = newValue;
                const newWeekDates = this.getWeekDatesFromYearAndWeek(
                    year,
                    week
                );
                this.weekDates = newWeekDates;
            }
        },
    },
    methods: {
        initializeWeekDates() {
            const today = new Date();
            const firstDayOfWeek = today.getDate() - today.getDay();
            const startOfWeek = new Date(today.setDate(firstDayOfWeek));
            this.weekDates.length = 0;
            for (let i = 1; i < 8; i++) {
                const day = new Date(startOfWeek);
                day.setDate(startOfWeek.getDate() + i);
                const formattedDate = day.toLocaleDateString("sl-SI", {
                    weekday: "short",
                    day: "numeric",
                    month: "short",
                });
                this.weekDates.push(formattedDate);
            }
            console.log(this.weekDates);
        },
        getWeekDatesFromYearAndWeek(year, weekNumber) {
            const dates = [];
            const firstDayOfYear = new Date(year, 0, 1);
            const days = (weekNumber - 1) * 7 - firstDayOfYear.getDay();
            const firstDayOfWeek = new Date(year, 0, days + 1);

            for (let i = 1; i < 8; i++) {
                const day = new Date(firstDayOfWeek);
                day.setDate(firstDayOfWeek.getDate() + i);

                const formattedDate = day.toLocaleDateString("sl-SI", {
                    weekday: "short",
                    day: "numeric",
                    month: "short",
                });

                dates.push(formattedDate);
            }
            return dates;
        },
    },
};
</script>

<style scoped>
.days {
    display: flex;
    flex: 0 0 auto;
    gap: 8px;
}
.meal-selection-container {
    display: flex;
    flex-direction: column;
    padding: 16px;
    border-radius: 16px;
}
h3 {
    margin: 4px 0;
    background-color: #fbc5c5;
    padding: 8px;
    border-radius: 8px 8px 0px 0px;
}

@media (max-width: 1000px) {
    .days {
        flex-direction: column;
    }
}

@media (max-width: 1000px) and (min-width: 400px) {
    .meal-selection-container {
        width: 400px;
        margin: 0 auto;
    }
}
</style>
