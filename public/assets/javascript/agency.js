

$(document).ready(function() {

    let table = $('#table').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': URLROOT + 'app/controllers/agencyController.php'
        },
        'columns': [
            { data: 'id' },
            { data: 'longitude' },
            { data: 'latitude' },
            { data: 'bank_name' },
            { data: 'id',
                render : function(data, type, row) {
                    return '<button class="delete mx-2" type="button" data-id=' + data + '><i class="fa-solid fa-trash-can"></i></button></td><td class="border-x-2 border-b-2 border-black"><button class="edit mx-2" type="button" data-id=' + data + '><i class="fa-solid fa-pen-nib"></i></button>'
                } 
            },
            
         ]
    });

    table.draw();
    $('#table').css("width", "100%");

    $(document).on('click', '.delete', function(){
        let id = $(this).data('id');
        // $row = $(this).parents("tr");
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id,
            },
            success: function(response){
                // remove the deleted comment
                // $row.remove();
                table.draw();
                $('#table').css("width", "100%");
            }
        });
    });

    $(document).on('click', '#add', function(){
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'GET',
            data: {
                'edit': 1
            },
            success: function(response){
                let data = JSON.parse(response);
                data = jQuery.makeArray(data);
                let html = "";
                data.forEach(e => {
                    html = "<option value=" + e.id + " id=" + e.id + ">" + e.name + "</option>";
                    $("#bank_id").append(html);
                });
                console.log(data[1].id);
                // console.log(response);
            }
        });
        $("#overlay").addClass("opacity-50 z-10");
        $("#form-wrapper").addClass("scale-100");
        $('#edit-form').addClass("hidden");
        // console.log(1);
    });

    $(document).on('click', '#overlay', function(){
        $("#form-wrapper").removeClass("scale-100");
        $("#overlay").removeClass("opacity-50 z-10");
        $('#edit-form').removeClass("hidden");
        $('#add-form').removeClass("hidden");
        // console.log(1);
    });

    $(document).on('submit', '#add-form', function(e){
        e.preventDefault();
        // let name = $('#name').val();
        // let logo = $('#logo').val();
        let formData = new FormData(this);
        console.log(formData.get('name'));
        formData.append('add', 1);
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                // remove the deleted comment
                // $row.remove();
                table.draw();
                $('#table').css("width", "100%");
                $("#form-wrapper").removeClass("scale-100");
                $("#overlay").removeClass("opacity-50 z-10");
                $('#edit-form').removeClass("hidden");
                $('#add-form').removeClass("hidden");
                $('#id').val('');
                $('#longitude').val('');
                $('#latitude').val('');
                $('#bank_id').val('');
                $('#address_id').val('');
                console.log(response);
            }
        });
    });

    $(document).on('click', '.edit', function(){
        let id = $(this).data('id');
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'GET',
            data: {
                'edit': 1,
                'id': id,
            },
            success: function(response){
                // remove the deleted comment
                let data = JSON.parse(response);
                $("#overlay").addClass("opacity-50 z-10");
                $("#form-wrapper").addClass("scale-100");
                $('#add-form').addClass("hidden");
                $('#edit-form #id').val(data['id']);
                $('#edit-form #longitude').val(data['longitude']);
                $('#edit-form #latitude').val(data['latitude']);
                $('#edit-form #city').val(data['city']);
                $('#edit-form #district').val(data['district']);
                $('#edit-form #street').val(data['street']);
                $('#edit-form #postal-code').val(data['postal_code']);
                $('#edit-form #email').val(data['email']);
                $('#edit-form #telephone').val(data['telephone']);


            }
        });
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'GET',
            data: {
                'edit': 1
            },
            success: function(response){
                let data = JSON.parse(response);
                data = jQuery.makeArray(data);
                let html = "";
                data.forEach(e => {
                    html = "<option value=" + e.id + " id=" + e.id + ">" + e.name + "</option>";
                    $("#edit-form #bank_id").append(html);
                });
                console.log(data[1]);
                // console.log(response);
            }
        });
    });

    $(document).on('submit', '#edit-form', function(e){
        e.preventDefault();
        // let id = $('#id').val();
        // let name = $('#name').val();
        // let logo = $('#logo').val();
        let formData = new FormData(this);
        formData.append('edit', 1);
        $.ajax({
            url: URLROOT + 'app/controllers/agencyController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                // remove the deleted comment
                // $row.remove();
                table.draw();
                $('#table').css("width", "100%");
                $("#form-wrapper").removeClass("scale-100");
                $("#overlay").removeClass("opacity-50 z-10");
                $('#edit-form').removeClass("hidden");
                $('#add-form').removeClass("hidden");
                console.log(response);
            }
        });
    });

});