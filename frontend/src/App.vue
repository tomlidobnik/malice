<template>
    <div id="app">
        <div>
            <div class="topnav" :class="{ responsive: isActive }" id="myTopnav">
                <div class="dropdown">
                    <a
                        @click="toggleDropdown"
                        style="font-size: 3rem"
                        class="icon"
                        >&#9776;</a
                    >
                    <div class="dropdown-content" v-show="dropdownActive">
                        <div class="menu-bar-mobile">
                            <a href="/" class="active">Jaz</a>
                            <a href="#">Pripadniki</a>
                            <a href="#">Oddelki</a>
                            <a href="#">Enote</a>
                            <a href="#">Kuhinje</a>
                            <a href="#">Administratorji</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-bar">
            <ul>
                <li><a href="/" class="active">Jaz</a></li>
                <li><a href="#">Pripadniki</a></li>
                <li><a href="#">Oddelki</a></li>
                <li><a href="#">Enote</a></li>
                <li><a href="#">Kuhinje</a></li>
                <li><a href="#">Administratorji</a></li>
            </ul>
        </div>
        <div class="meal-container">
            <CalendarMonth @calendar-date-change="handleDateChange" />
            <MealSelection :selectedDate="selectedDate" />
        </div>
        <button @click="fetchData()">Test</button>
    </div>
</template>

<script>
import CalendarMonth from "./components/CalendarMonth";
import MealSelection from "./components/MealSelection";
const dayjs = require("dayjs");
const isoWeek = require("dayjs/plugin/isoWeek");
dayjs.extend(isoWeek);

export default {
    name: "App",

    components: {
        CalendarMonth,
        MealSelection,
    },
    data() {
        return {
            isActive: false,
            dropdownActive: false,
            selectedDate: {
                year: dayjs().year(),
                week: dayjs().isoWeek(),
            },
        };
    },
    methods: {
        handleDateChange(date) {
            this.selectedDate = date;
        },
        toggleNav() {
            this.isActive = !this.isActive;
        },
        toggleDropdown() {
            this.dropdownActive = !this.dropdownActive;
        },
        fetchData() {
            fetch("http://localhost:8000/api.php", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("update");
                    console.log(data);
                })
                .catch((error) => console.error("Error:", error));
        },
    },
};
</script>

<style>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}
html,
body {
    margin: 0;
    padding: 0;
}
body {
    font-family: sans-serif;
    font-weight: 100;
    --free-day-bg: #fbc5c5;
    --grey-100: #e4e9f0;
    --grey-200: #cfd7e3;
    --grey-300: #b5c0cd;
    --grey-800: #3e4e63;
    --grid-gap: 1px;
    --day-label-size: 20px;
}
ol,
li {
    padding: 0;
    margin: 0;
    list-style: none;
}

.calendar-month-header {
    display: flex;
    justify-content: space-between;
    background-color: #fff;
    padding: 10px;
}
.menu-bar ul {
    display: flex;
    align-items: center;
    justify-content: center;
    list-style-type: none;
    margin-top: 32px;
    margin-bottom: 64px;
    padding: 0;
    overflow: hidden;
    border-radius: 16px;
    padding: 4px;
}

.menu-bar ul li {
    float: left;
    border: 3px solid rgb(248, 166, 166);
    margin: 0 8px;
    margin-left: 0px;
    border-radius: 16px;
}

.menu-bar ul li a {
    color: #2c3e50;
    display: block;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.menu-bar ul li a:hover {
    border-radius: 8px;
    background-color: rgb(248, 166, 166);
}

.meal-container {
    display: grid;
    width: 70%;
    margin: 0 auto;
    height: auto;
    justify-content: center;
    grid-template-columns: repeat(2, max-content);
    gap: 32px;
}
@media (max-width: 1500px) {
    .meal-container {
        grid-template-columns: 1fr;
    }
    .menu-bar ul {
        margin-left: 10%;
        margin-right: 10%;
    }
}
@media (min-width: 1001px) {
    .dropdown,
    .dropdown-content {
        display: none;
    }
}
@media (max-width: 1000px) {
    .menu-bar {
        display: none;
    }
}
.menu-bar-mobile {
    display: flex;
    flex-direction: column;
    gap: 8px;
    justify-content: center;
    align-items: center;
    margin-bottom: 16px;
}
.menu-bar-mobile a {
    text-decoration: 0;
    color: #2c3e50;
    height: 2rem;
    font-size: 1.5rem;
    border: 2px solid #fbc5c5;
    width: 200px;
    border-radius: 16px;
}
.active {
    color: wheat;
}
</style>
