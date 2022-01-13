<?php
  include ('./accesscontrol.php');


//get a listing of the .fil files in "data_files' directory
//sort the .fil files alphabetically
//$num_fil_files = number of .fil files found
//$fil_file_names[] is the array that stores the names of all the .fil files
  include ('get_names_of_various_fil_files.php');


  if (isset($_POST['delete_name']) == True And $_POST["ID_to_delete"] != "")
  {
    $_POST['delete_name'] = False;

    //read in the contents of the selected .fil file into an array()
    $line_fil_array = file("./data_files/" . $_SESSION['current_selected_fil_file']);

    //now go through every line of data and delete the one with
    $ID_to_delete = intval($_POST["ID_to_delete"]);

    $_POST["ID_to_delete"] = "";

    $line_fil_array[$ID_to_delete] = "";

    $fh = fopen("./data_files/" . $_SESSION['current_selected_fil_file'], "w");

    for ($x = 0; $x <= count($line_fil_array) - 1; $x++)
    {
      if ($line_fil_array[$x] != "") { $fout = fwrite($fh, $line_fil_array[$x]); }
    }

    fclose($fh);

    //read in the contents of the selected .fil file into an array()
    $line_fil_array = file("./data_files/" . $_SESSION['current_selected_fil_file']);

    $_SESSION['everyones_natal_data'] = $line_fil_array;
  }


  if (isset($_POST['fil_file_select']) == True)
  {
    $fil_file_to_use = $_POST["fil_files"];
    $_SESSION['current_selected_fil_file'] = trim(safeEscapeString($fil_file_to_use[0]));

    //read in the contents of the selected .fil file into an array()
    $line_fil_array = file("./data_files/" . $_SESSION['current_selected_fil_file']);

    $_SESSION['everyones_natal_data'] = $line_fil_array;
  }


  if ($_SESSION['current_selected_fil_file'] != "" And file_exists("./data_files/" . $_SESSION['current_selected_fil_file']) == True)
  {
    //read in the contents of the selected .fil file into an array()
    $line_fil_array = file("./data_files/" . $_SESSION['current_selected_fil_file']);

    $_SESSION['everyones_natal_data'] = $line_fil_array;
  }


  echo "<br>";

  echo "<table><tr>";
    echo "<td align='center' valign='top'>";
      echo "<form action='index.php' method='post' style='width:440px; margin-left:100px; background:#bebeee;'>";
      echo "<fieldset><legend><font size='3' color='#0000ff'><b>Pick a .fil file in order to see its data</b></font></legend>";

      //display all the .fil files found in a selection listbox
      //lov_file[ replaced by fil_files[
      echo "<select style='width:410px;' name='fil_files[]' size='10'>";

      for ($x = 1; $x <= $num_fil_files; $x++)
      {
        if ($fil_file_names[$x] == $_SESSION['fil_file_to_use'])
        {
          echo "<option selected value=' $fil_file_names[$x] ' >$fil_file_names[$x]</option>";
        }
        else
        {
          echo "<option value=' $fil_file_names[$x] ' >$fil_file_names[$x]</option>";
        }
      }

      echo "</select>";

      echo "<br><br>";

      //set up a button which will load the data from the .fil file selected
      echo "<input class='buttonbar' type='submit' name='fil_file_select' value='Load data from selected .fil file' style='font-size:14px;font-weight:bold;width:280px;background-color:#ffff00;color:#000000'>";

      echo "</fieldset>";
      echo "</form>";

      ?>
      <br>

      <form action="data_entry.php" method="post">
        <table cellspacing="0" cellpadding="1" style="font-size:12px;">
          <tr>
            <td align="center">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='hidden' maxlength="7" size="8">
            </td>

            <td align="center">
              &nbsp;&nbsp;&nbsp;<input type="submit" name="add_an_entry" value="Add another person's birth data" style="width:235px;background-color:#0000ff;color:#ffffff;font-size:16px;font-weight:normal">
            </td>
          </tr>
        </table>
      </form>
      <?php
    echo "</td>";

    echo "<td align='center' valign='top'>";
      echo "<form action='index.php' method='post' style='width:440px; margin-left:10px; background:#bebeee;'>";
      echo "<fieldset><legend><font size='3' color='#0000ff'><b>Use the ID numbers for chart calculations</b></font></legend>";

      //display all the .fil files found in a selection listbox
      //lov_file[ replaced by fil_files[
      echo "<select style='width:410px;' name='fil_files[]' size='10'>";

      for ($i = 0; $i <= count($line_fil_array) - 1; $i++)
      {
        echo "<option value=' $line_fil_array[$i] '>" . $i . " - " . $line_fil_array[$i] . "</option>";
      }

      echo "</select>";

      echo "<br><br><font size='2'><b>.fil file selected = " . $_SESSION['current_selected_fil_file'] . "</b></font><br>";

      echo "</fieldset>";
      echo "</form>";

      ?>
      <br>

      <form action="data_entry.php" method="post">
        <table cellspacing="0" cellpadding="1" style="font-size:12px;">
          <tr>
            <td align="center">
              ID #: <input maxlength="7" size="8" name="ID_to_modify" value="">
            </td>

            <td align="center">
              &nbsp;&nbsp;&nbsp;<input type="submit" name="modify_data" value="Modify this person's birth data" style="width:235px;background-color:#00cc00;color:#000000;font-size:16px;font-weight:normal">
            </td>
          </tr>
        </table>
      </form>

      <br>

      <form action="index.php" method="post">
        <table cellspacing="0" cellpadding="1" style="font-size:12px;">
          <tr>
            <td align="center">
              ID #: <input maxlength="7" size="8" name="ID_to_delete" value="">
            </td>

            <td align="center">
              &nbsp;&nbsp;&nbsp;<input type="submit" name="delete_name" value="Delete this person from your database" style="width:285px;background-color:#ff0000;color:#ffffff;font-size:16px;font-weight:normal">
            </td>
          </tr>
        </table>
      </form>
      <?php
    echo "</td>";
  echo "</tr></table>";


  $months = array (0 => 'Choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');


  echo "<div id='content'>";
