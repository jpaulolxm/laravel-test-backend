<template>
    <Link :href="'/'">
        <img src="https://accordous.com.br/wp-content/uploads/2020/05/HORIZONTAL-1.png" style="height: 50px" />
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Link,
        },
    }
</script>
