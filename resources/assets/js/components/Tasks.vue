<template>
    <div>
        <h3>Lista de tarefas</h3>
        <span class="legend">Clique no nome da tarefa 2x para abrir o editor, aperte ENTER para salvar ou ESC para cancelar a edição.</span>
        <div class="list-group">
            <div class="list-group-item" v-for="task in tasks">
                <div @keyup.esc="cancelEdit(task, $event)" @keydown.prevent.enter="update(task, $event)" @click="edit($event)">{{ task.title }}</div>
                <i @click="destroy(task.id)" class="glyphicon glyphicon-trash right" title="Excluir"></i>
            </div>
        </div>

        <input type="text" class="form-control" v-model="newTask" placeholder="Digite a tarefa e pressione enter para salvar..." @keyup.enter="store">
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
            this.tasks = this.content;
        },

        methods: {
            store() {
                let that = this;
                axios.post('/task', {task: {title: this.newTask}}).then(function(response) {
                    that.tasks.push(response.data);
                    that.newTask = '';
                });
            },

            update(task, event) {
                event.target.setAttribute('contenteditable', false);
                task.title = event.target.innerHTML;

                axios.put('/task/' + task.id, {task: task});
            },

            destroy(id) {
                let that = this;
                axios.delete('/task/' + id).then(function() {
                    that.tasks = _.filter(that.tasks, function(task) { return task.id != id });
                });
            },

            edit(event) {
                event.target.setAttribute('contenteditable', true);
            },

            cancelEdit(task, event) {
                event.target.setAttribute('contenteditable', false);
                event.target.innerHTML = task.title;
            }
        }
    }
</script>

<style media="screen">
    input[type="text"] {
        width: 500px;
    }

    .right {
        float: right;
    }

    .list-group-item i {
        margin-top: -18px;
        cursor: pointer;
    }

    div[contenteditable="true"] {
        border: 1px solid black;
    }

    .legend {
        font-size: 0.8em;
    }
</style>
