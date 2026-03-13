<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import PublicHeader from '@/components/PublicHeader.vue';
import PublicFooter from '@/components/PublicFooter.vue';
import RequestCallback from '@/components/RequestCallback.vue';
import HomeTestimonials from '@/components/HomeTestimonials.vue';
import { ref } from 'vue';

const props = defineProps<{
    service: {
        id: number;
        title: string;
        description: string;
        slug: string;
        image_path: string | null;
        images: Array<{ image_path: string }>;
        children: Array<{ id: number; title: string; slug: string; children?: Array<any> }>;
    };
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
    canRegister?: boolean;
}>();

// Image Gallery Logic
const allImages = ref<string[]>([]);
const selectedImage = ref<string | null>(null);

if (props.service) {
    const images: string[] = [];
    if (props.service.image_path) {
        images.push('/storage/' + props.service.image_path);
    }
    if (props.service.images && props.service.images.length > 0) {
        props.service.images.forEach(img => {
            const path = '/storage/' + img.image_path;
            if (!images.includes(path)) {
                images.push(path);
            }
        });
    }
    allImages.value = images;
    selectedImage.value = images.length > 0 ? images[0] : null;
}

const selectImage = (path: string) => {
    selectedImage.value = path;
};
</script>

<template>
    <Head :title="service.title + ' - ISO Systems'" />

    <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">
        <PublicHeader :canRegister="canRegister" />

        <main class="pt-[110px]">
            <!-- Hero Header -->
            <section class="relative pt-16 pb-12 flex items-center justify-center overflow-hidden bg-blue-900 border-b border-blue-800">
                <!-- Background Gradient -->
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-blue-900 z-10"></div>
                </div>

                <div class="max-w-[1500px] w-full mx-auto px-6 relative z-20 text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-4 tracking-tight">
                        {{ service.title }}
                    </h1>
                    <div class="flex items-center justify-center gap-2 text-blue-200 text-sm font-medium tracking-wide">
                        <Link href="/" class="hover:text-white transition-colors">Home</Link>
                        <span>/</span>
                        <span class="text-white">Services</span>
                        <span>/</span>
                        <span class="text-white">{{ service.title }}</span>
                    </div>
                </div>
            </section>

            <!-- Service Details Content -->
            <section class="py-20 px-6 bg-slate-50">
                <div class="max-w-[1500px] w-full mx-auto relative z-20">

                    <!-- Main Content Description -->
                    <div class="space-y-10">
                        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 font-medium">
                            <!-- Modern Image Gallery -->
                            <div v-if="allImages.length > 0" class="mb-12 space-y-4">
                                <!-- Main Featured Image (Optimized Size) -->
                                <div class="relative w-full max-w-4xl mx-auto aspect-[16/9] md:aspect-[21/9] rounded-2xl overflow-hidden shadow-2xl border border-slate-100 bg-slate-100 group">
                                    <transition name="fade" mode="out-in">
                                        <img :key="selectedImage" :src="selectedImage!"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                             :alt="service.title">
                                    </transition>

                                    <!-- Overlay Gradient for Sleek Look -->
                                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-linear-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                </div>

                                <!-- Thumbnails Grid -->
                                <div v-if="allImages.length > 1" class="flex flex-wrap justify-center gap-3 py-2">
                                    <button v-for="(img, index) in allImages" :key="index"
                                            @click="selectImage(img)"
                                            class="relative w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border-2 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none"
                                            :class="selectedImage === img ? 'border-blue-600 shadow-lg shadow-blue-600/20' : 'border-transparent opacity-60 hover:opacity-100'">
                                        <img :src="img" class="w-full h-full object-cover" :alt="`${service.title} thumbnail ${index + 1}`">
                                        <div v-if="selectedImage === img" class="absolute inset-0 bg-blue-600/10"></div>
                                    </button>
                                </div>
                            </div>

                            <h2 class="text-3xl font-black text-slate-800 mb-6 tracking-tight">Overview</h2>
                            <div class="prose prose-blue max-w-none text-slate-600 leading-relaxed font-medium">
                                <div v-html="service.description"></div>
                            </div>

                            <!-- Related Sub-services -->
                            <div v-if="service.children && service.children.length > 0" class="mt-12 pt-8 border-t border-slate-100">
                                <h3 class="text-2xl font-bold text-slate-800 mb-6">Related Services</h3>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <Link v-for="child in service.children" :key="child.id" :href="child.slug ? '/service/' + child.slug : '#'"
                                          class="group flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-blue-500 hover:bg-blue-50/50 transition-all">
                                        <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">{{ child.title }}</span>
                                        <ArrowRight class="w-4 h-4 text-slate-300 group-hover:text-blue-600 transition-colors group-hover:translate-x-1" />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <HomeTestimonials />
            <RequestCallback />
        </main>

        <PublicFooter />
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

body {
  font-family: 'Inter', sans-serif;
}

/* Gallery Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scale(0.98);
}
</style>
