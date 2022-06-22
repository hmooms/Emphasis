<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInput from '../../Jetstream/Input.vue';
import JetLabel from '../../Jetstream/Label.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';

let form = reactive({
    email: '',
    password: '',
    name: '',
    phone: '',
    is_admin: false
});


const submit = () => {
    Inertia.post('/user', form);
};

</script>

<template>

    <AppLayout title="Gebruikers aanmaken">

        <div class="flex justify-between mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl text-dark-font">Gebruiker aanmaken</h1>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto bg-white-bg p-7">
                <form @submit.prevent="submit">
                    <div class="mb-2">
                        <JetLabel for="email" value="E-mail" class="text-lg" />
                        <JetInput id="email" class="mt-1 block w-full lg:w-1/2" type="email" v-model="form.email"
                            required autofocus />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="password" value="Wachtwoord" class="text-lg" />

                        <JetInput id="password" class="mt-1 block w-full lg:w-1/2" type="password"
                            v-model="form.password" required autofocus />

                    </div>
                    <div class="mb-2">
                        <JetLabel for="name" value="Naam" class="text-lg" />
                        <JetInput id="name" class="mt-1 block w-full lg:w-1/2" type="text" v-model="form.name" required
                            autofocus />
                    </div>
                    <div class="mb-2">
                        <JetLabel for="phone" value="telefoonnummer" class="text-lg" />
                        <JetInput id="phone" class="mt-1 block w-full lg:w-1/2" type="tel" v-model="form.phone" required
                            autofocus />
                    </div>
                    <div class="mb-2 flex">

                        <JetLabel for="is_admin" value="Admin" class="text-lg mr-3" />

                        <input id="is_admin" class="self-center block mt-0 mr-2" type="checkbox" v-model="form.is_admin"
                            autofocus />

                    </div>

                    <button type="submit"
                        class="px-3 py-2 bg-primary text-light-font hover:bg-dark-font">Aanmaken</button>
                </form>
            </div>
        </div>
    </AppLayout>

</template>