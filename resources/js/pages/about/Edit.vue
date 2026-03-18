<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import RichTextEditor from '@/components/RichTextEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { ref } from 'vue';
import { Plus, Trash2 } from 'lucide-vue-next';

interface About {
    id: number;
    title: string;
    mission_title: string;
    mission_content: string;
    vision_title: string;
    vision_content: string;
    team_content: string;
    standards_content: string;
    excellence_content: string;
    professional_statement: string;
    hero_image: string | null;
    expertise_label: string;
    expertise_title: string;
    expertise_subtitle: string | null;
    expertise_description: string | null;
    expertise_image: string | null;
    expertise_experience_years: string;
    expertise_services: string[] | null;
}

const props = defineProps<{
    about: About;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'About Us',
        href: '/about-edit',
    },
    {
        title: 'Edit',
        href: '/about-edit',
    },
];

const form = useForm({
    title: props.about.title,
    mission_title: props.about.mission_title,
    mission_content: props.about.mission_content,
    vision_title: props.about.vision_title,
    vision_content: props.about.vision_content,
    team_content: props.about.team_content,
    standards_content: props.about.standards_content,
    excellence_content: props.about.excellence_content,
    professional_statement: props.about.professional_statement,
    hero_image: null as File | null,
    expertise_label: props.about.expertise_label,
    expertise_title: props.about.expertise_title,
    expertise_subtitle: props.about.expertise_subtitle,
    expertise_description: props.about.expertise_description,
    expertise_image: null as File | null,
    expertise_experience_years: props.about.expertise_experience_years,
    expertise_services: props.about.expertise_services || [
        'Lean Manufacturing',
        'Food Safety Management',
        'Technical CE',
        'Quality Management',
        'Safety & Health (SHE)',
        'Social Compliance'
    ],
});

const addService = () => {
    form.expertise_services.push('');
};

const removeService = (index: number) => {
    form.expertise_services.splice(index, 1);
};

const heroPreview = ref<string | null>(props.about.hero_image ? (props.about.hero_image.startsWith('http') ? props.about.hero_image : `/storage/${props.about.hero_image}`) : null);
const expertisePreview = ref<string | null>(props.about.expertise_image ? (props.about.expertise_image.startsWith('http') ? props.about.expertise_image : `/storage/${props.about.expertise_image}`) : null);

const onHeroFileChange = (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0];
    if (file) {
        form.hero_image = file;
        heroPreview.value = URL.createObjectURL(file);
    }
};

const onExpertiseFileChange = (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0];
    if (file) {
        form.expertise_image = file;
        expertisePreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post('/about-update', {
        forceFormData: true,
        onSuccess: () => {
            // Updated successfully
        }
    });
};
</script>

