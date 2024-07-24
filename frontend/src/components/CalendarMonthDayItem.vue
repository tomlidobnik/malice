<template>
    <li
        class="calendar-day"
        :class="{
            'calendar-day--not-current': !day.isCurrentMonth,
            'calendar-day--today': isToday,
            'calendar-day--free': isFree,
        }"
        @click="handleDateChange">
        <span>{{ label }}</span>
    </li>
</template>

<script>
import dayjs from "dayjs";

export default {
    name: "CalendarMonthDayItem",

    props: {
        day: {
            type: Object,
            required: true,
        },

        isCurrentMonth: {
            type: Boolean,
            default: false,
        },

        isToday: {
            type: Boolean,
            default: false,
        },
        holidays: {
            type: Array,
            // Defining holidays
            default: () => [
                "01-01",
                "02-01",
                "08-02",
                "27-04",
                "01-05",
                "02-05",
                "25-06",
                "01-11",
                "26-12",
                "15-09",
                "25-12",
                "31-10",
            ],
        },
    },

    computed: {
        label() {
            return dayjs(this.day.date).format("D");
        },
        isFree() {
            const dayOfWeek = dayjs(this.day.date).day();
            if (dayOfWeek === 0 || dayOfWeek === 6) return true;
            const currentDateFormatted = dayjs(this.day.date).format("DD-MM");
            if (this.holidays.includes(currentDateFormatted)) return true;
            const year = dayjs(this.day.date).year();
            const firstDayOfApril = dayjs(new Date(year, 3, 1));
            let firstMondayOfApril = firstDayOfApril;
            if (firstDayOfApril.day() !== 1) {
                firstMondayOfApril = firstDayOfApril.add(
                    (8 - firstDayOfApril.day()) % 7,
                    "day"
                );
            }
            const firstMondayOfAprilFormatted =
                firstMondayOfApril.format("DD-MM");
            return currentDateFormatted === firstMondayOfAprilFormatted;
        },
    },

    methods: {
        handleDateChange() {
            this.$emit("date-change", {
                year: dayjs(this.day.date).year(),
                week: dayjs(this.day.date).week(),
            });
        },
    },
};
</script>

<style scoped>
.calendar-day {
    display: inline;
    position: relative;
    min-height: 20px;
    font-size: 16px;
    background-color: #fff;
    color: var(--grey-800);
    padding: 5px;
    cursor: pointer;
}

.calendar-day > span {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: 2px;
    width: var(--day-label-size);
    height: var(--day-label-size);
}

.calendar-day--not-current {
    background-color: var(--grey-100);
}

.calendar-day--today {
    padding-top: 4px;
}

.calendar-day--today > span {
    color: #fff;
    border-radius: 9999px;
    padding: 2px;
    background-color: var(--grey-800);
}
.calendar-day--free {
    background-color: var(--free-day-bg);
}
</style>