?>


<script type="text/javascript" src="tabber.js"></script>
<link rel="stylesheet" href="example.css" TYPE="text/css" MEDIA="screen">

<script type="text/javascript">
  /* Optional: Temporarily hide the "tabber" class so it does not "flash" on the page as plain HTML. After tabber runs, the class is changed to "tabberlive" and it will appear. */
  document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>

<style type="text/css">
h9
{
  font-family: Arial, Helvetica, sans-serif;
  color: #B90000;
  font-size: 12px;
}
#content a:link
{
  font-family: Arial, Helvetica, sans-serif;
  color: #0000ff;
  font-size: 12px;
  font-weight: bold;
}
#content a:visited
{
  font-family: Arial, Helvetica, sans-serif;
  color: #B90000;
  font-size: 12px;
  font-weight: bold;
}
#content a:hover
{
  font-family: Arial, Helvetica, sans-serif;
  color: #ff00ff;
  font-size: 12px;
  font-weight: bold;
}
</style>


<div class="tabber" id="tab1">
  <div class="tabbertab" id="tab1" title="Natal Chart Report">
    <br>
    <h9>Natal Chart Report - </h9><strong>Enter an ID number in the box below to generate a natal chart report for that person.</strong><br><br>

    <form action="natal.php" method="post" target='_blank' style="width: 750px;">
      <table cellspacing="0" cellpadding="1" style="font-size:12px;">
        <tr>
          <td align="left">
            ID #:
            <input size="6" name="id1" value="">
          </td>

          <td>
            <input type="hidden" name="submitted" value="submitted">
            &nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="Click here to produce a natal chart and its interpretation report" style="background-color:#ddddee;color:#0000ff;font-size:12px;font-weight:normal">
          </td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>


  <div class="tabbertab" id="tab1" title="Transits to Natal Chart">
    <br>
    <h9>Transits for Any Date compared to your Natal Chart</h9><br><strong>Enter an ID number in the box below to generate Transits for Any Date compared to your Natal Chart.</strong><br><br>

    <form action="transits_mp.php" method="post" target='_blank' style="width: 750px;">
      <table cellspacing="0" cellpadding="7" style="font-size:12px;">
        <tr>
          <td align="left">
            ID #:
            <input size="6" name="id1" value="">

            <b>&nbsp;&nbsp;&nbsp;Transit date:</b>
            <?php

            $start_month = strftime("%m", time());
            $start_day = strftime("%d", time());
            $start_year = strftime("%Y", time());

            echo '&nbsp;&nbsp;&nbsp;<select name="start_month">';
            foreach ($months as $key => $value)
            {
              echo "<option value=\"$key\"";
              if ($key == $start_month)
              {
                echo ' selected="selected"';
              }
              echo ">$value</option>\n";
            }
            echo '</select>';
            ?>

            &nbsp;&nbsp;&nbsp;<input size="2" maxlength="2" name="start_day" value="<?php echo $start_day; ?>">
            <b>,</b>&nbsp;
            &nbsp;&nbsp;&nbsp;<input size="4" maxlength="4" name="start_year" value="<?php echo $start_year; ?>">
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <input type="hidden" name="submitted" value="submitted">
            &nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="Click here to produce Transits for Any Date compared to your Natal Chart" style="background-color:#ddddee;color:#0000ff;font-size:12px;font-weight:normal">
          </td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>


  <div class="tabbertab" id="tab1" title="Progressions & Transits">
    <br>
    <h9>Progressions and Transits for Any Date compared to your Natal Chart</h9><br><strong>Enter an ID number in the box below to generate Progressions/Transits for Any Date compared to your Natal Chart.</strong><br><br>

    <form action="transits_progressed.php" method="post" target='_blank' style="width: 750px;">
      <table cellspacing="0" cellpadding="7" style="font-size:12px;">
        <tr>
          <td align="left">
            ID #:
            <input size="6" name="id1" value="">

            <b>&nbsp;&nbsp;&nbsp;Progressed date:</b>
            <?php

            $start_month = strftime("%m", time());
            $start_day = strftime("%d", time());
            $start_year = strftime("%Y", time());

            echo '&nbsp;&nbsp;&nbsp;<select name="start_month">';
            foreach ($months as $key => $value)
            {
              echo "<option value=\"$key\"";
              if ($key == $start_month)
              {
                echo ' selected="selected"';
              }
              echo ">$value</option>\n";
            }
            echo '</select>';
            ?>

            &nbsp;&nbsp;&nbsp;<input size="2" maxlength="2" name="start_day" value="<?php echo $start_day; ?>">
            <b>,</b>&nbsp;
            &nbsp;&nbsp;&nbsp;<input size="4" maxlength="4" name="start_year" value="<?php echo $start_year; ?>">
          </td>
        </tr>

        <tr>
          <td colspan='2'>
            <input type="hidden" name="submitted" value="submitted">
            &nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="Click here for Progressions/Transits for Any Date compared to your Natal Chart" style="background-color:#ddddee;color:#0000ff;font-size:12px;font-weight:normal">
          </td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>


  <div class="tabbertab" id="tab1" title="Synastry Chart Report">
    <br>
    <h9>Synastry Report - </h9><strong>Enter two ID numbers in the boxes below to see your synastry with another person (including a report).</strong><br><br>

    <form action="synastry.php" method="post" target='_blank' style="width: 750px;">
      <table cellspacing="0" cellpadding="1" style="font-size:12px;">
        <tr>
          <td align="left">
            ID #1:
            <input size="6" name="id1" value="">
          </td>

          <td align="left">
            &nbsp;&nbsp;&nbsp;ID #2:
            <input size="6" name="id2" value="">
          </td>

          <td colspan='2'>
            <input type="hidden" name="submitted" value="submitted">
            &nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="Click to see your synastry (compatibility) with another person - plus a report" style="background-color:#ddddee;color:#0000ff;font-size:12px;font-weight:normal">
          </td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>


  <div class="tabbertab" id="tab1" title="Dual Cosmodynes">
    <br>
    <h9>Dual Cosmodynes (with synastry report) - </h9><strong>Enter two ID numbers in the boxes below to see your astrological compatibility.</strong><br><br>

    <form action="dual_cosmodynes.php" method="post" target='_blank' style="width: 750px;">
      <table cellspacing="0" cellpadding="1" style="font-size:12px;">
        <tr>
          <td align="left">
            ID #1:
            <input size="6" name="id1" value="">
          </td>

          <td align="left">
            &nbsp;&nbsp;&nbsp;ID #2:
            <input size="6" name="id2" value="">
          </td>

          <td colspan='2'>
            <input type="hidden" name="submitted" value="submitted">
            &nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="Click here to see your dual cosmodynes (check your compatibility)" style="background-color:#ddddee;color:#0000ff;font-size:12px;font-weight:normal">
          </td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>

<br><br>

</div>

