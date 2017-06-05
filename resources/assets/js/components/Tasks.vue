<template>
    <div class="">
        <h3>Lista de tarefas</h3>
        <ul>
            <li v-for="task in tasks">{{ task.title }}</li>
        </ul>

        <input type="text" v-model="newTask" placeholder="Digite a tarefa e pressione enter para salvar..." @keyup.enter="store">
    </div>
</template>

<script>
    export default {
        props: ['content'],

        data: function() {
            return {
                tasks: {},
                newTask: ''
            }
        },

        created() {
            console.log('Iniciou...');
            this.tasks = this.content;
        },

        methods: {
            store() {
                axios.post('/task', {task: this.newTask}).then(function(response){
                    console.log(response);
                });

                this.tasks.push({title: this.newTask});
                this.newTask = '';
            }
        }
    }
</script>

<style media="screen">
    input[type="text"] {
        width: 500px;
    }
</style>
