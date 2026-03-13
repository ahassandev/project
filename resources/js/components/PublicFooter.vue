<script setup lang="ts">
import { Facebook, Twitter, Linkedin, Instagram, MapPin, Phone, ArrowRight, MessageCircle } from 'lucide-vue-next';
</script>

<template>
    <!-- Newsletter Sub-Footer -->
    <div class="bg-blue-600 py-10">
        <div class="max-w-[1500px] w-full mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-white space-y-1 text-center md:text-left">
                <h4 class="text-2xl font-black tracking-tight uppercase">Subscribe to our Newsletter</h4>
                <p class="text-blue-100 text-sm font-medium">Get the latest updates on ISO standards and certification trends.</p>
            </div>
            <div class="w-full max-w-md flex bg-white/10 backdrop-blur-md p-2 rounded-2xl border border-white/20">
                <input type="email" placeholder="Enter your email" class="bg-transparent border-none outline-none grow px-4 font-bold text-white placeholder:text-blue-200/60" />
                <button class="bg-white text-blue-600 px-6 py-3 rounded-xl font-black uppercase text-xs hover:bg-blue-50 transition-colors tracking-widest">
                    Join Now
                </button>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="bg-slate-900 text-white pt-24 pb-12 overflow-hidden relative">
        <div class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-blue-600/5 rounded-full blur-[150px] translate-y-1/2 translate-x-1/2 -z-0"></div>

        <div class="max-w-[1500px] w-full mx-auto px-6 relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 border-b border-white/5 pb-20">
            <!-- Branding -->
            <div class="space-y-8">
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl">
                        ISO
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase">SYSTEMS</span>
                </div>
                <p class="text-slate-400 font-medium leading-relaxed">
                    Leading provider of consultancy and certification services in Pakistan, committed to operational excellence and business growth through globally recognized standards.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-blue-600 transition-all hover:-translate-y-1"><Facebook class="w-5 h-5 text-slate-300" /></a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-blue-400 transition-all hover:-translate-y-1"><Twitter class="w-5 h-5 text-slate-300" /></a>
                    <a href="https://pk.linkedin.com/" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-blue-700 transition-all hover:-translate-y-1"><Linkedin class="w-5 h-5 text-slate-300" /></a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-pink-600 transition-all hover:-translate-y-1"><Instagram class="w-5 h-5 text-slate-300" /></a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <h4 class="text-lg font-black uppercase tracking-widest text-blue-400">Get In Touch</h4>
                <ul class="space-y-6">
                    <li class="flex gap-4">
                        <MapPin class="w-6 h-6 text-blue-500 shrink-0" />
                        <span class="text-slate-400 font-medium leading-relaxed">Suit No. 1, Second Floor, Phase 4, Block 6, DHA, Lahore, Pakistan</span>
                    </li>
                    <li class="flex gap-4">
                        <Phone class="w-6 h-6 text-blue-500 shrink-0" />
                        <span class="text-slate-400 font-medium">+92 344 000 0000</span>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="space-y-8">
                <h4 class="text-lg font-black uppercase tracking-widest text-blue-400">Quick Links</h4>
                <ul class="space-y-4 font-bold text-slate-400">
                    <li><a href="/" class="hover:text-blue-500 transition-colors flex items-center gap-2"><ArrowRight class="w-3 h-3 text-blue-500/50" /> Home</a></li>
                    <li><a href="about" class="hover:text-blue-500 transition-colors flex items-center gap-2"><ArrowRight class="w-3 h-3 text-blue-500/50" /> About Us</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition-colors flex items-center gap-2"><ArrowRight class="w-3 h-3 text-blue-500/50" /> Our Services</a></li>
                    <li><a href="contact" class="hover:text-blue-500 transition-colors flex items-center gap-2"><ArrowRight class="w-3 h-3 text-blue-500/50" /> Contact Info</a></li>
                </ul>
            </div>

            <!-- Disclaimer -->
            <div class="space-y-8">
                <h4 class="text-lg font-black uppercase tracking-widest text-blue-400">Disclaimer</h4>
                <p class="text-[13px] text-slate-500 font-medium leading-relaxed uppercase tracking-tight">
                    This website is for information purposes only. Intellectual property and logos belong to their respective owners. ISO Systems is an independent consultancy firm.
                </p>
                <div class="p-4 bg-white/5 rounded-xl border border-white/5">
                     <div class="text-[10px] font-black text-blue-400 uppercase mb-1">Status</div>
                     <div class="text-xs font-bold text-slate-300">Certified Platinum Partner 2026</div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="max-w-[1500px] w-full mx-auto px-6 pt-12 flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest">
                &copy; 2026 ISO SYSTEMS - ALL RIGHTS RESERVED
            </p>
            <div class="flex gap-8 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">
                <a href="#" class="hover:text-blue-500 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/923000000000" target="_blank" class="fixed bottom-8 right-8 z-[60] group flex items-center gap-3">
        <span class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-full text-slate-900 text-sm font-bold opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all duration-300 shadow-xl border border-slate-100">
            Chat with Experts
        </span>
        <div class="w-16 h-16 bg-[#25D366] text-white flex items-center justify-center rounded-full shadow-[0_10px_40px_rgba(37,211,102,0.4)] hover:scale-110 transition-transform active:scale-95">
            <MessageCircle class="w-8 h-8" />
        </div>
    </a>
</template>
