<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

const confirmingProjectDeletion = ref(false);
const passwordInput = ref(null);

const props = defineProps({
    project: Object,
})

const form = useForm({
    password: '',
    id: props.project.id
});

const confirmProjectDeletion = () => {
    confirmingProjectDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteProject = () => {
    form.delete(route('project.delete'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProjectDeletion.value = false;

    form.reset();
};
</script>

<template>

    <JetDangerButton @click="confirmProjectDeletion">
        Verwijderen
    </JetDangerButton>

    <!-- Delete Account Confirmation Modal -->
    <JetDialogModal :show="confirmingProjectDeletion" @close="closeModal">
        <template #title>
            Verwijder project
        </template>

        <template #content>
            Weet je zeker dat je dit project wilt verwijderen? Als je het project verwijderd
            is die permanent verwijderd.
            Vul je wachtwoord in om te bevestigen.

            <div class="mt-4">
                <JetInput ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4"
                    placeholder="wachtwoord" @keyup.enter="deleteProject" />

                <JetInputError :message="form.errors.password" class="mt-2" />

            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click="closeModal">
                annuleren
            </JetSecondaryButton>

            <JetDangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="deleteProject">
                Project verwijderen
            </JetDangerButton>
        </template>
    </JetDialogModal>
</template>