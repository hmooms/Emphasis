<script setup>
import JetLabel from '@/Jetstream/Label.vue';

const props = defineProps({
    project: Object
});
</script>

<template>
    <div class="mb-2">
        <JetLabel for="title" value="Project naam" class="text-lg" />
        <p id="title" class="mt-1 block w-full "> {{ props.project.title }} </p>
    </div>
    <div class="mb-2">
        <JetLabel for="description" value="Project beschrijving" class="text-lg" />

        <p id="description" class="mt-1 block w-full lg:w-1/2  text-dark-font">
            {{ props.project.description }}
        </p>

    </div>
    <div class="mb-2 flex flex-col md:flex-row">
        <div class="mb-2 md:mr-3 md:mb-0">
            <JetLabel for="start_date" value="Begin datum" class="text-lg" />
            <p id="start_date" class="mt-1 block"> {{ props.project.start_date }} </p>
        </div>
        <div>
            <JetLabel for="end_date" value="Eind datum" class="text-lg" />
            <p id="start_date" class="mt-1 block"> {{ props.project.end_date }} </p>

        </div>
    </div>
    <div class="mb-2" v-if="props.project.customer">
        <JetLabel for="customer" value="Bedrijfsnaam" class="text-lg" />
        <p id="customer" class="mt-1 block w-full"> {{ props.project.customer }} </p>

    </div>
    <div class="mb-2">
        <JetLabel for="contact" value="Contactpersoon" class="text-lg" />
        <p id="contact" class="mt-1 block w-full"> {{ props.project.contact }} </p>

    </div>
    <div class="mb-2">
        <JetLabel for="contact_phone" value="Telefoonnummer contactpersoon" class="text-lg" />
        <p id="contact_phone" class="mt-1 block w-full"> {{ props.project.contact_phone }} </p>

    </div>
    <div class="mb-2">
        <JetLabel for="contact_email" value="E-mailadres contactpersoon" class="text-lg" />
        <p id="contact_email" class="mt-1 block w-full "> {{ props.project.contact_email }} </p>
    </div>
    <div class="mb-4">
        <JetLabel value="Teamleden" class="text-lg" />
        <div v-if="props.project.users.length > 0" v-for="member in props.project.users" class="flex mb-2 w-1/2">
            <div class="px-4 py-3 bg-white w-9/12 md:w-10/12 lg:w-11/12 drop-shadow-md">
                <p class="align-center text-lg">{{ member.name }}
                </p>
            </div>
        </div>
    </div>
</template>