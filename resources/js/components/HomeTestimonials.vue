<template>
    <!-- Testimonials -->
    <section class="py-24 bg-slate-900 text-white overflow-hidden relative">
        <div class="max-w-[1500px] w-full mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="space-y-10">
                <div class="space-y-4">
                    <h2 class="text-blue-400 font-black text-sm uppercase tracking-[0.2em]">Testimonials</h2>
                    <h3 class="text-4xl md:text-5xl font-black leading-tight uppercase">
                        WHAT OUR <span class="text-blue-400">HAPPY CLIENTS</span> SAY!!!
                    </h3>
                </div>
                <div class="bg-white/5 backdrop-blur-lg p-10 rounded-3xl border border-white/10 relative">
                    <div class="text-6xl text-blue-500 font-serif absolute -top-4 left-6 opacity-30 cursor-default">“</div>
                    <p class="text-xl text-slate-300 leading-relaxed mb-8 font-medium">
                        "The consultancy program at ISO Systems was transformational for our operations. Their technical support and guidance for ISO 9001 certification were top-notch and professional."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-blue-500 shadow-xl shadow-blue-500/20">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Client">
                        </div>
                        <div>
                            <div class="text-xl font-black tracking-tight text-white uppercase">SAMI SHEIKH</div>
                            <div class="text-blue-400 text-xs font-bold uppercase tracking-widest">Operations Director</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden md:block relative group">
                <div class="absolute inset-0 bg-blue-600 rounded-full blur-[100px] opacity-20 group-hover:opacity-30 transition-opacity"></div>
                <div class="relative aspect-square rounded-3xl overflow-hidden shadow-2xl border-2 border-white/10 rotate-3 group-hover:rotate-0 transition-transform duration-700">
                     <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80" class="w-full h-full object-cover" alt="Client business">
                </div>
            </div>
        </div>
    </section>
</template>
