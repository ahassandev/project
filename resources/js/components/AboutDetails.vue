<script setup lang="ts">
import { Target, Lightbulb, Users, ShieldCheck, Trophy } from 'lucide-vue-next';
import HomeExpertise from '@/components/HomeExpertise.vue';

defineProps<{
    about: {
        mission_title: string;
        mission_content: string;
        vision_title: string;
        vision_content: string;
        team_content: string;
        standards_content: string;
        excellence_content: string;
        professional_statement: string;
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
    <div class="bg-white">
        <!-- Reusing HomeExpertise for the "Leader" section -->
        <HomeExpertise :data="about" />

        <!-- Detailed Content Section -->
        <section class="py-16 md:py-24 px-6 bg-white overflow-hidden">
            <div class="max-w-[1500px] w-full mx-auto space-y-12 md:space-y-24">

                <!-- Mission & Vision -->
                <div class="grid md:grid-cols-2 gap-6 md:gap-12">
                   <div class="bg-slate-50 p-6 md:p-12 rounded-3xl border border-slate-100 group hover:border-blue-200 transition-colors">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform">
                            <Target class="w-8 h-8" />
                        </div>
                        <h3 class="text-3xl font-black text-slate-800 mb-6 uppercase tracking-tight">{{ about.mission_title }}</h3>
                        <div class="text-slate-600 leading-relaxed font-medium prose prose-slate max-w-none" v-html="about.mission_content"></div>
                   </div>
                   <div class="bg-blue-900 p-6 md:p-12 rounded-3xl text-white group hover:bg-blue-800 transition-colors">
                        <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform">
                            <Lightbulb class="w-8 h-8" />
                        </div>
                        <h3 class="text-3xl font-black mb-6 uppercase tracking-tight">{{ about.vision_title }}</h3>
                        <div class="text-blue-100 leading-relaxed font-medium prose prose-invert max-w-none" v-html="about.vision_content"></div>
                   </div>
                </div>

                <!-- Three Pillar Approach -->
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Our Team -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <Users class="w-6 h-6 text-blue-600" />
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-widest">Our Team</h4>
                        </div>
                        <div class="text-slate-600 text-sm leading-relaxed prose prose-slate max-w-none" v-html="about.team_content"></div>
                    </div>

                    <!-- Quality Standards -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <ShieldCheck class="w-6 h-6 text-blue-600" />
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-widest">Standards</h4>
                        </div>
                        <div class="text-slate-600 text-sm leading-relaxed prose prose-slate max-w-none" v-html="about.standards_content"></div>
                    </div>

                    <!-- Excellence -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <Trophy class="w-6 h-6 text-blue-600" />
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-widest">Excellence</h4>
                        </div>
                        <div class="text-slate-600 text-sm leading-relaxed prose prose-slate max-w-none" v-html="about.excellence_content"></div>
                    </div>
                </div>

                <!-- Professional Statement -->
                <div class="relative bg-slate-50 rounded-[3rem] p-8 md:p-20 overflow-hidden text-center max-w-5xl mx-auto border border-white">
                    <div class="absolute -top-12 -right-12 w-64 h-64 bg-blue-600/5 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-slate-900/5 rounded-full blur-3xl"></div>

                    <h5 class="text-blue-600 font-black text-sm uppercase tracking-[0.4em] mb-8">Professional Commitment</h5>
                    <p class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight italic">
                        "{{ about.professional_statement }}"
                    </p>
                </div>

            </div>
        </section>
    </div>
</template>
