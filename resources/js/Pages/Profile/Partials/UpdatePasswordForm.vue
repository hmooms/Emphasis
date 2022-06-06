<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <JetFormSection @submitted="updatePassword">
        <template #title>
            Wachtwoord veranderen
        </template>

        <template #description>
            Zorg ervoor dat u een lang en random wachtwoord gebruikt om uw account te beschermen.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="current_password" value="Huidig wachtwoord" />
                <JetInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                    type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <JetInputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="password" value="Nieuw wachtwoord" />
                <JetInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />
                <JetInputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="password_confirmation" value="Wachtwoord bevestegen" />
                <JetInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />
                <JetInputError :message="form.errors.password_confirmation" class="mt-2" />
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
