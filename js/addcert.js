document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('input[name="send"]').addEventListener('click', preview, false);
}, false);

function preview(){
    var name  = document.querySelector('input[name="name"]').value;
    var owner  = document.querySelector('input[name="owner"]').value;
    var file_name  = document.querySelector('input[name="file_name"]').value;
    var image_file_name  = document.querySelector('input[name="image_file_name"]').value;
    var active_from  = document.querySelector('input[name="active_from"]').value;
    var active_to  = document.querySelector('input[name="active_to"]').value;

    document.querySelector('#form-value').innerHTML = name + '<br />' + owner + '<br />' + file_name + '<br />' + image_file_name + '<br />' + active_from + '<br />' + active_to;
}