<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
	$pos_male = 1;
	$pos_female = 1;
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Results</h3>
            </div>
            <div class = "panel-body">
            	<h1>Ladies' Competition</h1>
            <div class = "table-responsive">
       <table class = "table table-bordered">
        <thead>
          <tr>
            <th>Pos</th>
            <th>Rider</th>
            <th>Points</th>
	          <?php
		          for ( $i = 1 ; $i <= 18 ; $i ++ )
		          {
			          echo '<th>' . $i . '</th>';
		          }
	          ?>
          </tr>
        </thead>
        <tbody>
        		<?php $query = mysql_query ( "SELECT * FROM results WHERE gender='female' order by Points DESC" );
			        while ( ( $row = mysql_fetch_assoc ( $query ) ) )
			        {
				        echo ' <tr>';
				        echo ' <td>' . $pos_female ++ . '</td>';
				        echo ' <td>' . $row[ 'Rider' ] . '</td>';
				        echo ' <td>' . $row[ 'Points' ] . '</td>';
				        for ( $i = 1 ; $i <= 18 ; $i ++ )
				        {
					        echo ' <td>' . $row[ $i ] . '</td>';
				        }
				        echo ' </tr>';
			        }
		        ?>
        	

        </tbody>
      </table>      
      </div> 
      
                  	<h1>Mens' Competition</h1>
            <div class = "table-responsive">
       <table class = "table table-bordered">
        <thead>
          <tr>
            <th>Pos</th>
            <th>Rider</th>
            <th>Points</th>
	          <?php
		          for ( $i = 1 ; $i <= 18 ; $i ++ )
		          {
			          echo '<th>' . $i . '</th>';
		          }
	          ?>
          </tr>
        </thead>
        <tbody>
        		<?php $query = mysql_query ( "SELECT * FROM results WHERE gender='male' order by Points DESC" );
			        while ( ( $row = mysql_fetch_assoc ( $query ) ) )
			        {
				        echo ' <tr>';
				        echo ' <td>' . $pos_male ++ . '</td>';
				        echo ' <td>' . $row[ 'Rider' ] . '</td>';
				        echo ' <td>' . $row[ 'Points' ] . '</td>';
				        for ( $i = 1 ; $i <= 18 ; $i ++ )
				        {
					        echo ' <td>' . $row[ $i ] . '</td>';
				        }
				        echo ' </tr>';
			        }
		        ?>
        	

        </tbody>
      </table>      
      </div> 
   </div></div>
<?php include 'includes/overall/footer.php'; ?>