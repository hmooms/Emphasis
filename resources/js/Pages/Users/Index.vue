<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    users: Array
})

Inertia.reload();

let editUser = (id) => {
    Inertia.get(`/user/profile/${id}`);
};

</script>

<template>

    <AppLayout title="Gebruikers">

        <div class="flex justify-between mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl text-dark-font">Gebruikers</h1>
            </div>

        </div>
        <div class="mb-5">
            <Link :href="route('user-create')" class="">
            <div class="min-w-full py-4 px-6 bg-white-bg border border-gray-200 hover:bg-gray-300 hover:cursor-pointer">
                <p class="text-2xl text-center text-dark-font">Gebruiker aanmaken</p>
            </div>
            </Link>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white-bg divide-y divide-gray-200">
                                <tr v-for="user in users" :key="user.id"
                                    :class="[user.is_admin ? 'bg-primary hover:bg-primary-hover' : 'hover:bg-gray-300']"
                                    class="hover:cursor-pointer" @click="editUser(user.id)">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium"
                                                :class="[user.is_admin ? 'text-light-font' : 'text-dark-font']">
                                                {{ user.name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm"
                                            :class="[user.is_admin ? 'text-light-font' : 'text-dark-font']">
                                            {{ user.email }}
                                        </div>
                                        <div class="text-sm"
                                            :class="[user.is_admin ? 'text-light-font' : 'text-dark-font']">
                                            {{ user.phone }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>

</template>


