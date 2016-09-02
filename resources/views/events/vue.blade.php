@extends('app')
<link rel="stylesheet" href="http://s.mlcdn.co/animate.css">

@section('content')
<style media="screen">
  div.completed{
    border-left:2px solid red
  }
</style>

<div id="fh5co-work-section" class="fh5co-light-grey-section">
  <div class="container">
    <div id="app">
      <tasks :list="tasks"></tasks>
    </div>
  </div>
</div>

<template id="tasks-template">
  <h1  v-show="remaining">
    @{{remaining}}
    Active  Events   <a  class="btn btn-sm btn-danger pull-right"  @click="clearCompleted" > Clear All Completed</a>
  </h1>

  <div class="alert alert-danger"  v-show="!remaining">
    <p class="lead" >
      No Active  Events  <a  class="btn btn-sm btn-danger pull-right"  @click="clearCompleted" > Clear All Completed</a>
    </p>
  </div>

    <div class="" v-show="list.length">
      <div :class="{ 'completed':task.completed }"
        v-for="task in list"

      >
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"></h3>
        </div>
        <div class="panel-body">
          @{{task.body}}<br>
          Complete:@{{task.completed}}
          <a  class="btn btn-sm btn-info pull-right" v-show="! task.completed"  @click="task.completed = ! task.completed" > Mark Completed </a>
          <a  class="btn btn-sm btn-success pull-right" v-show="task.completed"  @click="task.completed = ! task.completed" > Mark Incomplete </a>
          <a  class="btn btn-sm btn-danger pull-right" v-show="task.completed"  @click="deleteTask(task)" > Remove Task</a>
        </div>
        <div class="panel-footer">
        </div>
      </div>
    </div>
    <div class="" v-show="!list.length">
      <div class="panel panel-body">
        <h1>No Events Found</h1>
      </div>
    </div>
  </div>

</template>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
<script type="text/javascript">

  Vue.component('tasks', {
    props:['list'],

    template:'#tasks-template',

    computed: {
      // a computed getter
      remaining: function () {
        var vm= this;
        return this.list.filter(this.inProgress).length;
      }
    },

    methods: {
      isCompleted: function(task){
        return task.completed;
      },

      inProgress: function(task){
        return ! this.isCompleted(task);
      },

      deleteTask: function(task){
        this.list.$remove(task);
      },
      clearCompleted: function(){
        this.list=this.list.filter(this.inProgress);
      }
    }
  });

  new Vue({
    el:'#app',

    data:{
        tasks:[
          {body:'go to store', completed: false},
          {body:'go to movies', completed: true},
          {body:'eat more meat', completed: false},
          {body:'go to flophouse', completed: false},
          {body:'go to drugstore', completed: true},
          {body:'eat more ass', completed: false},
        ]
    }
  });

</script>
@stop
