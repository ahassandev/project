<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import RichTextEditor from '@/components/RichTextEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
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
    parent_id: number | null;
    is_top: boolean;
    images: ServiceImage[];
}

const props = defineProps<{
    service: Service;
    parentServices: Array<{ id: number; title: string }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services',
        href: '/services',
    },
    {
        title: 'Edit',
        href: `/services/${props.service.id}/edit`,
    },
];

const form = useForm({
    title: props.service.title,
    description: props.service.description,
    parent_id: props.service.parent_id,
    is_top: Boolean(props.service.is_top),
    images: [] as File[],
    delete_images: [] as number[],
    _method: 'patch',
});

const toggleImageDeletion = (id: number) => {
    const index = form.delete_images.indexOf(id);
    if (index > -1) {
        form.delete_images.splice(index, 1);
    } else {
        form.delete_images.push(id);
    }
};

const submit = () => {
    form.post(`/services/${props.service.id}`, {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Edit Service" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-2xl p-4 md:p-8">
            <div class="mb-6">
                <Heading title="Edit Service" description="Update the service details and image." />
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-2">
                    <Label for="title">Title</Label>
                    <Input id="title" v-model="form.title" placeholder="Service title" :disabled="form.processing"></Input>
                    <div v-if="form.errors.title" class="text-sm text-destructive">{{ form.errors.title }}</div>
                </div>

                <div class="space-y-2">
                    <Label for="parent_id">Parent Service (Optional)</Label>
                    <select
                        id="parent_id"
                        v-model="form.parent_id"
                        @change="() => { if (form.parent_id !== null) form.is_top = false; }"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        <option :value="null">None (Top Level)</option>
                        <option v-for="parent in parentServices" :key="parent.id" :value="parent.id">
                            {{ parent.title }}
                        </option>
                    </select>
                    <div v-if="form.errors.parent_id" class="text-sm text-destructive">{{ form.errors.parent_id }}</div>
                </div>

                <div class="space-y-2 border p-4 rounded-md bg-slate-50">
                    <div class="flex items-center space-x-2">
                        <input
                            type="checkbox"
                            id="is_top"
                            v-model="form.is_top"
                            :disabled="form.processing || form.parent_id !== null"
                            class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary disabled:opacity-50"
                        />
                        <Label for="is_top" class="cursor-pointer" :class="{ 'opacity-50': form.parent_id !== null }">
                            Show in Top Menu
                        </Label>
                    </div>
                    <p class="text-xs text-muted-foreground mt-1">
                        Only up to 2 top-level services can be shown in the main navigation menu. (Cannot be checked if a Parent Service is selected)
                    </p>
                    <div v-if="form.errors.is_top" class="text-sm text-destructive mt-1">{{ form.errors.is_top }}</div>
                </div>

                <div class="space-y-2">
                    <Label for="description">Description</Label>
                    <RichTextEditor
                        id="description"
                        v-model="form.description"
                        :disabled="form.processing"
                    />
                    <div v-if="form.errors.description" class="text-sm text-destructive">{{ form.errors.description }}</div>
                </div>

                <div class="space-y-4">
                    <Label>Images</Label>

                    <div v-if="service.images && service.images.length > 0" class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        <div v-for="image in service.images" :key="image.id" class="relative group aspect-square">
                            <img
                                :src="`/storage/${image.image_path}`"
                                alt="Service Image"
                                class="w-full h-full object-cover rounded-md border"
                                :class="{ 'opacity-50 grayscale': form.delete_images.includes(image.id) }"
                            />
                            <button
                                type="button"
                                @click="toggleImageDeletion(image.id)"
                                class="absolute top-1 right-1 p-1 bg-background/80 rounded-full border shadow-sm opacity-0 group-hover:opacity-100 transition-opacity"
                                :class="{ 'opacity-100 bg-destructive text-destructive-foreground': form.delete_images.includes(image.id) }"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2M10 11v6m4-11v6" />
                                </svg>
                            </button>
                            <div v-if="form.delete_images.includes(image.id)" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <span class="bg-destructive text-destructive-foreground text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider">To be deleted</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <Label for="images">Add New Images</Label>
                        <Input
                            id="images"
                            type="file"
                            multiple
                            @input="form.images = Array.from(($event.target as HTMLInputElement).files || [])"
                            accept="image/*"
                            :disabled="form.processing"
                        ></Input>
                        <div v-if="form.errors.images" class="text-sm text-destructive">{{ form.errors.images }}</div>
                        <div v-if="form.images.length > 0" class="mt-2 text-sm text-muted-foreground">
                            {{ form.images.length }} new images selected
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button class="cursor-pointer" type="submit"  :disabled="form.processing">
                        {{ form.processing ? 'Updating...' : 'Update Service' }}
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
