<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface LinkType {
    url: string | null;
    label: string;
    active: boolean;
}

defineProps<{
    links: LinkType[];
}>();
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap items-center justify-center gap-1 mt-6">
        <template v-for="(link, key) in links" :key="key">
            <div v-if="link.url === null"
                 class="px-4 py-2 text-sm text-slate-400 bg-white border border-slate-200 rounded-md cursor-not-allowed leading-5"
                 v-html="link.label">
            </div>
            <Link v-else
                  :href="link.url"
                  class="px-4 py-2 text-sm font-medium border rounded-md leading-5 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                  :class="link.active ? 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700' : 'bg-white text-slate-700 border-slate-200'"
                  preserve-scroll
                  v-html="link.label" />
        </template>
    </div>
</template>
