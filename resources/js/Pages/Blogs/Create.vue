<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout, Head, Link
    },
    setup() {
        const form =  useForm({
            title: '',
            slug: '',
            content: '',
            image: ''
        })

        return { form }
    }
}
</script>

<template>
    <Head title="Blog Create" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Blog Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="form.post(route('blogs.store'))">
                            <div class="mb-4">
                                <input
                                    type="file"
                                    name="image"
                                    @input="form.image = $event.target.files[0]"
                                />
                                <div
                                    v-if="form.errors.image"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.image }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="Title"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Title</label
                                >
                                <input
                                    type="text"
                                    v-model="form.title"
                                    name="title"
                                    class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.title"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.title }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="Slug"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Slug</label
                                >
                                <input
                                    type="text"
                                    v-model="form.slug"
                                    name="title"
                                    class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.slug"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.slug }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="slug"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Content</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.content"
                                    name="content"
                                    id=""
                                    class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.content"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.content }}
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>