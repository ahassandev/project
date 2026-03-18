<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicHeader from '@/components/PublicHeader.vue';
import PublicFooter from '@/components/PublicFooter.vue';
import AboutHero from '@/components/AboutHero.vue';
import AboutDetails from '@/components/AboutDetails.vue';
import HomeTestimonials from '@/components/HomeTestimonials.vue';
import RequestCallback from '@/components/RequestCallback.vue';

const props = defineProps<{
    canRegister?: boolean;
    about: {
        title: string;
        mission_title: string;
        mission_content: string;
        vision_title: string;
        vision_content: string;
        team_content: string;
        standards_content: string;
        excellence_content: string;
        professional_statement: string;
        hero_image: string | null;
        expertise_label: string;
        expertise_title: string;
        expertise_subtitle: string | null;
        expertise_description: string | null;
        expertise_image: string | null;
        expertise_experience_years: string;
    };
}>();
</script>

<template>
    <Head title="About Us - ISO Systems" />

    <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">
        <PublicHeader :canRegister="canRegister" />

        <main class="pt-[110px]">
            <!-- About Hero -->
            <AboutHero 
                :title="about.title" 
                :image="about.hero_image ? (about.hero_image.startsWith('http') ? about.hero_image : `/storage/${about.hero_image}`) : null" 
                breadcrumbCurrent="About" 
            />

            <!-- Detailed Content & Experience -->
            <AboutDetails :about="about" />

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
