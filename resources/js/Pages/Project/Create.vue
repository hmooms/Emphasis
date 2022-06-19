<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive, ref } from 'vue';
import JetInput from '../../Jetstream/Input.vue';
import JetLabel from '../../Jetstream/Label.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetButton from '../../Jetstream/Button.vue';
import { computed } from 'vue';


const showingUsersList = ref(false);
let selectedUsers = reactive([]);

const props = defineProps({
    users: Array
});

const showUsersList = () => {
    showingUsersList.value = true;
}

const selectUser = (id) => {
    selectedUsers.indexOf(id) === -1 ? selectedUsers.push(id) : selectedUsers.splice(selectedUsers.indexOf(id), 1);
}

const closeModal = () => {
    showingUsersList.value = false;
    selectedUsers = reactive([]);
}

const addMembers = () => {
    // concat doesnt work so used push with foreach
    selectedUsers.forEach((user) => {
        form.team.push(user);
    });
    closeModal();
}

const removeMember = (member) => {
    form.team.splice(form.team.indexOf(member), 1);
}

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

const usersNotInForm = computed(() => {
    return props.users.filter(user => form.team.indexOf(user.id) === -1)
});

const isUserSelected = (id) => {
    return selectedUsers.indexOf(id) !== -1;
}

const teamMemberName = (id) => {
    return props.users.find(user => user.id === id).name;
};

let is_company = ref(false);

const submit = () => {
    Inertia.post(route('project.store'), form)
}

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

                        <JetLabel for="team" value="Team samenstellen" class="text-lg" />

                        <div id="team" class="lg:w-1/2">
                            <div v-if="form.team.length > 0" v-for="member in form.team" class="flex mb-2">
                                <div class="px-4 py-3 bg-white w-9/12 md:w-10/12 lg:w-11/12 drop-shadow-md">
                                    <p class="align-center text-xl">{{ teamMemberName(member) }}
                                    </p>
                                </div>
                                <!-- remove button team member -->
                                <button type="button" @click="removeMember(member)"
                                    class="w-3/12 md:w-2/12 lg:w-1/12 lg:px-4 py-2 px-5 ml-2 text-3xl text-light-font bg-danger hover:bg-red-700">-</button>
                            </div>

                            <!-- open users list button -->
                            <button class="w-full bg-white py-2 drop-shadow-md text-2xl hover:bg-gray-300" type="button"
                                @click="showUsersList"> +
                            </button>
                        </div>
                    </div>

                    <JetDialogModal :show="showingUsersList" @close="closeModal">
                        <template #title>
                            Teamleden selecteren
                        </template>

                        <template #content>
                            <div v-for="user in usersNotInForm"
                                class="border border-dark-font hover:cursor-pointer hover:bg-gray-300 bg-white py-3 px-4"
                                :class="[isUserSelected(user.id) ? 'border-4 border-primary' : 'border-dark-font border-b-0 last:border-b']"
                                @click="selectUser(user.id)">
                                <p>{{ user.name }}</p>
                            </div>
                        </template>

                        <template #footer>
                            <JetSecondaryButton @click="closeModal">
                                annuleren
                            </JetSecondaryButton>


                            <JetButton class="ml-3" @click="addMembers" :disabled="(selectedUsers.length < 1)">
                                {{ selectedUsers.length > 1 ? 'Teamleden' : 'Teamlid' }} toevegen
                            </JetButton>
                        </template>
                    </JetDialogModal>

                    <button type="submit"
                        class="px-3 py-2 bg-primary text-light-font hover:bg-dark-font">Aanmaken</button>
                </form>
            </div>
        </div>

    </AppLayout>


</template>