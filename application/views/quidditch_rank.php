<div class="container-fluid">
  <div class="row">
	  <?php include('sidebar.php'); ?>
	  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
		<?php
			//$rank = affiche_classement($equipes);
			//echo $rank;
		?>
		<div class="col-lg-8 col-lg-offset-2">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>N°</th>
						<th>Équipe</th>
						<th>MJ</th>
						<th>G</th>
						<th>N</th>
						<th>P</th>
						<th>Pts</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$nuls;
					$table = "";
					foreach ($equipes_stats as $key => $value):
						$nuls = $value['nb_match'] - $value['nb_victoires'] - $value['nb_defaites'];
						$key += 1;
						$table .= "<tr>";
						$table .= "<td>".$key."</td>";
						$table .= "<td>";
						$table .= "<img class='logo_team' src = '".img_url('quidditch')."/".$value['logo']."'/>";
						$table .= "<a href = '".base_url('quidditch/team')."/".$value['id']."'>";
						$table .= $value['nom'];
						$table .= "</a>";
						$table .= "</td>";
						$table .= "<td>".$value['nb_match']."</td>";
						$table .= "<td>".$value['nb_victoires']."</td>";
						$table .= "<td>".$nuls."</td>";
						$table .= "<td>".$value['nb_defaites']."</td>";
						$table .= "<td class ='rankpoints'>".$value['points']."</td>";
						$table .= "<tr>";
					endforeach;
				echo $table;
				?>
				</tbody>
	        </table>
	    </div>
	  </div>
	</div>
</div>