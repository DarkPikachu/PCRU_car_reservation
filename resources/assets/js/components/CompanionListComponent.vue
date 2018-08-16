<template>
    <div id="todo-list-example">
        <form v-on:submit.prevent="addNewTodo">
            <label for="new-todo">เพิ่มผู้ร่วมเดินทาง</label>
            <input
                v-model="newTodoText"
                id="new-todo"
                placeholder="ชื่อ-สกุล"
            >
            <button>Add</button>
        </form>
        <ul>
            <li is="todo-item"
                v-for="(todo, index) in todos"
                v-bind:key="todo.id"
                v-bind:title="todo.title"
                v-on:remove="todos.splice(index, 1)"
            ></li>
        </ul>
    </div>
</template>

<script>
    Vue.component('todo-item', {
        template: '<li>\
            {{ title }}\
            <button v-on:click="$emit(\'remove\')">Remove</button>\
            </li>\
        ',
        props: ['title']
    })

    export default {
        data() {
            return{
                newTodoText: '',
                todos: [],
                nextTodoId: 1,
                sum: 0
            }
        },
        methods: {
            addNewTodo: function () {
                this.todos.push({
                    id: this.nextTodoId++,
                    title: this.newTodoText
                })
                this.newTodoText = ''
            },
        }
    }
</script>