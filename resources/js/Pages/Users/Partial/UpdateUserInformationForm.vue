<script setup>
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    selectedUser: Object,
});

let form = reactive({
    'name': props.selectedUser.name,
    'email': props.selectedUser.email,
    'phone': props.selectedUser.phone,
});


const updateUserInformation = () => {
    Inertia.put(`/user/${props.selectedUser.id}`, form);
};

</script>

<template>
    <JetFormSection @submitted="updateUserInformation">
        <template #title>
            Gebruikers gegevens
        </template>

        <template #description>
            Verander uw gegevens.
        </template>

        <template #form>


            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="name" value="Naam" />
                <JetInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="email" value="E-mail" />
                <JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
            </div>

            <!-- Phone -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="phone" value="Telefoonnummer" />
                <JetInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" />
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Veranderd.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Verander
            </JetButton>
        </template>
    </JetFormSection>
</template>
