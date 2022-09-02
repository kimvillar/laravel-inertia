<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        AppLayout, Head, Link
    },
    props: {
        blogs: Object
    },
    setup() {
        const destroy = (id) => {
            if(confirm('Are you sure?')){
                Inertia.delete(route('blogs.destroy', id))
            }
        }

        return { destroy }
    }
}
</script>

<template>
    <Head title="Blog List" />
    
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Blogs Index
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="$page.props.flash.message"
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert"
                >
                    <span class="font-medium">
                        {{ $page.props.flash.message }}
                    </span>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                       <div class="mb-2">
                            <Link v-if="$page.props.permissions.manage" :href="route('blogs.create')" class="inline-block px-4 py-3 bg-slate-800 text-white rounded mb-4">
                                Add Blog</Link
                            >
                        </div>
                         <div
                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Slug
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="blog in blogs"
                                        :key="blog.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ blog.id }}
                                        </th>
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ blog.title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ blog.slug }}
                                        </td>


                                        <td class="px-6 py-4">
                                            <Link v-if="$page.props.permissions.manage"
                                                :href="
                                                    route(
                                                        'blogs.edit',
                                                        blog.id
                                                    )
                                                "
                                               class="px-4 py-2 text-white bg-blue-600 rounded" >Edit</Link
                                            >
                                        </td>
                                        <td class="px-6 py-4">
                                            <button v-if="$page.props.permissions.manage"
                                                class="bg-red-700 px-4 py-2 text-white rounded"
                                                @click="destroy(blog.id)"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>

