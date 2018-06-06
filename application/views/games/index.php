<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games Store Management</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/open-iconic/font/css/open-iconic.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

    <section class="container">
        <h1>My Favorites Game List</h1>
        <button type="button" class="btn btn-primary" onclick="add_game()"> <span class="oi" data-glyph="plus" title="plus" aria-hidden="true"></span> Add New Game</button>
        <table id="table_id" class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($games as $game): ?>
                <tr>
                    <td><?php echo $game->id ?></td>
                    <td><?php echo $game->title ?></td>
                    <td><?php echo $game->releaseDate ?></td>
                    <td><?php echo $game->rating ?></td>
                    <td>
                        <a href="<?php echo base_url() . 'games/show/' . $this->encrypt->encode($game->id); ?>" class="btn btn-info"> <span class="oi" data-glyph="eye" title="eye" aria-hidden="true"></span> </a>
                        <button onclick="edit_game(<?php echo $game->id; ?>)" class="btn btn-warning"> <span class="oi" data-glyph="pencil" title="pencil" aria-hidden="true"></span> </button>
                        <button onclick="delete_game(<?php echo $game->id; ?>)" class="btn btn-danger"> <span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>

    <div id="modal_form" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form id="form" action="#">
                    <input type="hidden" value="" name="id">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="releaseDate">Release Date</label>
                        <input class="form-control" type="text" name="releaseDate" id="releaseDate">
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input class="form-control" type="text" name="rating" id="rating">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="save()" type="button" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </div>
    </div>
    
    <!-- General Javascript -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- Page Spesific Javascript -->
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/dataTables.bootstrap4.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        })

        var save_method;
        var table;


        function add_game(){
            save_method = 'add';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
        }

        function save(){
            var url;

            if(save_method == 'add'){
                url = "<?php echo site_url('Games/game_add'); ?>";
            }else{
                url = "<?php echo site_url('Games/game_update'); ?>"; 
            }

            console.log(url);

            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data){
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error ' + errorThrown);
                }
            });
        }

        function edit_game(id){
            save_method = 'update';
            $('#form')[0].reset();

            // Load data dari ajax
            $.ajax({
                url: "<?php echo site_url('Games/game_edit/'); ?>" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data){
                    $("[name='id'").val(data.id);
                    $("[name='title']").val(data.title);
                    $("[name='releaseDate']").val(data.releaseDate);
                    $("[name='rating']").val(data.rating);

                    $('#modal_form').modal('show');

                    $('.modal_title').text('Edit Book');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert("Error " + errorThrown);
                }
            })
        }

        function delete_game(id){
            if(confirm("Are ou sure delete this data ? ")){
                $.ajax({
                    url: '<?php echo site_url('Games/game_delete/'); ?>' + id,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(data){
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert('Error ' + errorThrown);
                    }
                })
            }
        }

    </script>
</body>
</html>