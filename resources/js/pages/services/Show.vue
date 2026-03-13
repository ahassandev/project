<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import type { BreadcrumbItem } from '@/types';

interface ServiceImage {
    id: number;
    image_path: string;
}

interface Service {
    id: number;
    title: string;
    description: string;
    image_path: string | null;
    images: ServiceImage[];
    parent?: {
        id: number;
        title: string;
    } | null;
    children?: Array<{
        id: number;
        title: string;
        image_path: string | null;
    }>;
}

const props = defineProps<{
    service: Service;
}>();

const breadcrumbs = computed((): BreadcrumbItem[] => {
    const items: BreadcrumbItem[] = [
        {
            title: 'Services',
            href: '/services',
        },
    ];

    if (props.service.parent) {
        items.push({
            title: props.service.parent.title,
            href: `/services/${props.service.parent.id}`,
        });
    }

    items.push({
        title: props.service.title,
        href: `/services/${props.service.id}`,
    });

    return items;
});
</script>

<template>
    <Head :title="service.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl p-4 md:p-8 mx-auto">
            <div class="mb-6 flex items-center justify-between">
                <Link href="/services">
                    <Button variant="outline" class="cursor-pointer" size="sm">Back to List</Button>
                </Link>
                <Link :href="`/services/${service.id}/edit`">
                    <Button class="cursor-pointer" size="sm">Edit Service</Button>
                </Link>
            </div>

            <Card class="overflow-hidden">
                <div v-if="service.images && service.images.length > 0" class="space-y-4 p-4 md:p-6 bg-muted/30">
                    <!-- Featured Image -->
                    <div class="flex justify-center bg-background rounded-lg border p-2 shadow-sm overflow-hidden">
                        <img
                            :src="`/storage/${service.images[0].image_path}`"
                            :alt="service.title"
                            class="w-full max-w-2xl h-auto max-h-[400px] object-contain rounded-md"
                        />
                    </div>

                    <!-- Thumbnail Grid -->
                    <div v-if="service.images.length > 1" class="grid grid-cols-4 md:grid-cols-6 gap-2">
                        <div v-for="(image, index) in service.images" :key="image.id" class="aspect-square rounded-md border bg-background overflow-hidden p-1 shadow-sm hover:ring-2 hover:ring-primary/50 transition-all cursor-pointer">
                            <img
                                :src="`/storage/${image.image_path}`"
                                :alt="`${service.title} - ${index + 1}`"
                                class="w-full h-full object-cover rounded-sm"
                            />
                        </div>
                    </div>
                </div>
                <div v-else-if="service.image_path" class="w-full bg-muted p-4 flex justify-center">
                    <img
                        :src="`/storage/${service.image_path}`"
                        :alt="service.title"
                        class="w-full max-w-md h-auto max-h-[300px] object-contain rounded-md shadow-sm"
                    />
                </div>
                <CardHeader>
                    <CardTitle class="text-3xl font-bold">{{ service.title }}</CardTitle>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <div
                            v-html="service.description"
                            class="rich-text-content text-base leading-relaxed"
                        ></div>
                    </div>

                    <div v-if="service.children && service.children.length > 0" class="mt-8 pt-8 border-t">
                        <h3 class="text-xl font-semibold mb-4 text-foreground/80">Sub-Services</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <Link
                                v-for="child in service.children"
                                :key="child.id"
                                :href="`/services/${child.id}`"
                                class="flex items-center gap-4 p-3 rounded-lg border bg-card hover:bg-muted/50 transition-colors shadow-sm overflow-hidden"
                            >
                                <div class="w-16 h-16 shrink-0 rounded border bg-muted overflow-hidden">
                                    <img
                                        v-if="child.image_path"
                                        :src="`/storage/${child.image_path}`"
                                        class="w-full h-full object-cover"
                                    />
                                    <div v-else class="w-full h-full flex items-center justify-center text-muted-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="font-medium truncate">{{ child.title }}</span>
                            </Link>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>

<style scoped>
.rich-text-content :deep(p) {
    margin-bottom: 1rem;
}

.rich-text-content :deep(ul) {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.rich-text-content :deep(ol) {
    list-style-type: decimal;
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.rich-text-content :deep(h1) {
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.rich-text-content :deep(h2) {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.75rem;
}

.rich-text-content :deep(blockquote) {
    border-left: 4px solid #e5e7eb;
    padding-left: 1rem;
    font-style: italic;
    color: #6b7280;
    margin-bottom: 1rem;
}
</style>
