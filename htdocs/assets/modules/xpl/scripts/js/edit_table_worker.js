var otableId = '';

    function set_table_id(table_ID){
        otableId = table_ID;
    }

    function prepare_phrases(phrases, renew = false){
        var table = document.getElementById(otableId).getElementsByTagName('tbody')[0];
        if(renew === true){
            var tableHeaderRowCount = 0;
            var rowCount = table.rows.length;
            for (var i = tableHeaderRowCount; i < rowCount; i++) {
                table.deleteRow(tableHeaderRowCount);
            }
        }
                
        for (var phrase in phrases) {
            var newRow = table.insertRow(table.rows.length);        
            addCell(newRow, 0, '<input type="text" class="form-control form-control-lg rounded-0" name="original_phrase" id="original_phrase" required="" value="'+phrases[phrase]['phrase']+'">');
            addCell(newRow, 1, '<input type="text" class="form-control form-control-lg rounded-0" name="locle_phrase" id="locle_phrase" required="" value="'+phrases[phrase]['phrase_lng']+'">');
            addCell(newRow, 2, '<button type="button" class="btn btn-danger" onclick="deleteRow(this)"><ion-icon name="trash"></ion-icon></button>');
        }
    }
    
    function addRow(){
        var table = document.getElementById(otableId).getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();       
            addCell(newRow, 0, '<input type="text" class="form-control form-control-lg rounded-0" name="original_phrase" id="original_phrase" required="" value="">');
            addCell(newRow, 1, '<input type="text" class="form-control form-control-lg rounded-0" name="locle_phrase" id="locle_phrase" required="" value="">');
            addCell(newRow, 2, '<button type="button" class="btn btn-danger" onclick="deleteRow(this)"><ion-icon name="trash"></ion-icon></button>');
    }
    
    function addCell(row, cell, text){
        var newCell  = row.insertCell(cell);
        newCell.innerHTML = text;
    }
    
    function deleteRow(btn) {
      var row = btn.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }
    
    function save_lang(result_id,url, action) {    
        form = document.getElementById("form_lang_edit");
        if(action === "db"){
            button = document.getElementById("save_button");
        }
        if (form.checkValidity() === false) {
            if(action === "db"){
                if(button.classList.contains('btn-primary')){
                    button.classList.remove('btn-primary');
                }
                if(button.classList.contains('btn-success')){
                    button.classList.remove('btn-success');
                }
                button.classList.add('btn-danger');
            }
        } else {
                var formLocalData = [];
                jQuery('#'+otableId+' tr:not(:first)').each(function(i) {
                  var tb = jQuery(this);
                  var obj = {};
                  tb.find('input[type=text]').each(function() {
                    obj[this.name] = this.value;
                  });
                  obj['row'] = i;
                  formLocalData.push(obj);
                });                       
                var lData = {};
                var i = 0;
                formLocalData.forEach(function(element) {                    
                    lData[i] = {};
                    lData[i].pharase = element.original_phrase;
                    lData[i].phrase_lng = element.locle_phrase;
                    i++
                });               
                var jldata =  JSON.stringify(lData);
                
                var formData = jQuery("#form_lang_edit").serializeArray();
                var jfdata =  JSON.stringify(formData);
                                      
                var ajdata = new FormData();   
                ajdata.append('langData', jfdata);
                ajdata.append('langDictionary', jldata);
                ajdata.append('action', action);
                jQuery.ajax({
                    url:     url, 
                    cache       : false,
                    contentType : false,
                    processData : false,
                    data        : ajdata,                         
                    type        : 'post',
                    success: function(response) {
                    document.getElementById(result_id).innerHTML = response;
                    if(action === "db"){
                            if(button.classList.contains('btn-primary')){
                               button.classList.remove('btn-primary');
                           }
                           if(button.classList.contains('btn-danger')){
                               button.classList.remove('btn-danger');
                           }
                           button.classList.add('btn-success');
                    }
                },
                error: function(response) {
                    document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
                }
             });
        }
    }
    