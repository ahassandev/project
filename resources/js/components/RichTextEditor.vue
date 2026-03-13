<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import {
    Bold,
    Italic,
    List,
    ListOrdered,
    Quote,
    Undo,
    Redo,
    Heading1,
    Heading2,
    Type
} from 'lucide-vue-next';
import { watch } from 'vue';

const props = defineProps<{
    modelValue: string;
    disabled?: boolean;
}>();

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    editable: !props.disabled,
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    },
    editorProps: {
        attributes: {
            class: 'prose prose-sm dark:prose-invert max-w-none min-h-[150px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 overflow-y-auto',
        },
    },
});

watch(() => props.modelValue, (value) => {
    if (editor.value && editor.value.getHTML() !== value) {
        editor.value.commands.setContent(value, false);
    }
});

watch(() => props.disabled, (value) => {
    if (editor.value) {
        editor.value.setEditable(!value);
    }
});
</script>

<template>
    <div class="flex flex-col gap-2">
        <div v-if="editor" class="flex flex-wrap gap-1 p-1 border rounded-md bg-muted/50">
            <button
                type="button"
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run() || disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('bold') }"
                title="Bold"
            >
                <Bold class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run() || disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('italic') }"
                title="Italic"
            >
                <Italic class="w-4 h-4" />
            </button>
            <div class="w-px h-6 bg-border mx-1 my-auto"></div>
            <button
                type="button"
                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :disabled="disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('heading', { level: 1 }) }"
                title="Heading 1"
            >
                <Heading1 class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :disabled="disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('heading', { level: 2 }) }"
                title="Heading 2"
            >
                <Heading2 class="w-4 h-4" />
            </button>
            <div class="w-px h-6 bg-border mx-1 my-auto"></div>
            <button
                type="button"
                @click="editor.chain().focus().toggleBulletList().run()"
                :disabled="disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('bulletList') }"
                title="Bullet List"
            >
                <List class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleOrderedList().run()"
                :disabled="disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('orderedList') }"
                title="Ordered List"
            >
                <ListOrdered class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleBlockquote().run()"
                :disabled="disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                :class="{ 'bg-background shadow-sm': editor.isActive('blockquote') }"
                title="Blockquote"
            >
                <Quote class="w-4 h-4" />
            </button>
            <div class="w-px h-6 bg-border mx-1 my-auto flex-1"></div>
            <button
                type="button"
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run() || disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                title="Undo"
            >
                <Undo class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run() || disabled"
                class="p-1.5 rounded-md hover:bg-background transition-colors"
                title="Redo"
            >
                <Redo class="w-4 h-4" />
            </button>
        </div>
        <EditorContent :editor="editor" />
    </div>
</template>

<style>
/* Basic styles for the editor content */
.tiptap p.is-editor-empty:first-child::before {
  content: attr(data-placeholder);
  float: left;
  color: #adb5bd;
  pointer-events: none;
  height: 0;
}

.tiptap ul {
    list-style-type: disc;
    padding-left: 1.5rem;
}

.tiptap ol {
    list-style-type: decimal;
    padding-left: 1.5rem;
}

.tiptap blockquote {
    border-left: 3px solid #e1e1e1;
    padding-left: 1rem;
    font-style: italic;
}
</style>
