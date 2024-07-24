<template>
    <div class="day-col">
        <li class="day">{{ dayName }}</li>
        <div class="zajtrk">
            <input
                type="checkbox"
                :name="'zajtrk-' + dayName"
                :id="'zajtrk-' + dayName" />
            <label :for="'zajtrk-' + dayName">Zajtrk</label>
        </div>
        <div class="malica" :class="bgColorClassMalica">
            <h5>Malica</h5>
            <div>
                <input
                    type="radio"
                    :id="'malica-topla-' + dayName"
                    :name="'malica-' + dayName"
                    value="topla"
                    v-model="selectedMalica" />
                <label :for="'malica-topla-' + dayName">Topla</label>
            </div>
            <div>
                <input
                    type="radio"
                    :name="'malica-' + dayName"
                    :id="'malica-hladna-' + dayName"
                    value="hladna"
                    v-model="selectedMalica" />
                <label :for="'malica-hladna-' + dayName">Hladna</label>
            </div>
            <div>
                <input
                    type="radio"
                    :name="'malica-' + dayName"
                    :id="'malica-sadna-' + dayName"
                    value="sadna"
                    v-model="selectedMalica" />
                <label :for="'malica-sadna-' + dayName">Sadna</label>
            </div>
            <div>
                <input
                    type="radio"
                    :name="'malica-' + dayName"
                    :id="'malica-nic-' + dayName"
                    v-model="selectedMalica"
                    value="nic"
                    checked />
                <label :for="'malica-nic-' + dayName">Nič</label>
            </div>
        </div>
        <div class="vecerja" :class="bgColorClassVecerja">
            <h5>Večerja</h5>
            <div>
                <input
                    type="radio"
                    :name="'vecerja-' + dayName"
                    value="topla"
                    v-model="selectedVecerja"
                    :id="'vecerja-topla-' + dayName" />
                <label :for="'vecerja-topla-' + dayName">Topla</label>
            </div>
            <div>
                <input
                    type="radio"
                    :name="'vecerja-' + dayName"
                    value="hladna"
                    v-model="selectedVecerja"
                    :id="'vecerja-hladna-' + dayName" />
                <label :for="'vecerja-hladna-' + dayName">Hladna</label>
            </div>
            <div>
                <input
                    type="radio"
                    :name="'vecerja-' + dayName"
                    :id="'vecerja-nic-' + dayName"
                    value="nic"
                    v-model="selectedVecerja"
                    checked />
                <label :for="'vecerja-nic-' + dayName">Nič</label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DayColumn",
    props: {
        dayName: String,
    },
    data() {
        return {
            selectedMalica: "nic",
            selectedVecerja: "nic",
        };
    },
    computed: {
        bgColorClassMalica() {
            switch (this.selectedMalica) {
                case "topla":
                    return "bg-red";
                case "hladna":
                    return "bg-blue";
                case "sadna":
                    return "bg-yellow";
                case "nic":
                default:
                    return "bg-white";
            }
        },
        bgColorClassVecerja() {
            switch (this.selectedVecerja) {
                case "topla":
                    return "bg-red";
                case "hladna":
                    return "bg-blue";
                case "sadna":
                    return "bg-yellow";
                case "nic":
                default:
                    return "bg-white";
            }
        },
    },
};
</script>

<style scoped>
h5 {
    text-align: start;
    padding: 0;
    margin: 0;
}
.day-col {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    align-items: start;
    min-width: 130px;
    max-height: 100%;
    border: 1px solid black;
    background-color: white;
    border-radius: 0 0 16px 16px;
}
.day {
    background-color: antiquewhite;
    width: 100%;
    padding: 5px;
}
.malica,
.vecerja {
    display: flex;
    flex-direction: column;
    align-items: start;
    padding: 5px;
    width: 80%;
    margin: 5px;
}
.zajtrk {
    padding: 0 5px;
}
.vecerja,
.malica {
    margin: 5px;
    border: 1px solid black;
    border-radius: 16px;
}
.day,
.malica,
.vecerja {
    box-sizing: border-box;
}

.bg-red {
    background-color: rgb(248, 166, 166);
}
.bg-blue {
    background-color: rgb(145, 213, 255);
}
.bg-yellow {
    background-color: rgb(253, 253, 156);
}
.bg-white {
    background-color: white;
}
</style>
