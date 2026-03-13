<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';

defineProps<{
    title: string;
    breadcrumbCurrent: string;
}>();
</script>

<template>
    <section class="relative pt-16 pb-12 flex items-center justify-center overflow-hidden bg-slate-900 text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-blue-900/90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80"
                 class="w-full h-full object-cover grayscale opacity-40 translate-y-[-10%]" alt="Professional Background">
        </div>

        <div class="max-w-[1500px] w-full mx-auto px-6 relative z-20 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white leading-tight uppercase tracking-tighter mb-6 animate-in fade-in slide-in-from-bottom-10 duration-700">
                {{ title }}
            </h1>

            <!-- Breadcrumbs -->
            <div class="flex items-center justify-center gap-3 text-sm font-black uppercase tracking-[0.2em]">
                <Link href="/" class="text-blue-400 hover:text-white transition-colors">Home</Link>
                <ChevronRight class="w-4 h-4 text-slate-500" />
                <span class="text-white">{{ breadcrumbCurrent }}</span>
            </div>
        </div>
    </section>
</template>
