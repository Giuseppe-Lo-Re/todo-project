
<template>
  <div class="text-center">
    <h1>To Do</h1>
    <draggable v-model="todoList" :options="{animation: 150}" @change="updateTodoList">

        <!-- new To Do Form -->
        <div class="mb-5">
            <form @submit.prevent="addTodo" class="form-inline my-2 my-lg-0">
                <input v-model="newTodoText" class="form-control mr-sm-2" type="search" placeholder="Aggiungi un nuovo todo" aria-label="Aggiungi">
                <button class="btn btn-success btn-sm mt-3" type="submit">Aggiungi</button>
            </form>
        </div>
    
      <div v-for="todo in todos" :key="todo.id" class="card mb-2">

        <!-- Single To Do -->
        <div class="card-body d-flex justify-content-between">
          <div class="card-title">{{ todo.description }}</div>
          <button @click="removeTodo(todo.id)" class="btn btn-danger btn-sm">Elimina</button>
        </div>
      </div>
    </draggable>
    
  </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'

export default {
  components: {
    draggable
  },
  data() {
    return {
      todos: [],
      newTodoText: ''
    }
  },
  methods: {
    
  },
  mounted() {
        axios.get('/api/todos')
        .then((response) => {
            this.todos = response.data.results;
        });
    }
}