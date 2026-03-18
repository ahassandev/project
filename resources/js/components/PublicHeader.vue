<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    MapPin,
    Mail,
    Clock,
    ArrowRight,
    Menu,
    X
} from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const props = defineProps<{
    // Props removed as they are no longer needed for public view
}>();

const isMenuOpen = ref(false);
const expandedMobileServices = ref<number[]>([]);
const isScrolled = ref(false);
const topServices = ref<any[]>([]);

const toggleMobileService = (id: number) => {
    if (expandedMobileServices.value.includes(id)) {
        expandedMobileServices.value = expandedMobileServices.value.filter(i => i !== id);
    } else {
        expandedMobileServices.value.push(id);
    }
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(async () => {
    window.addEventListener('scroll', handleScroll);
    try {
        const response = await axios.get('/api/services/top');
        topServices.value = response.data;
    } catch (error) {
        console.error('Error fetching top services:', error);
    }
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <!-- Global Header Container -->
    <div class="fixed top-0 left-0 w-full z-[100] transition-all duration-500">
        <!-- Top Info Bar -->
        <div
            class="hidden lg:block bg-blue-900 text-white overflow-hidden transition-all duration-500"
            :class="[isScrolled ? 'max-h-0 opacity-0' : 'max-h-[100px] py-3 px-6 opacity-100']"
        >
            <div class="max-w-[1500px] mx-auto w-full flex justify-between items-center text-sm font-bold tracking-tight">
                <div class="flex gap-10">
                    <div class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-full bg-blue-800 flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                            <MapPin class="w-4 h-4 text-blue-300" />
                        </div>
                        <span class="hover:text-blue-300 transition-colors cursor-default">123 ISO Street, Suite 456, Lahore, Pakistan</span>
                    </div>
                    <a href="mailto:mahassan082@gmail.com" class="flex items-center gap-3 group hover:text-blue-300 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-blue-800 flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                            <Mail class="w-4 h-4 text-blue-300" />
                        </div>
                        <span class="font-medium tracking-tight">mahassan082@gmail.com</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-full bg-blue-800 flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                        <Clock class="w-4 h-4 text-blue-300" />
                    </div>
                    <span class="hover:text-blue-300 transition-colors cursor-default">Mon - Fri: 9:00 AM - 6:00 PM</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <header
            class="transition-all duration-300 w-full border-b"
            :class="[
                isScrolled
                    ? 'bg-white py-3 border-transparent'
                    : 'bg-white py-4 border-slate-100'
            ]"
        >
            <div class="max-w-[1500px] w-full mx-auto px-4 md:px-6 flex justify-between items-center">
            <!-- Logo -->
            <Link href="/" class="flex items-center gap-2 group cursor-pointer">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl group-hover:rotate-12 transition-transform shadow-lg shadow-blue-600/20">
                    ISO
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-xl font-black tracking-tighter text-blue-900">SYSTEMS</span>
                    <span class="text-[11px] font-black text-blue-600 uppercase tracking-widest">Consultancy</span>
                </div>
            </Link>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-10 text-[13px] font-black uppercase tracking-widest text-slate-700">
                <Link href="/" class="hover:text-blue-600 transition-colors relative group py-2">
                    Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                </Link>
                <Link href="/about" class="hover:text-blue-600 transition-colors relative group py-2">
                    About
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                </Link>

                <!-- Services Dropdown (Desktop) -->
                <div class="relative group py-4">
                    <button class="flex items-center gap-1 hover:text-blue-600 transition-colors uppercase font-black tracking-widest">
                        Services
                        <ArrowRight class="w-3.5 h-3.5 rotate-90" />
                    </button>

                    <div class="absolute top-full left-0 mt-0 w-56 bg-white shadow-2xl rounded-2xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[100] py-3 translate-y-2 group-hover:translate-y-0">
                        <ul class="flex flex-col">
                            <li v-for="parent in topServices" :key="parent.id" class="relative group/sub">
                                <Link :href="parent.slug ? '/service/' + parent.slug : '#'" class="px-5 py-2.5 flex items-center justify-between text-slate-700 hover:text-blue-600 hover:bg-blue-50/50 transition-all text-[11px] font-black uppercase tracking-wider min-h-[40px]">
                                    <span class="wrap-break-words whitespace-normal pr-2 leading-tight">{{ parent.title }}</span>
                                    <ArrowRight v-if="parent.children && parent.children.length" class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                </Link>

                                <!-- Level 2 Sub-menu -->
                                <div v-if="parent.children && parent.children.length" class="absolute top-0 left-full ml-0.5 w-56 bg-white shadow-2xl rounded-2xl border border-slate-100 opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 z-[101] py-3">
                                    <ul class="flex flex-col">
                                        <li v-for="child in parent.children" :key="child.id" class="relative group/subsub">
                                            <Link :href="child.slug ? '/service/' + child.slug : '#'" class="px-5 py-2.5 flex items-center justify-between text-slate-700 hover:text-blue-600 hover:bg-blue-50/50 transition-all text-[11px] font-black uppercase tracking-wider min-h-[38px]">
                                                <span class="wrap-break-words whitespace-normal pr-2 leading-tight">{{ child.title }}</span>
                                                <ArrowRight v-if="child.children && child.children.length" class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                            </Link>

                                            <!-- Level 3 Sub-sub-menu -->
                                            <div v-if="child.children && child.children.length" class="absolute top-0 left-full ml-0.5 w-56 bg-white shadow-2xl rounded-2xl border border-slate-100 opacity-0 invisible group-hover/subsub:opacity-100 group-hover/subsub:visible transition-all duration-300 z-[102] py-3">
                                                <ul class="flex flex-col">
                                                    <li v-for="subchild in child.children" :key="subchild.id">
                                                        <Link :href="subchild.slug ? '/service/' + subchild.slug : '#'" class="px-5 py-2.5 block text-slate-700 hover:text-blue-600 hover:bg-blue-50/50 transition-all text-[11px] font-black uppercase tracking-wider break-words whitespace-normal leading-tight">
                                                            {{ subchild.title }}
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li v-if="topServices.length === 0">
                                <span class="px-5 py-3 block text-slate-400 text-[10px] font-bold italic">No services available</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <Link href="/contact" class="hover:text-blue-600 transition-colors relative group py-2">
                    Contact
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                </Link>
            </nav>

            <!-- Auth / CTA -->
            <div class="flex items-center gap-4 md:gap-6">
                <!-- Only 'Get a Quote' button should appear for all users on public website -->
                <a href="/#request-a-call-back" class="hidden sm:inline-flex bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 md:px-8 md:py-3 rounded-full text-[10px] md:text-xs font-black transition-all hover:shadow-xl hover:shadow-blue-600/20 active:scale-95 uppercase tracking-widest">
                    GET A QUOTE
                </a>

                <!-- Mobile Menu Button -->
                <button @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 text-slate-700 hover:text-blue-600 transition-colors">
                    <Menu v-if="!isMenuOpen" class="w-7 h-7" />
                    <X v-else class="w-7 h-7" />
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="isMenuOpen" class="md:hidden absolute top-full left-0 w-full bg-white border-t border-slate-100 shadow-2xl animate-in slide-in-from-top duration-300 max-h-[85vh] overflow-y-auto">
            <nav class="flex flex-col p-8 gap-6 text-sm font-black text-slate-700 uppercase tracking-widest">
                <Link href="/about" class="hover:text-blue-600 transition-colors border-b border-slate-50 pb-4">About</Link>

                <!-- Mobile Services -->
                <div v-for="parent in topServices" :key="parent.id" class="border-b border-slate-50 pb-4">
                    <button @click="parent.children && parent.children.length ? toggleMobileService(parent.id) : null"
                            class="w-full flex items-center justify-between text-blue-600 text-xs mb-2 py-2">
                        <Link v-if="!parent.children || !parent.children.length" :href="parent.slug ? '/service/' + parent.slug : '#'">{{ parent.title }}</Link>
                        <span v-else>{{ parent.title }}</span>
                        <ArrowRight v-if="parent.children && parent.children.length"
                                    class="w-5 h-5 transition-transform duration-200"
                                    :class="expandedMobileServices.includes(parent.id) ? 'rotate-90' : ''" />
                    </button>

                    <!-- Mobile Level 2 -->
                    <ul v-if="expandedMobileServices.includes(parent.id)" class="pl-4 space-y-4 mb-2 mt-4">
                        <li v-for="child in parent.children" :key="child.id">
                            <div class="flex flex-col">
                                <button @click="child.children && child.children.length ? toggleMobileService(child.id) : null"
                                        class="w-full flex items-center justify-between text-slate-600 hover:text-blue-600 transition-colors text-xs font-bold py-2">
                                    <Link v-if="!child.children || !child.children.length" :href="child.slug ? '/service/' + child.slug : '#'">{{ child.title }}</Link>
                                    <span v-else>{{ child.title }}</span>
                                    <ArrowRight v-if="child.children && child.children.length"
                                                class="w-4 h-4 text-slate-400 transition-transform duration-200"
                                                :class="expandedMobileServices.includes(child.id) ? 'rotate-90' : ''" />
                                </button>

                                <!-- Mobile Level 3 -->
                                <ul v-if="expandedMobileServices.includes(child.id)" class="pl-4 space-y-4 mt-4 border-l-2 border-slate-100">
                                    <li v-for="subchild in child.children" :key="subchild.id">
                                        <Link :href="subchild.slug ? '/service/' + subchild.slug : '#'" class="text-slate-500 hover:text-blue-600 transition-colors text-[11px] font-bold block py-1">
                                            {{ subchild.title }}
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <Link href="/contact" class="hover:text-blue-600 transition-colors border-b border-slate-50 pb-4">Contact</Link>

                <a href="/#request-a-call-back" @click="isMenuOpen = false" class="sm:hidden mt-2 bg-blue-600 hover:bg-blue-700 text-white text-center px-8 py-4 rounded-xl text-xs font-black transition-all shadow-lg shadow-blue-600/20 active:scale-95 uppercase tracking-widest">
                    GET A QUOTE
                </a>
            </nav>
        </div>
    </header>
    </div>
</template>
