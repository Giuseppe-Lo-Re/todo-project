<template>
    <main>

        <h1>Ciao sono stampato da Vuejs!</h1>

        <Todos />
    </main>
</template>

<script>
import Todos from '../components/Todos.vue'

export default {
    name: 'App',
    components: {
        Todos
    }
}
</script>