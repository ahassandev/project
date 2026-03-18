<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicHeader from '@/components/PublicHeader.vue';
import PublicFooter from '@/components/PublicFooter.vue';
import RequestCallback from '@/components/RequestCallback.vue';
import HomeHero from '@/components/HomeHero.vue';
import HomeExpertise from '@/components/HomeExpertise.vue';
import HomeCTA from '@/components/HomeCTA.vue';
import HomeTestimonials from '@/components/HomeTestimonials.vue';
import { ref } from 'vue';

const props = defineProps<{
    canRegister: boolean;
    services: Array<{
        id: number;
        title: string;
        slug: string;
        children: Array<{
            id: number;
            title: string;
            slug: string;
            children?: Array<{ id: number; title: string; slug: string }>;
        }>;
    }>;
    about: any;
}>();
</script>

<template>
    <Head title="ISO Systems - Modern Consultancy & Certifications" />

    <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">
        <PublicHeader :canRegister="canRegister" />

        <main class="pt-[110px]">
            <HomeHero />
            <HomeExpertise :data="about" />
            <HomeCTA />
            <HomeTestimonials />
            <RequestCallback />
        </main>

        <PublicFooter />
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

html {
  scroll-behavior: smooth;
}

body {
  font-family: 'Inter', sans-serif;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
  width: 8px;
}
::-webkit-scrollbar-track {
  background: #f1f5f9;
}
::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* Animations are handled by Tailwind's built-in animate utilities
   but we can add some micro-interactions if needed */
.animate-float {
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
  100% { transform: translateY(0px); }
}
</style>
