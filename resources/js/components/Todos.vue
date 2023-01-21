
<template>
  <div class="text-center">
    <h1>To Do</h1>
    <draggable v-model="todoList" :options="{animation: 150}" @change="updateTodoList">

        <!-- new To Do Form -->
        <div class="mb-5">
            <form @submit.prevent="addTodo" class="form-inline my-2 my-lg-0">

                <!-- Description input -->
                <input v-model="newTodoText" class="form-control mr-sm-2" type="search" placeholder="Aggiungi un nuovo todo" aria-label="Aggiungi">

                <!-- Add button -->
                <button class="btn btn-success btn-sm mt-3" type="submit">Aggiungi</button>
            </form>
        </div>
    
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
      newTodoText: ''
    }
  },
  methods: {
    updateTodoList() {
        
        // invia l'array di todos
        axios.post('/api/save-todo-order', {
            todos: this.todoList
        })
        .then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        })
        console.log(this.todoList);
    }
  },
  mounted() {
        axios.get('/api/todos')
        .then((response) => {
            this.todoList = response.data.results;
        });
    }
// //   methods: {
// //     updateTodoList() {
// //       // converti la lista in un array di id
// //       let updatedTodoIds = this.todoList.map(todo => todo.id)

// //       // invia l'array di id al server per salvare l'ordine aggiornato
// //       axios.post('/api/save-todo-order', {
// //         order: updatedTodoIds
// //       })
// //       .then(response => {
// //         console.log(response)
// //       })
// //       .catch(error => {
// //         console.log(error)
// //       })
// //     },
// //     addTodo() {
// //         if (this.newTodoText.trim().length > 0) {
// //                 axios.post('/api/todo', {
// //                 text: this.newTodoText,
// //                 status: 'Da fare'
// //             })
// //             .then(response => {
// //                 this.todoList.push(response.data)
// //                 this.newTodoText = ''
// //             })
// //             .catch(error => {
// //                 console.log(error)
// //             })
// //         }
// //     }
// }
}



// <script>
// import draggable from 'vuedraggable'

// export default {
//     name: 'Todos',
//     components: {
//         draggable
//     },
//     data() {
//         return {
//             todos: []
//         };
//     },
//     mounted() {
//         axios.get('/api/todos')
//         .then((response) => {
//             this.todos = response.data.results;
            
//         });
//     }
// }
// </script>