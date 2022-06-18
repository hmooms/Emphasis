<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const props = defineProps({
    selectedUser: Object,
})

const form = useForm({
    password: '',
    id: props.selectedUser.id
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('user.delete'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <JetActionSection>
        <template #title>
            Gebruiker verwijderen
        </template>

        <template #description>
            Verwijder deze gebruiker permanent.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Als je het account verwijderd, gaat al de data permanent verloren.
            </div>

            <div class="mt-5">
                <JetDangerButton @click="confirmUserDeletion">
                    Verwijderen
                </JetDangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Verwijder Account
                </template>

                <template #content>
                    Weet je zeker dat je {{ props.selectedUser.name }} wilt verwijderen? Als je de gebruiker verwijderd
                    is die permanent verwijderd.
                    Vul je wachtwoord in om te bevestigen.

                    <div class="mt-4">
                        <JetInput ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4"
                            placeholder="Password" @keyup.enter="deleteUser" />

                        <JetInputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <JetSecondaryButton @click="closeModal">
                        annuleren
                    </JetSecondaryButton>

                    <JetDangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser">
                        Gebruiker verwijderen
                    </JetDangerButton>
                </template>
            </JetDialogModal>
        </template>
    </JetActionSection>
</template>
