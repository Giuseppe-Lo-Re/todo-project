<template>
  <div>
    <div>
    
    <!-------------------- If user is logged -------------------->
    <div v-if="isUserLogged">

      <!-- Private area/Logout buttons -->
      <div class="d-flex justify-content-between">

        <!-- Private area -->
        <div>
          <a class="btn btn-outline-primary btn-sm" href="/admin">
            Area privata
          </a>
        </div>

        <!-- Logout -->
        <div>
          <button @click="getLogout" class="btn btn-outline-danger btn-sm">
            Logout
          </button>
        </div>
      </div>

      <div class="text-center">

        <!-- Title -->
        <h1 class="display-3 mt-5">
            <span class="text-warning p-1">T</span>
            <span class="text-success p-1">O</span>
            <span class="text-danger p-1">D</span>
            <span class="text-primary p-1">O</span>
        </h1>

        <!-- Create Todo Form -->
        <div class="mb-3">
          <form @submit.prevent="addTodo" class="form-inline my-2 my-lg-0">
            <div class="card-body d-flex justify-content-between">

              <!-- Description input -->
              <input v-model="newTodo" class="card-body" type="search" placeholder="Crea un nuovo todo..." aria-label="Aggiungi">

              <!-- Save button -->
              <button class="btn btn-success btn-sm ml-2 px-3" type="submit">
                Salva
              </button>
            </div>
          </form>
        </div>

        <!-- Draggagle container -->
        <draggable v-model="todoList" :options="{animation: 150}" @end="updateTodoList(todoList)">
            
          <!-- For Loop for print todos -->
          <div v-for="todo in todoList" :key="todo.id" class="card mb-2">
            
            <!-- Single To Do Row -->
            <div class="card-body d-flex justify-content-between">
            
              <!-- Description -->
              <div class="card-title">
                  {{ todo.description }}
              </div>

              <!-- Update/Delete buttons -->
              <div>
                <!-- Update button  ->   NOT IMPLEMENTED
                <button @click="updateTodo(todo.id)" class="btn btn-warning btn-sm">
                  Modifica
                </button> -->

                <!-- Delete -->
                <button @click="removeTodo(todo.id)" class="btn btn-danger btn-sm">
                  Elimina
                </button>
              </div>
            </div>
          </div>
        </draggable>
      </div>
    </div>
    
    <!-------------------- If user is NOT logged -------------------->
    <div v-else>

      <!-- Title -->
      <div class="text-center">
        <h1 class="display-1 mt-5 pt-5 text-center">
          <span class="text-warning p-1">T</span>
          <span class="text-success p-1">O</span>
          <span class="text-danger p-1">D</span>
          <span class="text-primary p-1">O</span>
        </h1>

        <!-- Acronym subtitle -->
        <div>
          <span class="display- text-warning p-1 mr-3">
            <strong>
              Task
            </strong>
          </span>
          <span class="text-success p-1">
            <strong>
              Organizer
            </strong>
          </span>
          <em class="p-1 mr-1">
            and
          </em>
          <span class="text-danger p-1">
            <strong>
              Daily
            </strong>
          </span>
          <span class="text-primary p-1 ml-3">
            <strong>
              Operations
            </strong>
          </span>
        </div>
        
        <!-- Login/Register buttons -->
        <div class="mt-5">

          <!-- Login -->
          <a class="btn btn-outline-success btn-sm" href="/login">
            <span>
              Accedi
            </span>
          </a>

          <!-- Tilde -->
          <span class="text-danger mx-3">
            <strong>
              ~
            </strong> 
          </span>

          <!-- Register -->
          <a class="btn btn-outline-primary btn-sm" href="/register">
            <span>
              Registrati
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div> 
</template>

<script>
  import draggable from 'vuedraggable'
  import axios from 'axios'

  export default {
    components: {
      draggable
    },
    computed: {

        // Define is user is logged(return boolean)
        isUserLogged() {
          return  window.user;
        }
    },
    data() {
      return {
        todoList: [],
        newTodo: '',
      }
    },
    methods: {

      getLogout() {
      
      // Axios call to logout user
        axios.post('/logout')
        .then(response => {

          // redirect on login home
          location.reload()
        })
        .catch(error => {
          console.log(error)
        })
      },

      updateTodoList(todoList) {

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
      },
    
      addTodo() {

        // If the new todo description > 0
        if (this.newTodo.trim().length > 0) {

          // Axios call that send new todo
          axios.post('/api/save-new-todo', {
            description: this.newTodo
          })
          .then(response => {

            // Add the new todo from response.data to todoList
            this.todoList.push(response.data);
            this.newTodo = ''
          })
          .catch(error => {
            console.log(error)
          });

          // Recall getTodoList to retrieve todolist
          this.getTodoList();
        }
      },
      
      // updateTodo(id) { --> NOT IMPLEMENTED

      //   if (this.selectedTodo.description.trim().length > 0) {
      //     axios.patch(`/api/todos/${this.selectedTodo.id}`, {
      //       description: this.selectedTodo.description,
      //     })
      //     .then(response => {
      //       this.getTodoList()
      //     })
      //     .catch(error => {
      //       console.log(error)
      //     })
      //   }
      // },

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
          console.log(response);

          // Save the list from response.data.results to todoList
          this.todoList = response.data.results;
        })
      }
    },

    // When the component has been mounted to the DOM, throw getTodoList()
    mounted() {
      this.getTodoList();
    }
  }
  </script>