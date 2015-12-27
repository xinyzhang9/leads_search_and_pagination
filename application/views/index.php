
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style type ="text/css">
  body{
    margin: 20px
  }
	input{
		display: inline-block;
		margin: 10px 10px 10px 0;
	}

	.posts{
		width: 400px;
		margin: 10px 10px 10px 0;
		vertical-align: top;
		display: inline-block;
		border: 1px solid silver;
		border-radius: 20px;
		padding: 20px;
		
	}
  ul{
    text-align: right;
  }
	li{
    color: blue;
  }
  button{
    vertical-align: top;
  }
	</style>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
   	<script>
      $(document).ready(function(){

      $.get("/leads/index_html",function(res){
        //display all
        $('#leads').html(res);
      });

      $('#reset').click(function(){
        $('#search_name').val('');
        $('#date_from').val('');
        $('#date_to').val('');
        $.get("/leads/index_html",function(res){
            //display all
            $('#leads').html(res);
        });


      })

      	// $('form.search').submit(function(){
      	// 	$.post('/leads/search',$(this).serialize(),function(res){
      	// 		$('#leads').html(res);
      	// 	});
       //    return false;
      	// });

        $('input').change(function(){
          $.post('/leads/search',$('form.search').serialize(),function(res){
            $('#leads').html(res);
          });
          return false;
        });

        $('a').click(function(){
            $.post("/leads/pagination",
            {
                name: $('#search_name').val(),
                date_from: $('#date_from').val(),
                date_to: $('#date_to').val(),
                page: $(this).text()
            },
            function(res){
                $('#leads').html(res);
            });
            return false;
        });    

      });//document ready
    </script>
</head>
<body>
  <h1>Leads</h1>

	<!-- remove the form action!!! otherwis it will insert into database twice! -->
    <form class = 'search' action = '/leads/search' method="post">   
        name: <input type="text" id = 'search_name' name = "name">
      Date from: <input type="date" id = 'date_from' name = "date_from">
      Date to: <input type="date" id = 'date_to' name = "date_to">
<!--       <input type="submit" value="search" class = "btn btn-success">
 -->      
      <input type = "button" id = "reset" class = 'btn btn-danger' value = "reset">
    </form>
    <hr>
    <ul class = "list-inline">
      <?php  
        for ($i=1; $i<8 ; $i++) {
      ?>
        <li><a id = 'li_<?= $i?>'><?= $i?></a></li>
        <?php if($i !=7){ ?>
          <li> | </li>
        <?php }?>
        

      <?php
        }
      ?>
    </ul>
    <div id="leads">
    </div>
    
  </body>
</html>