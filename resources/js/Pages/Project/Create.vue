<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive, ref } from 'vue';
import JetInput from '../../Jetstream/Input.vue';
import JetLabel from '../../Jetstream/Label.vue';
import SelectUsers from './Partials/SelectUsers.vue';


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

let is_company = ref(false);

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
                    <!-- basic project information -->
                    <div class="mb-2">
                        <JetLabel for="title" value="Project naam" class="text-lg" />
                        <JetInput id="title" class="mt-1 block w-full lg:w-1/2" type="text" v-model="form.title"
                            required />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="description" value="Project beschrijving" class="text-lg" />

                        <textarea id="description"
                            class="mt-1 block w-full lg:w-1/2 bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-dark-font"
                            type="textarea" v-model="form.description" required />

                    </div>

                    <div class="mb-2 flex flex-col md:flex-row">
                        <div class="mb-2 md:mr-3 md:mb-0">
                            <JetLabel for="start_date" value="Begin datum" class="text-lg" />
                            <JetInput id="start_date" class="mt-1 block" type="datetime-local" v-model="form.start_date"
                                required />
                        </div>
                        <div>
                            <JetLabel for="end_date" value="Eind datum" class="text-lg" />
                            <JetInput id="end_date" class="mt-1 block" type="datetime-local" v-model="form.end_date"
                                required />
                        </div>
                    </div>

                    <!-- customer information -->
                    <div class="mb-2">
                        <JetLabel value="Is de klant een bedrijf?" class="text-lg" />
                        <div class="flex">
                            <input id="is_company" class="mt-0 block self-center mr-3" type="checkbox"
                                v-model="is_company" />

                            <JetLabel class="text-lg" for="is_company" value="Ja" />
                        </div>
                    </div>

                    <div class="mb-2" v-if="is_company">
                        <JetLabel for="customer" value="Bedrijfsnaam" class="text-lg" />
                        <JetInput id="customer" class="mt-1 block w-full lg:w-1/2" type="text" v-model="form.customer"
                            required />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="contact" value="Contactpersoon" class="text-lg" />
                        <JetInput id="contact" class="mt-1 block w-full lg:w-1/2" type="text" v-model="form.contact"
                            required />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="contact_phone" value="Telefoonnummer contactpersoon" class="text-lg" />
                        <JetInput id="contact_phone" class="mt-1 block w-full lg:w-1/2" type="tel"
                            v-model="form.contact_phone" required />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="contact_email" value="E-mailadres contactpersoon" class="text-lg" />
                        <JetInput id="contact_email" class="mt-1 block w-full lg:w-1/2" type="email"
                            v-model="form.contact_email" required />
                    </div>


                    <div class="mb-4">
                        <SelectUsers :users="props.users" :team="form.team" />
                    </div>

                    <button type="submit"
                        class="px-3 py-2 bg-primary text-light-font hover:bg-dark-font">Aanmaken</button>
                </form>
            </div>
        </div>

    </AppLayout>


</template>