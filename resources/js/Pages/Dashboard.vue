<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { calculateRemainingTime, isOverdue } from './Project/Partials/DateController.js';

defineProps({
    projects: Array,
})

const showProject = (id) => {
    Inertia.get(route('project.show', id));
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
                    class="p-4 mb-1 border bg-white-bg flex justify-between hover:bg-gray-300 hover:cursor-pointer"
                    @click="showProject(project.id)">

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
