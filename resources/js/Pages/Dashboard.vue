<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    projects: Array,
})

// amount of miliseconds
const intervals = {
    hour: 3600000,
    day: 86400000,
    week: 604800000,
    month: 18144000000
}

const currentTime = Date.now();

const calculateRemainingTime = (dueTime) => {
    return calcuateInterval(Date.parse(dueTime) - currentTime);
}

// check if it should be displayed in month, week, day or hours
const calcuateInterval = (timeDifference) => {
    if (timeDifference >= intervals.month || timeDifference <= -intervals.month) {
        let months = Math.floor(timeDifference / intervals.month)
        return (months > 1 || months < -1) ? `${months} maanden` : `${months} maand`;
    } else if (timeDifference >= intervals.week || timeDifference <= -intervals.week) {
        let weeks = Math.floor(timeDifference / intervals.week)
        return (weeks > 1 || weeks < -1) ? `${weeks} weeken` : `${weeks} week`;
    } else if (timeDifference >= intervals.day || timeDifference <= -intervals.day) {
        let days = Math.floor(timeDifference / intervals.day)
        let hours = Math.floor((timeDifference - intervals.day * days) / intervals.hour)
        return (days > 1 || days < -1) ? `${days} dagen ${hours} uur` : `${days} dag ${hours} uur`;
    } else if (timeDifference >= intervals.hour || timeDifference <= intervals.hour) {
        let hours = Math.floor(timeDifference / intervals.hour)
        return `${hours} uur`;
    }
}

const isOverdue = (dueTime) => {
    return Date.parse(dueTime) < currentTime;
}

</script>

<template>
    <AppLayout title="Dashboard">
        <div class="max-w-7xl mx-auto">

            <h2 class="text-3xl text-dark-font leading-tight mb-6">Projecten</h2>

            <!-- make project button -->
            <div v-if="$page.props.user.is_admin" class="mb-5">
                <Link :href="route('project.create')">
                <div
                    class="min-w-full py-4 px-6 bg-white-bg border border-gray-200 hover:bg-gray-300 hover:cursor-pointer">
                    <p class="text-2xl text-center text-dark-font">Project aanmaken</p>
                </div>
                </Link>
            </div>

            <!-- project list -->
            <div v-if="projects" v-for="project in projects">

                <div :class="[(isOverdue(project.end_date) && !project.is_completed) ? 'border-danger' : null], [project.is_completed ? 'border-success' : null]"
                    class="p-4 mb-1 border bg-white-bg flex justify-between">

                    <p class="text-dark-font">{{ project.title }}</p>
                    <div v-if="!project.is_completed">
                        <p :class="[isOverdue(project.end_date) ? 'text-danger' : 'text-dark-font']">{{
                                calculateRemainingTime(project.end_date)
                        }} </p>
                    </div>
                    <div v-else>
                        <p class="text-success font-semibold">Afgerond</p>
                    </div>
                </div>

            </div>

        </div>
    </AppLayout>
</template>
