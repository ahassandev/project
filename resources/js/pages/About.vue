<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicHeader from '@/components/PublicHeader.vue';
import PublicFooter from '@/components/PublicFooter.vue';
import AboutHero from '@/components/AboutHero.vue';
import AboutDetails from '@/components/AboutDetails.vue';
import HomeTestimonials from '@/components/HomeTestimonials.vue';
import RequestCallback from '@/components/RequestCallback.vue';

defineProps<{
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="About Us - ISO Systems" />

    <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">
        <PublicHeader :canRegister="canRegister" />

        <main class="pt-[110px]">
            <!-- About Hero -->
            <AboutHero title="About Us" breadcrumbCurrent="About" />

            <!-- Detailed Content & Experience -->
            <AboutDetails />

            <!-- Social Proof for consistency -->
            <HomeTestimonials />

            <!-- Final Call to Action -->
            <RequestCallback />
        </main>

        <PublicFooter />
    </div>
</template>

<style>
/* Smooth scrolling and premium typography already handled by global Inter font */
html {
    scroll-behavior: smooth;
}
</style>