<template>
    <Head title="Edit About Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl p-4 md:p-8">
            <div class="mb-6">
                <Heading title="Edit About Page" description="Update the content of the About Us page." />
            </div>

            <form @submit.prevent="submit" class="space-y-8 pb-20">
                <!-- Hero Section -->
                <div class="space-y-4 border-b pb-6">
                    <h3 class="text-lg font-bold text-blue-600 uppercase tracking-wider">Hero Section</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="title">Hero Title</Label>
                            <Input id="title" v-model="form.title" placeholder="About Us" :disabled="form.processing"></Input>
                            <div v-if="form.errors.title" class="text-sm text-destructive">{{ form.errors.title }}</div>
                        </div>
                        <div class="space-y-2">
                            <Label for="hero_image">Hero Background Image</Label>
                            <Input id="hero_image" type="file" @change="onHeroFileChange" accept="image/*" :disabled="form.processing"></Input>
                            <div v-if="heroPreview" class="mt-2 relative w-full h-32 rounded-lg overflow-hidden border">
                                <img :src="heroPreview" class="w-full h-full object-cover" />
                            </div>
                            <div v-if="form.errors.hero_image" class="text-sm text-destructive">{{ form.errors.hero_image }}</div>
                        </div>
                    </div>
                </div>

                <!-- Expertise Section (As requested by image) -->
                <div class="space-y-6 border-b pb-6 p-6 rounded-2xl border-blue-100">
                    <h3 class="text-lg font-bold text-blue-600 uppercase tracking-wider">Our Expertise Section</h3>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="expertise_label">Section Label (blue text at top)</Label>
                            <Input id="expertise_label" v-model="form.expertise_label" placeholder="Our Expertise" :disabled="form.processing"></Input>
                        </div>
                        <div class="space-y-2">
                            <Label for="expertise_experience_years">Experience Years Badge</Label>
                            <Input id="expertise_experience_years" v-model="form.expertise_experience_years" placeholder="20+" :disabled="form.processing"></Input>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <Label for="expertise_title">Section Heading (Large text)</Label>
                        <Input id="expertise_title" v-model="form.expertise_title" placeholder="WE ARE THE LEADER..." :disabled="form.processing"></Input>
                    </div>
                    <div class="space-y-2">
                        <Label for="expertise_subtitle">Quote/Subtitle (Blue background box)</Label>
                        <textarea
                            id="expertise_subtitle"
                            v-model="form.expertise_subtitle"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            :disabled="form.processing"
                        ></textarea>
                    </div>
                    <div class="space-y-2">
                        <Label for="expertise_description">Description Paragraph</Label>
                        <textarea
                            id="expertise_description"
                            v-model="form.expertise_description"
                            class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            :disabled="form.processing"
                        ></textarea>
                    </div>
                    <div class="space-y-2">
                        <Label for="expertise_image">Featured Image (Right side)</Label>
                        <Input id="expertise_image" type="file" @change="onExpertiseFileChange" accept="image/*" :disabled="form.processing"></Input>
                        <div v-if="expertisePreview" class="mt-2 relative aspect-video w-full max-w-sm rounded-xl overflow-hidden border shadow-sm">
                            <img :src="expertisePreview" class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <!-- Dynamic Expertise Services List -->
                    <div class="space-y-4 pt-4 border-t">
                        <div class="flex items-center justify-between">
                            <Label>Expertise Services / Bullet Points</Label>
                            <Button type="button" variant="outline" size="sm" @click="addService" class="h-8 gap-1">
                                <Plus class="w-4 h-4" />
                                Add Service
                            </Button>
                        </div>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div v-for="(_, index) in form.expertise_services" :key="index" class="flex gap-2">
                                <Input v-model="form.expertise_services[index]" placeholder="Service title..." :disabled="form.processing" />
                                <Button
                                    type="button"
                                    variant="ghost"
                                    size="icon"
                                    @click="removeService(index)"
                                    class="shrink-0 text-destructive hover:text-destructive hover:bg-destructive/10"
                                    :disabled="form.processing || form.expertise_services.length <= 1"
                                >
                                    <Trash2 class="w-4 h-4" />
                                </Button>
                            </div>
                        </div>
                        <div v-if="form.errors.expertise_services" class="text-sm text-destructive">{{ form.errors.expertise_services }}</div>
                    </div>
                </div>

                <!-- Mission & Vision -->
                <div class="grid md:grid-cols-2 gap-8 border-b pb-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-blue-600">Mission</h3>
                        <div class="space-y-2">
                            <Label for="mission_title">Mission Title</Label>
                            <Input id="mission_title" v-model="form.mission_title" :disabled="form.processing"></Input>
                        </div>
                        <div class="space-y-2">
                            <Label for="mission_content">Mission Content</Label>
                            <RichTextEditor id="mission_content" v-model="form.mission_content" :disabled="form.processing" />
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-blue-600">Vision</h3>
                        <div class="space-y-2">
                            <Label for="vision_title">Vision Title</Label>
                            <Input id="vision_title" v-model="form.vision_title" :disabled="form.processing"></Input>
                        </div>
                        <div class="space-y-2">
                            <Label for="vision_content">Vision Content</Label>
                            <RichTextEditor id="vision_content" v-model="form.vision_content" :disabled="form.processing" />
                        </div>
                    </div>
                </div>

                <!-- Strategic Pillars -->
                <div class="space-y-6 border-b pb-6">
                    <h3 class="text-lg font-bold text-blue-600">Strategic Pillars</h3>
                    <div class="grid gap-6">
                        <div class="space-y-2">
                            <Label for="team_content">Our Team</Label>
                            <RichTextEditor id="team_content" v-model="form.team_content" :disabled="form.processing" />
                        </div>
                        <div class="space-y-2">
                            <Label for="standards_content">Standards</Label>
                            <RichTextEditor id="standards_content" v-model="form.standards_content" :disabled="form.processing" />
                        </div>
                        <div class="space-y-2">
                            <Label for="excellence_content">Excellence</Label>
                            <RichTextEditor id="excellence_content" v-model="form.excellence_content" :disabled="form.processing" />
                        </div>
                    </div>
                </div>

                <!-- Professional Statement -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-blue-600">Professional Statement</h3>
                    <div class="space-y-2">
                        <Label for="professional_statement">Statement Text (Italic slogan at bottom)</Label>
                        <textarea
                            id="professional_statement"
                            v-model="form.professional_statement"
                            class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            :disabled="form.processing"
                        ></textarea>
                    </div>
                </div>

                <div class="sticky bottom-6 flex items-center gap-4backdrop-blur p-4 rounded-xl border shadow-lg z-10">
                    <Button class="cursor-pointer px-8" type="submit"  :disabled="form.processing">
                        {{ form.processing ? 'Saving Changes...' : 'Save All Changes' }}
                    </Button>
                    <div v-if="form.recentlySuccessful" class="text-sm text-green-600 font-bold animate-in fade-in slide-in-from-left-2">
                         Changes saved successfully!
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
