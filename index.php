<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Worried about your kneecaps?</title>
<!--  <link rel="stylesheet" type="text/css" href="style.css">-->
</head>
 <body>
 
<body text="silver" LINK="silver" VLINK="silver" BACKGROUND="../home/Home_files/backgnd4.jpg" bgproperties="fixed">
<?
  if (isset($_POST['i'])) {
    $i = $_POST['i'];
    $L0 = $_POST['L0'];
    $l0 = $_POST['l0'];
    $p = $_POST['p'];
    $units = $_POST['units'];
    $c = $_POST['c'];
    $t = $_POST['t'];


// option to enter in units 1000's of dollars

   $L0 = 1000*$l0;

    $R = ($units == "fort") ? 2.1741 : 1;

    $I = 1.0000+($i/(12.000*100));

    $Lt = $L0*pow($I,12*$t) + ($c-($p*$R))*($I/(1-$I))*(1 - pow($I,12*$t));

    $A = ($c-($p*$R))*($I/(1-$I));

 

    $months = log($A/($A-$L0))/log($I);

    $time = $months/12;

    $total = $R*$p*$months;
 //system("./online-prog $i $L0 $p $c $R"); 


  } else {
    $i = $L0 = $p = $c = $t = 0;
    $units = "fort";
    $Lt = $time = 0;
  }
?>
<p>
<center><br>
<font size=5 face="arial">Debt and Home Loan Calculator</font><br>
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>#start">
<p><br>
<font size=4>
<table border=0 cellpadding=6 cellspacing=2>
<tr>
<td valign=top align=right><tt><b><font size=4>Interest rate </b></td>
<td valign=top><input type="text" name="i" value = "<?= $i ?>" size="5" maxlength="12"><b> %</b>

<a name = start>

<td valign=top align=right><tt><b><font size=4>Current balance $</b></td>
<td valign=top><input type="text" name="l0" value = "<?= $l0 ?>" size="4"><font size=3 face="arial"><b> ,000 [or pounds, etc.]</b>

</td>
</tr>

<td valign=top align=right><tt><b><font size=4>Repayments $</b></td>
<td valign=top><input type="text" name="p" value = "<?= $p ?>" size="7">


<td valign=top align=center><tt><b><font size=4>Frequency of payments</b></td>

<td valign=top>
    <? if ($units == "fort") { ?>
      <input type="radio" name="units" value="fort" checked> <tt><b><font size=3>fortnightly</b>
      <input type="radio" name="units" value="month"> <tt><b><font size=3><b>monthly</b>
    <? } else { ?>
      <input type="radio" name="units" value="fort" ><tt><b><font size=3>fortnightly</b>
      <input type="radio" name="units" value="month" checked ><tt><b><font size=3><b>monthly</b>
    <? } ?>
  </td>

<table border=0 cellpadding=6 cellspacing=2>
<tr>
<td valign=top align=right><tt><b><font size=4>Monthly bank charge $</b></td>
<td valign=top><input type="text" name="c" value = "<?= $c ?>" size="5">

<td valign=top align=right><tt><b><font size=4>In how many years?</b></td>
<td valign=top><input type="text" name="t"  value = "<?= $t ?>" size="5">
</td>
</tr>
</td>
</tr>
</td>
</table>



</td>
</table>

<strong>
<font size=5>
<br><br>
<table border=0 cellpadding=6 cellspacing=2>
<tr>
  <td><input type="submit" value="Find outstanding balance"></td>
  <td><strong>
<font size=4><tt><b>Outstanding <span id="lt">$  <? printf("%.0f", $Lt); ?></span></td>
</tr>
<tr>
  <td></td>
  <td><strong>
<font size==4><tt><b>Total eventually paid back is <span id="total">$<? printf("%.0f", $total); ?> </span> in <span id="time"><? printf("%.2f", $time); ?> years</span></font></td>
</tr>
<!--
<tr>
  <td></td>
  <td><strong>
<font size=4>Paid off in <span id="time"><? printf("%.2f", $time); ?> years</span></font></td>
</tr>-->
</table>


<!-- using php to write paramters to a file -->

<?
  
/*  $fp = fopen("/tmp/foo.txt", "w") or die("can't open /tmp/foo.txt");
  fwrite($fp, "$i  ");
  fwrite($fp, "$L0    ");
  fwrite($fp, "$p     ");
  fwrite($fp, "$c     ");
  fwrite($fp, "$R     ");
  fclose($fp);     */ //not writing to file anymore - straight to C online-prog.c
?>
</form>


</center>

<p> <!-- so far this is working, this file does calculation and passes
values to foo.txt. This is read by online-prog which should run pgplot
and produce new plot too display. NEED PGPLOT ON NEWT - RUNS ON
ASTRO BUT CANT GET PERMISSION TO WRITE foo.txt  -->

<p>
<?
  // exec("./online-prog < /tmp/foo.txt"); 
 //passthru("./online-prog < /tmp/foo.txt");
   
?>
</p>

<?
//php phpinfo() //gives all the info
?>


<!-- COMMENT OUT UNTIL WORKING - CANNOT USE SHELL COMMANDS TO RUN PGPLOT, PHP SCRIPT?
<p>
<center>
<a href="loan-plot.gif" TARGET=fav_96706010 ><img src="image.php"  height="500" width="700" border ="0"></a>
</center>
<br> 
-->

<p>
<strong>
<center><a href="../home/programs.html" target="pers"><font size=2 face="arial">Back</a></strong>
<p>


</body>
</html>
