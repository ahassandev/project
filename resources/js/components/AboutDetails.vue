<script setup lang="ts">
import { Target, Lightbulb, Users, ShieldCheck, Trophy } from 'lucide-vue-next';
import HomeExpertise from '@/components/HomeExpertise.vue';
</script>

<template>
    <div class="bg-white">
        <!-- Reusing HomeExpertise for the "Leader" section -->
        <HomeExpertise />

        <!-- Detailed Content Section -->
        <section class="py-24 px-6 bg-white overflow-hidden">
            <div class="max-w-[1500px] w-full mx-auto space-y-24">
                
                <!-- Mission & Vision -->
                <div class="grid md:grid-cols-2 gap-12">
                   <div class="bg-slate-50 p-12 rounded-3xl border border-slate-100 group hover:border-blue-200 transition-colors">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform">
                            <Target class="w-8 h-8" />
                        </div>
                        <h3 class="text-3xl font-black text-slate-800 mb-6 uppercase tracking-tight">Our Mission</h3>
                        <p class="text-slate-600 leading-relaxed font-medium">
                            To emerge as a world-class Consultancy and Certification solutions provider by delivering value-managed services and building sustainability in the performance of organizations.
                        </p>
                   </div>
                   <div class="bg-blue-900 p-12 rounded-3xl text-white group hover:bg-blue-800 transition-colors">
                        <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform">
                            <Lightbulb class="w-8 h-8" />
                        </div>
                        <h3 class="text-3xl font-black mb-6 uppercase tracking-tight">Our Vision</h3>
                        <p class="text-blue-100 leading-relaxed font-medium">
                            ISO SYSTEMS is committed to deliver value-based services and to achieve the utmost satisfaction of our customers and continue improvement in all our processes.
                        </p>
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
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Our consultancy team comprises highly professional, trained, and industry-active experts to make the following services deliverable by our team of experts. Our professionals are grouped by industry focus and deliver specialized solutions to clients for personal interest in each aspect of quality management systems across the industry effectively and efficiently.
                        </p>
                    </div>

                    <!-- Quality Standards -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <ShieldCheck class="w-6 h-6 text-blue-600" />
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-widest">Standards</h4>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            We work with a variety of organizations in the setting management systems of the major commercial activity, some where a great focus is made to improve efficiencies in their operations to minimize wastage, rejection and so to improve their marketability.
                        </p>
                    </div>

                    <!-- Excellence -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <Trophy class="w-6 h-6 text-blue-600" />
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-widest">Excellence</h4>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            ISO SYSTEMS has been recognized for delivering "THE VALUE FOCUS" to the way businesses are serving for over 20 years. Our determined focus on Quality Management and Food Safety has marked our way to success.
                        </p>
                    </div>
                </div>

                <!-- Professional Statement -->
                <div class="relative bg-slate-50 rounded-[3rem] p-12 md:p-20 overflow-hidden text-center max-w-5xl mx-auto border border-white">
                    <div class="absolute -top-12 -right-12 w-64 h-64 bg-blue-600/5 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-slate-900/5 rounded-full blur-3xl"></div>
                    
                    <h5 class="text-blue-600 font-black text-sm uppercase tracking-[0.4em] mb-8">Professional Commitment</h5>
                    <p class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight italic">
                        "Helping organizations navigate complexity through world-recognized certification and technical consultancy since 1999."
                    </p>
                </div>

            </div>
        </section>
    </div>
</template>
