<script setup lang="ts">
import { ArrowRight } from 'lucide-vue-next';
</script>

<template>
    <!-- Hero Section -->
    <section class="relative min-h-[95vh] flex items-center pt-20 md:pt-28 pb-20 md:pb-40 overflow-hidden">
        <!-- Background with Gradient/Pattern -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-linear-to-br from-blue-900/40 to-slate-900/80 z-10"></div>
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80" class="w-full h-full object-cover" alt="Office Background">
        </div>

        <div class="max-w-[1500px] w-full mx-auto px-6 relative z-20">
            <div class="max-w-3xl space-y-8 animate-in fade-in slide-in-from-bottom-10 duration-1000">
                <div class="inline-flex items-center gap-2 bg-blue-600/20 backdrop-blur-sm border border-blue-400/30 px-4 py-1.5 rounded-full text-blue-200 text-sm font-bold tracking-wider uppercase">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    Trusted Partners in Quality
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] tracking-tight">
                    WE ARE TRUSTED FOR <br/>
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">YOUR PROJECT BUSINESS</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-200 max-w-2xl leading-relaxed font-medium">
                    ISO Systems provides world-class consultancy and certification services across industries, helping businesses achieve excellence through international standards.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full text-lg font-extrabold transition-all hover:shadow-[0_0_30px_rgba(37,99,235,0.4)] active:scale-95 flex items-center gap-2 group uppercase tracking-wide">
                        Explore Services
                        <ArrowRight class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                    </button>
                    <!-- <button class="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white border border-white/30 px-8 py-4 rounded-full text-lg font-extrabold transition-all active:scale-95 uppercase tracking-wide">
                        Contact Us
                    </button> -->
                </div>
            </div>
        </div>

        <!-- Floating Stats -->
        <div class="hidden lg:flex absolute bottom-12 right-12 z-20 gap-8">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-2xl text-white">
                <div class="text-3xl font-black mb-1">700+</div>
                <div class="text-xs font-bold text-blue-300 uppercase tracking-widest">Clients Served</div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-2xl text-white">
                <div class="text-3xl font-black mb-1">20+</div>
                <div class="text-xs font-bold text-blue-300 uppercase tracking-widest">Industry Awards</div>
            </div>
        </div>
    </section>
</template>
