<template>

    <AppLayout title="Gebruikers" :can=can>

        <div class="flex justify-between mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl text-dark-font">Gebruikers</h1>
            </div>

            <!-- <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg" /> -->
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white-bg divide-y divide-gray-200">
                                <tr v-for="user in users" :key="user.id" :class="[user.isAdmin ? 'bg-primary' : '']">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium"
                                                    :class="[user.isAdmin ? 'text-light-font' : 'text-dark-font']">
                                                    {{ user.name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm"
                                            :class="[user.isAdmin ? 'text-light-font' : 'text-dark-font']">
                                            {{ user.email }}
                                        </div>
                                        <div class="text-sm"
                                            :class="[user.isAdmin ? 'text-light-font' : 'text-dark-font']">
                                            {{ user.phone }}
                                        </div>

                                    </td>
                                    <!-- 
                                    <td v-if="user.can.edit"
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="`/users/${user.id}/edit`"
                                            class="text-indigo-600 hover:text-indigo-900"> Edit</Link>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

</template>



<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    users: Array,
    can: Object
})

</script>