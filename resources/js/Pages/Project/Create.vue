<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import ProjectForm from './Partials/ProjectForm.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive, ref } from 'vue';


const props = defineProps({
    users: Array
});

let form = reactive({
    title: '',
    description: '',
    customer: '',
    contact: '',
    contact_phone: '',
    contact_email: '',
    start_date: '',
    end_date: '',
    team: [],
});

const submit = () => {
    Inertia.post(route('project.store'), form)
};

</script>

<template>
    <AppLayout title="Project aanmaken">
        <div class="flex justify-between mb-3 ml-7 lg:mb-6 lg:ml-0">
            <div class="flex items-center">
                <h1 class="text-3xl text-dark-font ">Project aanmaken</h1>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto lg:bg-white-bg px-7 lg:py-6">
                <form @submit.prevent="submit">
                    <ProjectForm :users="props.users" :form="form" />
                    <button type="submit"
                        class="px-3 py-2 bg-primary text-light-font hover:bg-dark-font">Aanmaken</button>
                </form>
            </div>
        </div>

    </AppLayout>


</template>