<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicHeader from '@/components/PublicHeader.vue';
import PublicFooter from '@/components/PublicFooter.vue';
import AboutHero from '@/components/AboutHero.vue';
import RequestCallback from '@/components/RequestCallback.vue';

defineProps<{
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="Contact Us - ISO Systems" />

    <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">
        <PublicHeader :canRegister="canRegister" />

        <main class="pt-[110px]">
            <!-- Contact Hero -->
            <AboutHero title="Contact Us" breadcrumbCurrent="Contact" />

            <!-- Contact Form Section -->
            <div class="bg-slate-50">
                <RequestCallback />
            </div>

            <!-- Additional Contact Info can be added here if needed -->
        </main>

        <PublicFooter />
    </div>
</template>
