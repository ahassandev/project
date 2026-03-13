<script setup lang="ts">
import { ArrowRight, CheckCircle2 } from 'lucide-vue-next';

const staticServices = [
    { title: 'Lean Manufacturing', icon: CheckCircle2 },
    { title: 'Food Safety Management', icon: CheckCircle2 },
    { title: 'Technical CE', icon: CheckCircle2 },
    { title: 'Quality Management', icon: CheckCircle2 },
    { title: 'Safety & Health (SHE)', icon: CheckCircle2 },
    { title: 'Social Compliance', icon: CheckCircle2 },
];
</script>

<template>
    <!-- About / Consultancy Section -->
    <section class="py-24 px-6 bg-slate-50">
        <div class="max-w-[1500px] w-full mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8 order-2 lg:order-1">
                <div class="space-y-4">
                    <h2 class="text-blue-600 font-black text-sm uppercase tracking-[0.2em]">Our Expertise</h2>
                    <h3 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">
                        WE ARE <span class="text-blue-600 uppercase">THE LEADER</span> IN<br/> CONSULTANCY & CERTIFICATIONS
                    </h3>
                </div>
                <p class="text-slate-600 leading-relaxed text-lg italic border-l-4 border-blue-600 pl-6 py-2 bg-blue-50/50">
                    "ISO SYSTEMS RECOGNIZED FOR DELIVERING THE VALUE FOCUS TO THE WAY BUSINESSES ARE SERVING SINCE LAST 20 YEARS."
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Through our determined focus on Quality Management Solutions, Quality Certification, and Consultancy, we have marked our way to success and have won accolades for our clients across industries.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                    <div v-for="service in staticServices" :key="service.title" class="flex items-center gap-3 group translate-x-0 hover:translate-x-2 transition-transform cursor-default">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                            <component :is="service.icon" class="w-4 h-4 text-blue-600 group-hover:text-white transition-colors" />
                        </div>
                        <span class="font-bold text-slate-700 tracking-tight">{{ service.title }}</span>
                    </div>
                </div>
                <div class="pt-6">
                    <button class="bg-slate-900 hover:bg-black text-white px-10 py-4 font-black rounded-lg transition-all hover:shadow-xl active:scale-95 uppercase tracking-wider flex items-center gap-3">
                        Discover More
                        <ArrowRight class="w-5 h-5" />
                    </button>
                </div>
            </div>
            <div class="relative order-1 lg:order-2 px-8">
                <div class="absolute -top-4 -left-4 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl -z-10"></div>
                <div class="relative rounded-3xl overflow-hidden shadow-2xl skew-y-1 hover:skew-y-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80" class="w-full h-full object-cover" alt="Team presentation">
                    <div class="absolute bottom-6 left-6 bg-white p-4 rounded-xl shadow-lg border-l-4 border-blue-600 animate-bounce">
                        <div class="text-xl font-black text-blue-900 leading-none">20+</div>
                        <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Years Exp.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
