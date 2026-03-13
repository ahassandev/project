<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import RichTextEditor from '@/components/RichTextEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services',
        href: '/services',
    },
    {
        title: 'Create',
        href: '/services/create',
    },
];

const props = defineProps<{
    parentServices: Array<{ id: number; title: string }>;
}>();

const form = useForm({
    title: '',
    description: '',
    parent_id: null as number | null,
    images: [] as File[],
    is_top: false,
});

const submit = () => {
    form.post('/services', {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Create Service" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-2xl p-4 md:p-8">
            <div class="mb-6">
                <Heading title="Create Service" description="Add a new service with a title, description, and image." />
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

                <div class="space-y-2">
                    <Label for="images">Images</Label>
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
                        {{ form.images.length }} images selected
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button class="cursor-pointer" type="submit" :disabled="form.processing">
                        {{ form.processing ? 'Creating...' : 'Create Service' }}
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
