
<template>
  <!-- Title -->
  <div class="text-center">
    <h1 class="mt-5">
        <span class="text-warning p-1">T</span>
        <span class="text-success p-1">O</span>
        <span class="text-danger p-1">D</span>
        <span class="text-primary p-1">O</span>
    </h1>

    <!-- new To Do Form -->
      <div class="mb-3">
        <form @submit.prevent="addTodo" class="form-inline my-2 my-lg-0">

          <div class="card-body d-flex justify-content-between">

            <!-- Description input -->
            <input v-model="newTodo" class="card-body" type="search" placeholder="Aggiungi un nuovo todo" aria-label="Aggiungi">

            <!-- Add button -->
            <button class="btn btn-success btn-sm ml-2 px-3" type="submit">Salva</button>
          </div>
        </form>
      </div>

    <!-- Draggagle container -->
    <draggable v-model="todoList" :options="{animation: 150}" @end="updateTodoList(todoList)">
        
      <!-- For Loop for print todos -->
      <div v-for="todo in todoList" :key="todo.id" class="card mb-2">
        
        <!-- Single To Do -->
        <div class="card-body d-flex justify-content-between">
        
          <!-- Description -->
          <div class="card-title">
              {{ todo.description }}
          </div>

          <!-- Delete button -->
          <button @click="removeTodo(todo.id)" class="btn btn-danger btn-sm">
            Elimina
          </button>
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
        todoList: [],
        newTodo: ''
      }
    },
    methods: {
      updateTodoList(todoList) {
        console.log("todolist: ", todoList);

        // Convert list in a ids array
        let updatedTodoIds = todoList.map(todo => todo.id);

        // Axios call that sends order position array
        axios.post('/api/save-todo-order', {
          order_position: updatedTodoIds
        })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.log(error)
        })

        // Recall getTodoList to retrieve todolist
        // this.getTodoList();
      },
    
      addTodo() {

        // If the new todo description > 0
        if (this.newTodo.trim().length > 0) {

          // Axios call that send new todo
          axios.post('/api/save-new-todo', {
            description: this.newTodo
          })
          .then(response => {
            this.todoList.push(response.data)
            this.newTodo = ''
          })
          .catch(error => {
            console.log(error)
          });

          // Recall getTodoList to retrieve todolist
          this.getTodoList();
        }
      },
      
      removeTodo(id) {

        // Remove todo with specific id and return a new array without it
        this.todoList = this.todoList.filter(todo => todo.id !== id)

        // Axios call to delete selected todo
        axios.delete(`/api/delete-todo/${id}`)
          .then(response => {
            console.log(response)
          })
          .catch(error => {
            console.log(error)
          })
      },

      getTodoList() {

        // Axios call to retrieve todo list
        axios.get('/api/todos')
        .then((response) => {
          this.todoList = response.data.results;
        })
      }
    },

    // When the component has been mounted to the DOM, throw getTodoList()
    mounted() {
      this.getTodoList()
    }
  }
  </script>