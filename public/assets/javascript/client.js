

$(document).ready(function() {

    let table = $('#table').DataTable();

    table.draw();
    $('#table').css("width", "100%");

    $(document).on({
        mouseenter: function(){
            // $(this).removeClass("max-h-5 max-h-10");
            // $(this).addClass("scale-150");
            html = $(this).clone();
            html.removeClass("max-h-5 max-h-10");
            $("#hovered-image-wrapper").append(html[0]);
            // $("#overlay").addClass("w-[25%] opacity-100 z-10");
            $("#hovered-image-wrapper").addClass("z-20");
            console.log(1);
        },
        mouseleave: function(){
            // $(this).addClass("max-h-5 max-h-10");
            // $(this).removeClass("scale-150");
            $("#hovered-image-wrapper").empty();    
            // $("#overlay").removeClass("w-[25%] opacity-100 z-10");
            $("#hovered-image-wrapper").removeClass("z-[-1]");
            console.log(0);
            console.log($(this)[0]);
        }
    }, ".rendered-logo");

    $(document).on('click', '.delete', function(){
        let id = $(this).data('id');
        // $row = $(this).parents("tr");
        $.ajax({
            url: '../app/controllers/bank.php',
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
            url: '../app/controllers/bank.php',
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
                $('#name').val('');
                $('#logo').val('');
            }
        });
    });

    $(document).on('click', '.edit', function(){
        let id = $(this).data('id');
        $.ajax({
            url: '../app/controllers/bank.php',
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
                $('#edit-id').val(data['id']);
                $('#edit-name').val(data['name']);
                $('#edit-logo').val(data['logo']);

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
            url: '../app/controllers/bank.php',
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
            }
        });
    });

});