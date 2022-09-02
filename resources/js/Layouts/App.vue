<template>
    
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                                <Link :href="route('blogs.index')" :class="{ 'font-bold': $page.component === 'Blogs/Index' }">Blogs</Link>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                                Hi, {{ $page.props.auth.user.name }}!
                            </div>
                        </div>
                        <div class="flex">
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center float-right">
                                <Link :href="route('logout')" method="post" as="button" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded">Logout</Link>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    }
}

</script>