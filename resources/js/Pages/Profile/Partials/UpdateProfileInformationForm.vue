<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    user: Object,
});

let form = reactive({
    'name': props.user.name,
    'email': props.user.email,
    'phone': props.user.phone,
});


let updateProfileInformation = () => {
    Inertia.put(`/users/${props.user.id}`, form);
};

</script>

<template>
    <JetFormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>


            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="name" value="Name" />
                <JetInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="email" value="Email" />
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
                Saved.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </JetFormSection>
</template>
