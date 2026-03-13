<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

function debounce<T extends (...args: any[]) => void>(fn: T, delay: number) {
    let timeoutId: ReturnType<typeof setTimeout>;
    return (...args: Parameters<T>) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn(...args), delay);
    };
}

interface Service {
    id: number;
    title: string;
    description: string;
    image_path: string | null;
    parent?: {
        id: number;
        title: string;
    } | null;
}

const props = defineProps<{
    services: Service[];
    filters?: {
        search?: string;
    };
}>();

const search = ref(props.filters?.search || '');

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services',
        href: '/services',
    },
];

const deleteService = (id: number) => {
    if (confirm('Are you sure you want to delete this service?')) {
        router.delete(`/services/${id}`);
    }
};

watch(search, debounce((value: string) => {
    router.get('/services', { search: value }, {
        preserveState: true,
        replace: true
    });
}, 300));
</script>

<template>
    <Head title="Services" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 md:p-8">
            <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Services</h1>
                </div>
                <div class="flex flex-1 gap-2 max-w-md">
                    <Input
                        v-model="search"
                        placeholder="Search services..."
                        class="max-w-xs"
                    ></Input>
                    <Link href="/services/create">
                        <Button class="cursor-pointer">Add Service</Button>
                    </Link>
                </div>
            </div>

            <div class="bg-background border rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted text-muted-foreground font-medium border-b text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Parent</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr v-for="service in services" :key="service.id" class="hover:bg-muted/50 transition-colors group">
                            <td class="px-6 py-4 font-medium decoration-primary decoration-2 group-hover:underline cursor-pointer" @click="router.get(`/services/${service.id}`)">
                                {{ service.title }}
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="service.parent" class="bg-secondary text-secondary-foreground px-2 py-1 rounded text-[10px] font-medium uppercase tracking-wider">
                                    {{ service.parent.title }}
                                </span>
                                <span v-else class="text-muted-foreground italic text-xs">Top Level</span>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground">
                                <div class="line-clamp-2 text-sm prose prose-sm max-w-none" v-html="service.description"></div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <Link :href="`/services/${service.id}`">
                                        <Button variant="ghost" size="sm" class="cursor-pointer">View</Button>
                                    </Link>
                                    <Link :href="`/services/${service.id}/edit`">
                                        <Button variant="ghost" size="sm" class="text-primary hover:text-primary hover:bg-primary/10 cursor-pointer">Edit</Button>
                                    </Link>
                                    <Button variant="ghost" size="sm" class="text-destructive hover:text-destructive hover:bg-destructive/10 cursor-pointer" @click="deleteService(service.id)">
                                        Delete
                                    </Button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="services.length === 0" class="text-center py-12 bg-background border rounded-lg mt-6">
                <p class="text-muted-foreground text-sm">No services found. Create your first service!</p>
            </div>
        </div>
    </AppLayout>
</template>
