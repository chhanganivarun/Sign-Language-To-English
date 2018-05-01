<!DOCTYPE html>
<html>
    <head>
        <title>Sign Language to English Convertor</title>
        <style>
            table,tr,td{
                text-align:center;
                border:1px solid black;
                border-collapse: collapse;
            }
            .big{
                font-size: 55px;
            }
        </style>
    </head>
    <body>
        <table style="text-align:center; border=1px solid black;">
            <tr>
                <td>
                    Left Hand
                </td>
                <td>
                    Right Hand
                </td>
            </tr>
            <tr>
                <?php
                
                    include "interpret_sensors.php";
                    $lo="Undefined";
                    $ro="Undefined";
                    $to="Undefined";
                    
                    echo file("left.in")[0]."<br>";
                    echo file("right.in")[0]."<br>";
                    parse_str(file("left.in")[0]);
                    parse_str(file("right.in")[0]);

                /**/
                    {
                        if($l1==1 && $l2==0 && $l3==0 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110 )
                        {
                            $lo="One";
                        }

                        else if($l1==1 && $l2==1 && $l3==0 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110)
                        {	
                            $lo="Two";
                        }
                        else if($l1==1 && $l2==1 && $l3==1 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110 )
                        {
                            $lo="Three";
                        }
                        else if($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==0 && $lx >= 70 && $lx <= 110 )
                        {
                            $lo="Four";
                        }
                        else if($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 )
                        {
                            $lo="Five";
                        }
                        else if($l1==0 && $l2==0 && $l3==0 && $l4==1 && $l5==0)
                        {
                            $lo="Urination";
                        }
                        else if($l1==0 && $l2==0 && $l3==1 && $l4==1 && $l5==0)
                        {
                            $lo="Excretion";
                        }
                        else if($l1==1 && $l2==0 && $l3==0 && $l4==0 && ($lx >= 340 || $lx <= 20) )
                        {
                            $lo="For pointing there";
                        }
                        else if($l1==1 && $l2==0 && $l3==0 && $l4==1)
                        {
                            $lo="Yo";
                        }



                        if($r1==1 && $r2==0 && $r3==0 && $r4==0 && $r5==0 && $rx >= 70 && $rx <= 110)
                        {
                            $ro="One";
                        }
                        else if($r1==1 && $r2==1 && $r3==0 && $r4==0 && $r5==0 && $rx >= 70 && $rx <= 110)
                        {
                            $ro="Two";
                        }

                        else if($r1==1 && $r2==1 && $r3==1 && $r4==0 && $r5==0 && $rx >= 70 && $rx <= 110)
                        {
                            $ro="Three";
                        }
                        else if($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==0 && $rx >= 70 && $rx <= 110)
                        {
                            $ro="Four";
                        }
                        else if($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx >= 70 && $rx <= 110)
                        {
                            $ro="Five";
                        }
                        else if($r1==0 && $r2==0 && $r3==0 && $r4==1 && $r5==0)
                        {
                            $ro="Urination";
                        }
                        else if($r1==0 && $r2==0 && $r3==1 && $r4==1 && $r5==0)
                        {
                            $ro="Excretion";
                        }
                        else if($r1==1 && $r2==0 && $r3==0 && $r4==0 && ($rx >= 340 || $rx <= 20))
                        {
                            $ro="For pointing there";
                        }
                        else if($r1==1 && $r2==0 && $r3==0 && $r4==1)
                        {
                            $ro="Yo";
                        }



                        else if((($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==0 && $r3==0 && $r4==0 && $r5==0 && $rx>=70 && $rx<=110))
                         xor (($l1==1 && $l2==0 && $l3==0 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110)))	
                        {
                            $to="Six";
                        }

                        else if((($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==0 && $r4==0 && $r5==0 && $rx>=70 && $rx<=110))
                         xor (($l1==1 && $l2==1 && $l3==0 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110)))	
                        {
                            $to="Seven";
                        }

                        else if((($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==0 && $r5==0 && $rx>=70 && $rx<=110))
                         xor (($l1==1 && $l2==1 && $l3==1 && $l4==0 && $l5==0 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110)))	
                        {
                            $to="Eight";
                        }

                        else if((($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==0 && $rx>=70 && $rx<=110))
                         xor (($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==0 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110)))	
                        {
                            $to="Nine";
                        }

                        else if((($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110))
                         xor (($l1==1 && $l2==1 && $l3==1 && $l4==1 && $l5==1 && $lx >= 70 && $lx <= 110 ) && ($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $rx>=70 && $rx<=110)))	
                        {
                            $to="Ten";
                        }
                        if($to=="Undefined")
                        {
                            if($lo=="Undefined")
                                $to=$ro;
                            else
                                $to=$lo;
                        }
                    }
                
                /**/
                //echo $l1.$l2.$l3.
                    
                    echo "<td class=\"big\">";
                    echo $lo;
                    echo "</td>";
                    echo "<td class=\"big\">";
                    echo $ro;
                    echo "</td>";
            echo "</tr>";
            echo "<tr class=\"big\" >";
                    echo "<td colspan=2>";
                    echo "Considering both hands:<br>".$to;
                    echo "</td>";
                    
                    if(isset($_GET['hand'])&&$_GET[hand]==1)
                    {
                        $print="l1=".$_GET[finger1]."&l2=".$_GET[finger2]."&l3=".$_GET[finger3]."&l4=".$_GET[finger4]."&l5=".$_GET[finger5]."&lx=".$_GET[x_degree]."&ly=".$_GET[y_degree]."&lz=".$_GET[z_degree]."\n";
                        $leftwrite=fopen("left.in","w");
                        fwrite($leftwrite,$print);
                        fclose($leftwrite);
                        echo "left ".$print."\n";
	                    header("Refresh:20; update.php");
                    }
                    if(isset($_GET['hand'])&&$_GET[hand]==0)
                    {
                         $print="r1=".$_GET[finger1]."&r2=".$_GET[finger2]."&r3=".$_GET[finger3]."&r4=".$_GET[finger4]."&r5=".$_GET[finger5]."&rx=".$_GET[x_degree]."&ry=".$_GET[y_degree]."&rz=".$_GET[z_degree]."\n";
                        $rightwrite=fopen("right.in","w");
                        fwrite($rightwrite,$print);
                        fclose($rightwrite);
                        echo "right ".$print."\n";
	                    header("Refresh:20; update.php");
                    }
                    if(!isset($_GET['hand']))
                    {
	                    header("Refresh:1; update.php");
                    
                    }
                ?>
            </tr>
        </table>
        
    </body>
</html>
