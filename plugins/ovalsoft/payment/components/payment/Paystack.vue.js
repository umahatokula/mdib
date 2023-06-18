var Todo = Vue.extend({
      props: {
          tasks: {
              coerce: function (val) {
                  return JSON.parse(val);
              }
          },
      },
      data: function() {
          return {
              title: 'To Do List',
              newTask: '',
            };
      },
      methods: {
          addTask: function() {
              var self = this;
              $.request("onAddTask", {
                  data: {
                      newTask: self.newTask,
                  },
                  success: function(data) {
                      self.tasks.push(data.newTask);
                      self.newTask = '';
                  },
              });
          },
          deleteTask: function(task_id) {
              var self = this;
              $.request("onDeleteTask", {
                  data: {
                      task_id: task_id
                  },
                  success: function() {
                      self.tasks = self.tasks
                          .filter(function (el) {
                                return el.id !== task_id;
                           }
                      );
                  }
              });
          }
      }
  });