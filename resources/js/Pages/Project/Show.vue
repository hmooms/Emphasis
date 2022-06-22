<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import ProjectForm from './Partials/ProjectForm.vue';
import ProjectInformation from './Partials/ProjectInformation.vue';
import Button from '@/Jetstream/Button.vue';
import DeleteProject from './Partials/DeleteProject.vue';
import { reactive, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const isEditingProject = ref(false);

const props = defineProps({
    project: Object,
    team: Array,
    users: Array
})

let form = reactive({
    title: props.project.title,
    description: props.project.description,
    customer: props.project.customer,
    contact: props.project.contact,
    contact_phone: props.project.contact_phone,
    contact_email: props.project.contact_email,
    start_date: props.project.start_date,
    end_date: props.project.end_date,
    team: props.team,
    is_completed: props.project.is_completed,
})

const startEditing = () => {
    isEditingProject.value = true;
}

const submit = () => {
    Inertia.put(route('project.update', props.project.id), form);
}
</script>

<template>

    <AppLayout title="Project">


        <div class="flex justify-between mb-3 ml-7 lg:mb-6 lg:ml-0">
            <div class="flex items-center">
                <h1 class="text-3xl text-dark-font ">Project {{ project.title }} {{ isEditingProject ? 'bijwerken' : ''
                }}</h1>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto lg:bg-white-bg px-7 lg:py-6">
                <!-- editing -->
                <form v-if="isEditingProject" @submit.prevent="submit">
                    <ProjectForm :users="props.users" :form="form" />
                    <button type="submit"
                        class="px-3 py-2 bg-primary text-light-font hover:bg-dark-font">Aanmaken</button>
                </form>
                <!-- not editing -->
                <div v-else>
                    <ProjectInformation :project="props.project" />

                    <Button @click="startEditing" class="mr-2"> Bijwerken</Button>

                    <DeleteProject :project="props.project" />
                </div>
            </div>
        </div>

    </AppLayout>


</template>