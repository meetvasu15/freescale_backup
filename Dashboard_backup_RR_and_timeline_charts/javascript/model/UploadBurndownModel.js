/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
 

function initializeUploadBtn() {

    $('#fileupload').fileupload({
        dataType: 'json',
        add: function(e, data) {
//            data.context = $('<button/>').text('Upload') 
//                    .appendTo($('#burndownUploadDiv'))
//                    .click(function() {
//                //data.context = $('<p/>').text('Uploading...').replaceAll($(this));
//
//                data.submit();
//            }); 
        data.formData= {burndownChartType: $("#burnDownSelectMenu option:selected").val() , npi_id:$('#burndown_modal_npi_id').val()};
             data.submit();
        },
        done: function(e, data) {
            // data.context.text('Upload finished.');
           // alert(data._response.result);
            drawVisualization(data._response.result);
        },
        error: function(e, data) {
            alert("Error while uploading, please try after sometime.");
        }, progressall: function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                    'width',
                    progress + '%'
                    );
        }
    });
    
     

}
