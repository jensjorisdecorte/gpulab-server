<div class="container">
  <div id='editor_holder'></div>
  <hr/>
  <button type="button" id="submit" class="btn btn-primary">Submit job</button>
</div>
         
<span id='valid_indicator' class='label'></span>

    <script>
     
      // Initialize the editor
      var editor = new JSONEditor(document.getElementById('editor_holder'),{
        // Enable fetching schemas via ajax
        ajax: true,
        disable_collapse: true,
        disable_edit_json: true,
        disable_properties: true,
        disable_array_reorder: true,
        compact: true,
        
        // The schema for the editor
        schema: {
          type: 'object',
          title: 'New Job',
          properties: {
            jobDefinition: {
              type: 'object',
              title: 'jobDefinition',
              properties: {
                name: {
                  type: 'string',
                  minLength: 1
                },
                description: {
                  type: 'string'
                },
                dockerImage: {
                  type: 'string',
                  enum: [
                    'gpulab.ilabt.imec.be:5000/jupyter-example:v2',
                  ],
                  default: 'gpulab.ilabt.imec.be:5000/jupyter-example:v2'
                },
                command: {
                  type: 'string'
                },
                resources: {
                  type: 'object',
                  title: 'resources',
                  properties: {
                    gpus: {
                      type: 'integer',
                      default: 1
                    },
                    systemMemory: {
                      type: 'integer',
                      default: 2000
                    },
                    cpuCores: {
                      type: 'integer',
                      default: 1
                    }
                  },
                },
                jobDataLocations: {
                  type: 'array',
                  uniqueItems: true,
                  format: 'table',
                  items: {
                    type: 'object',
                    properties: {
                      mountPoint: {
                        type: 'string',
                        enum: ['/project',]
                      }
                    }
                  }
                },
                portMappings: {
                  type: 'array',
                  uniqueItems: true,
                  format: 'table',
                  items: {
                    type: 'object',
                    properties: {
                      containerPort: {
                        type: 'integer',
                        default: 8888
                      }
                    }
                  }
                }
              }
            }
          }
        },
        
      });

      var entityMap = {
        //'&': '&amp;',
        //'<': '&lt;',
        //'>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
        '/': '&#x2F;',
        //'`': '&#x60;',
        //'=': '&#x3D;'
      };
      function escapeHtml (string) {
        return String(string).replace(/[&<>"'`=\/]/g, function (s) {
          return entityMap[s];
        });
      }
      
      // Hook up the submit button to log to the console
      document.getElementById('submit').addEventListener('click',function() {
        // Get the value from the editor
        var json = editor.getValue();
        json.jobDefinition.name = "<?php echo getenv("GPULAB_SERVER_JOB_PREFIX"); ?>" + json.jobDefinition.name;
        var jsonString = escapeHtml(JSON.stringify(json));
        console.log(jsonString);
        var url = '/create.php';
        var form = $('<form action="' + url + '" method="post">' +
          '<input type="text" name="json" value="' + jsonString + '" />' +
          '</form>');
        $('body').append(form);
        form.submit();
        $('form').remove();
      });
            
      // Hook up the validation indicator to update its 
      // status whenever the editor changes
      editor.on('change',function() {
        // Get an array of errors from the validator
        var errors = editor.validate();
        
        // Not valid
        if(errors.length) {
          $('button').prop('disabled', true);
        }
        // Valid
        else {
          $('button').prop('disabled', false);
        }
      });
    </script>