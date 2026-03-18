<script setup lang="ts">
import { Phone, Mail } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showSuccess = ref(false);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});

const submit = () => {
    form.post('/callback-request', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            showSuccess.value = true;
            setTimeout(() => {
                showSuccess.value = false;
            }, 5000);
        },
    });
};
</script>

<template>
    <section id="request-a-call-back" class="py-16 md:py-24 px-6 bg-white overflow-hidden">
        <div class="max-w-[1500px] w-full mx-auto grid lg:grid-cols-2 gap-8 lg:gap-16 items-start">
            <div class="space-y-8">
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 leading-none">
                    REQUEST A <br/><span class="text-blue-600 uppercase">CALL BACK</span>
                </h2>
                <p class="text-lg text-slate-600 max-w-lg font-medium leading-relaxed">
                    Need expert advice on certifications? Leave your details below and our specialists will reach out to you within 24 hours.
                </p>
                <div class="flex flex-col gap-6 pt-4">
                    <a href="https://wa.me/923000000000" target="_blank" class="flex items-center gap-4 text-slate-700 font-bold group hover:text-blue-600 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-blue-600/20">
                            <Phone class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest leading-none mb-1">Call Us Anywhere</div>
                            <div class="text-xl">+92 300 0000000</div>
                        </div>
                    </a>
                    <a href="mailto:mahassan082@gmail.com" class="flex items-center gap-4 text-slate-700 font-bold group hover:text-blue-900 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-blue-900 text-white flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-blue-900/20">
                            <Mail class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest leading-none mb-1">Email Us Anytime</div>
                            <div class="text-xl">mahassan082@gmail.com</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-100 p-6 md:p-12 rounded-3xl shadow-2xl shadow-blue-900/10">
                <div v-if="showSuccess" class="mb-8 p-4 bg-green-100 border border-green-200 text-green-800 rounded-xl font-bold text-center animate-bounce">
                    Thank you! Your request has been sent successfully.
                </div>

                <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase text-blue-900 tracking-wider pl-1">Name</label>
                        <input v-model="form.name" type="text" placeholder="Full Name"
                               class="w-full bg-white border border-blue-200 px-5 py-4 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-semibold"
                               :class="{'border-red-500': form.errors.name}" />
                        <div v-if="form.errors.name" class="text-red-500 text-xs font-bold pl-1">{{ form.errors.name }}</div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase text-blue-900 tracking-wider pl-1">Email</label>
                        <input v-model="form.email" type="text" placeholder="Your Email"
                               class="w-full bg-white border border-blue-200 px-5 py-4 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-semibold"
                               :class="{'border-red-500': form.errors.email}" />
                        <div v-if="form.errors.email" class="text-red-500 text-xs font-bold pl-1">{{ form.errors.email }}</div>
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-black uppercase text-blue-900 tracking-wider pl-1">Phone</label>
                        <input v-model="form.phone" type="text" placeholder="+92 000 000 0000"
                               class="w-full bg-white border border-blue-200 px-5 py-4 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-semibold"
                               :class="{'border-red-500': form.errors.phone}" />
                        <div v-if="form.errors.phone" class="text-red-500 text-xs font-bold pl-1">{{ form.errors.phone }}</div>
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-black uppercase text-blue-900 tracking-wider pl-1">Message</label>
                        <textarea v-model="form.message" placeholder="How can we help you?" rows="4"
                                  class="w-full bg-white border border-blue-200 px-5 py-4 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-semibold"
                                  :class="{'border-red-500': form.errors.message}"></textarea>
                        <div v-if="form.errors.message" class="text-red-500 text-xs font-bold pl-1">{{ form.errors.message }}</div>
                    </div>
                    <div class="md:col-span-2 pt-2">
                        <button type="submit" :disabled="form.processing"
                                class="w-full cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-xl transition-all shadow-xl shadow-blue-600/30 hover:shadow-2xl active:scale-[0.98] uppercase tracking-[0.2em] disabled:opacity-50">
                            {{ form.processing ? 'Sending...' : 'Send Message Now' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>
