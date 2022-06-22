<script setup>
import JetLabel from '@/Jetstream/Label.vue';
import { dateFormat } from '../../../DateController.js';

const props = defineProps({
    project: Object
});

const reformatDate = (date) => {
    return dateFormat(date, "dd-mm-yyyy")
}
</script>

<template>
    <div class="mb-2">
        <p id="title" class="mt-1 block w-full text-2xl"> {{ props.project.title }} </p>
    </div>
    <div class="mb-6">
        <p id="description" class="mt-1 block w-full lg:w-1/2  text-dark-font">
            {{ props.project.description }}
        </p>
    </div>

    <!-- project information big screen -->
    <div class="mb-6 hidden w-full md:flex lg:w-1/2">
        <!-- labels -->
        <div class="mr-5 max-w-1/2">
            <p class="text-lg text-semi-bold my-2">Project duratie:</p>
            <p v-if="props.project.customer" class="text-lg my-2">Bedrijfsnaam:</p>
            <p class="text-lg my-2">Contactpersoon:</p>
            <p class="text-lg my-2">Telefoonnummer contactpersoon:</p>
            <p class="text-lg my-2">E-mail address contactpersoon:</p>
        </div>
        <!-- information -->
        <div>
            <p class="my-3"> {{ reformatDate(props.project.start_date) }} / {{ reformatDate(props.project.end_date) }}
            </p>
            <p v-if="props.project.customer" class="my-3"> {{ props.project.customer }} </p>
            <p class="my-3 "> {{ props.project.contact }} </p>
            <p class="my-3"> {{ props.project.contact_phone }} </p>
            <p class="my-3"> {{ props.project.contact_email }} </p>
        </div>
    </div>

    <!-- Project information small screen -->
    <div class="mb-4 md:hidden w-full">
        <div class="mb-2">
            <p class="text-lg text-semi-bold">Project duratie:</p>
            <p> {{ reformatDate(props.project.start_date) }} / {{ reformatDate(props.project.end_date) }}
            </p>
        </div>
        <div v-if="props.project.customer" class="mb-2">
            <p class="text-lg">Bedrijfsnaam:</p>
            <p> {{ props.project.customer }} </p>
        </div>
        <div class="mb-2">
            <p class="text-lg">Contactpersoon:</p>
            <p> {{ props.project.contact }} </p>
        </div>
        <div class="mb-2">
            <p class="text-lg">Telefoonnummer contactpersoon:</p>
            <p> {{ props.project.contact_phone }} </p>
        </div>
        <div class="mb-2">
            <p class="text-lg">mail address contactpersoon:</p>
            <p> {{ props.project.contact_email }} </p>
        </div>
    </div>
    <!-- selected users -->
    <div class="mb-4">
        <JetLabel value="Teamleden" class="text-xl" />
        <div v-if="props.project.users.length > 0" v-for="member in props.project.users" class="flex mb-2 w-1/2">
            <div class="px-4 py-3 bg-white w-9/12 md:w-10/12 lg:w-11/12 drop-shadow-md">
                <p class="align-center text-lg">{{ member.name }}
                </p>
            </div>
        </div>
    </div>
</template>