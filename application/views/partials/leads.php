<header>

	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script>
      $(document).ready(function(){


      });//document ready
    </script>
</header>

    <div class="leads">
    	<table class = 'table'>
    		<tr>
    			<th>leads_id</th>
    			<th>first name</th>
    			<th>last name</th>
    			<th>registered datetime</th>
    			<th>email</th>
    		</tr>
    		<?php  
    			foreach ($leads as $lead) {
    		?>
    			<tr>
    				<td><?=$lead['id']?></td>
    				<td><?=$lead['first_name']?></td>
    				<td><?=$lead['last_name']?></td>
    				<td><?=$lead['registered_datetime']?></td>
    				<td><?=$lead['email']?></td>
    			</tr>
    		<?php
    			}
    		?>		
    	</table>
    </div>