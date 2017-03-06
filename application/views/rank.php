<div class="container-fluid">
  <div class="row">
  <?php include('sidebar.php'); ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">

      <div class="container">
          <div class="row">
          <!-- VERSION 
            <div id="no-more-tables">
              <div class = ''>
                <table class="col-sm-12 table-classement table-bordered table-striped table-condensed cf table-fill">

                <thead class="cf">
                  <tr>
                    <th>Rang</th>
                    <th>Membre</th>
                    <th>Points</th>
                    <th>Gallions gagnés</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td data-title="Rang">1</td>
                    <td data-title="Membre"><img src="images/avatars/noxus.jpg" width="30" height="30">NoXuS</td>
                    <td data-title="Points" class="numeric">673</td>
                    <td data-title="Gallions gagnés" class="numeric">567 804</td>
                  </tr>
                  <tr>
                    <td data-title="Rang">2</td>
                    <td data-title="Membre"><img src="images/avatars/psylaw.jpg" width="30" height="30">Psylaw</td>
                    <td data-title="Points" class="numeric">589</td>
                    <td data-title="Gallions gagnés" class="numeric">486 736</td>
                  </tr>
                  <tr>
                    <td data-title="Rang">3</td>
                    <td data-title="Membre"><img src="images/avatars/nuagoz.jpg" width="30" height="30">Nuagoz</td>
                    <td data-title="Points" class="numeric">547</td>
                    <td data-title="Gallions gagnés" class="numeric">321 456</td>
                  </tr>
                  <tr>
                    <td data-title="Rang">4</td>
                    <td data-title="Membre"><img src="images/avatars/fohn.jpg" width="30" height="30" style="margin-right: 45px;">Fohn</td>
                    <td data-title="Points" class="numeric">421</td>
                    <td data-title="Gallions gagnés" class="numeric">311 178</td>
                  </tr>
                  <tr>
                    <td data-title="Rang">5</td>
                    <td data-title="Membre"><img src="images/avatars/neg.jpg" width="30" height="30"style="margin-right: 50px;">Neg</td>
                    <td data-title="Points" class="numeric">326</td>
                    <td data-title="Gallions gagnés" class="numeric">234 852</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> -->

         
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Position</th>
                      <th>Pseudo</th>
                      <th>Points</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $table = "";
                      foreach ($rank as $key => $value):
                        $key += 1;
                        $table .= "<tr>";
                          $table .= "<td>".$key."</td>";
                          $table .= "<td>";
                          $table .= "<a href = '".base_url('profile/member')."/".$value['id']."'>";
                          $table .= $value['pseudo'];
                          $table .= "</a>";
                          $table .= "</td>";
                          $table .= "<td>".$value['points']."</td>";
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
</div>


