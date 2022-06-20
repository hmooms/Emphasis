<script setup>
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetLabel from '@/Jetstream/Label.vue';
import { reactive, ref, computed } from 'vue';


const showingUsersList = ref(false);
let selectedUsers = reactive([]);

const props = defineProps({
    users: Array,
    team: Array
});

const showUsersList = () => {
    showingUsersList.value = true;
};

const usersNotInForm = computed(() => {
    return props.users.filter(user => props.team.indexOf(user.id) === -1);
});

const isUserSelected = (id) => {
    return selectedUsers.indexOf(id) !== -1;
};

const selectUser = (id) => {
    selectedUsers.indexOf(id) === -1 ? selectedUsers.push(id) : selectedUsers.splice(selectedUsers.indexOf(id), 1);
};

const addMembers = () => {
    // concat doesnt work so used push with foreach
    selectedUsers.forEach((user) => {
        props.team.push(user);
    });
    closeModal();
};

const removeMember = (member) => {
    props.team.splice(props.team.indexOf(member), 1);
};

const closeModal = () => {
    showingUsersList.value = false;
    selectedUsers = reactive([]);
};

const teamMemberName = (id) => {
    return props.users.find(user => user.id === id).name;
};


</script>

<template>
    <JetLabel for="team" value="Team samenstellen" class="text-lg" />

    <div id="team" class="lg:w-1/2">
        <div v-if="props.team.length > 0" v-for="member in props.team" class="flex mb-2">
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


</template>