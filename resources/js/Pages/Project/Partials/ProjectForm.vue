<script setup>
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import SelectUsers from './SelectUsers.vue';
import { ref } from 'vue';

const props = defineProps({
    users: Array,
    form: Object
});

const is_company = ref(props.form.company !== null);
</script>

<template>
    <!-- basic project information -->
    <div class="mb-2">
        <JetLabel for="title" value="Project naam" class="text-lg" />
        <JetInput id="title" class="mt-1 block w-full lg:w-1/2" type="text" v-model="props.form.title" required />
    </div>
    <div class="mb-2">
        <JetLabel for="description" value="Project beschrijving" class="text-lg" />

        <textarea id="description"
            class="mt-1 block w-full lg:w-1/2 bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-dark-font"
            type="textarea" v-model="props.form.description" required />

    </div>
    <div class="mb-2 flex flex-col md:flex-row">
        <div class="mb-2 md:mr-3 md:mb-0">
            <JetLabel for="start_date" value="Begin datum" class="text-lg" />
            <JetInput id="start_date" class="mt-1 block" type="datetime-local" v-model="props.form.start_date"
                required />
        </div>
        <div>
            <JetLabel for="end_date" value="Eind datum" class="text-lg" />
            <JetInput id="end_date" class="mt-1 block" type="datetime-local" v-model="props.form.end_date" required />
        </div>
    </div>
    <!-- customer information -->
    <div class="mb-2">
        <JetLabel value="Is de klant een bedrijf?" class="text-lg" />
        <div class="flex">
            <input id="is_company" class="mt-0 block self-center mr-3" type="checkbox" v-model="is_company" />

            <JetLabel class="text-lg" for="is_company" value="Ja" />
        </div>
    </div>
    <div class="mb-2" v-if="is_company">
        <JetLabel for="customer" value="Bedrijfsnaam" class="text-lg" />
        <JetInput id="customer" class="mt-1 block w-full lg:w-1/2" type="text" v-model="props.form.customer" required />
    </div>
    <div class="mb-2">
        <JetLabel for="contact" value="Contactpersoon" class="text-lg" />
        <JetInput id="contact" class="mt-1 block w-full lg:w-1/2" type="text" v-model="props.form.contact" required />
    </div>
    <div class="mb-2">
        <JetLabel for="contact_phone" value="Telefoonnummer contactpersoon" class="text-lg" />
        <JetInput id="contact_phone" class="mt-1 block w-full lg:w-1/2" type="tel" v-model="props.form.contact_phone"
            required />
    </div>
    <div class="mb-2">
        <JetLabel for="contact_email" value="E-mailadres contactpersoon" class="text-lg" />
        <JetInput id="contact_email" class="mt-1 block w-full lg:w-1/2" type="email" v-model="props.form.contact_email"
            required />
    </div>
    <div :class="props.form.hasOwnProperty('is_completed') ? 'mb-2' : 'mb-4'">
        <SelectUsers :users="props.users" :team="props.form.team" />
    </div>
    <div v-if="props.form.hasOwnProperty('is_completed') && $page.props.user.is_admin" class="mb-4">
        <JetLabel value="Is het project afgerond?" class="text-lg" />
        <div class="flex">
            <input id="is_completed" class="mt-0 block self-center mr-3" type="checkbox"
                v-model="props.form.is_completed" />

            <JetLabel class="text-lg" for="is_completed" :value="props.form.is_completed ? 'Afgerond' : 'Afronden'" />
        </div>
    </div>
</template>