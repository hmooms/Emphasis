<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
import UpdateUserInformationForm from './Partial/UpdateUserInformationForm.vue';
import DeleteUserForm from './Partial/DeleteUserForm.vue';

defineProps({
    selectedUser: Object
});


</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gegevens
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <UpdateUserInformationForm :selectedUser="selectedUser" />

                <JetSectionBorder />

                <DeleteUserForm :selectedUser="selectedUser" />
            </div>
        </div>
    </AppLayout>
</template>
