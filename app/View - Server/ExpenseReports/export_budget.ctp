
<?php
if($type=='Export')
{
$fileName = "Budget_Export";
	header("Content-Type: application/vnd.ms-excel; name='excel'");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$fileName.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
}
    
?>




                <table border="1">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Branch</th>
                            <th>EntryNo</th>
                            <th>Finance Year</th>
                            <th>Finance Month</th>
                            <th>Head</th>
                            <th>Sub Head</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Payment File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; $Total=0;//print_r($ExpenseReport);
                                foreach($ExpenseReport as $exp)
                                {
                                    echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$exp['0']['Branch']."</td>";
                                        echo "<td>".$exp['0']['EntryNo']."</td>";
                                        echo "<td>".$exp['0']['FinanceYear']."</td>";
                                        echo "<td>".$exp['0']['FinanceMonth']."</td>";
                                        echo "<td>".$exp['0']['HeadingDesc']."</td>";
                                        echo "<td>".$exp['0']['SubHeadingDesc']."</td>";
                                        echo "<td>".$exp['0']['Amount']."</td>";
                                        echo "<td>".$exp['0']['date']."</td>";
                                        if($exp['0']['bus_status']!='Closed')
                                        echo '<td style="background-color:red;color:#FFF;text-align:center;"><b>'.$exp['0']['bus_status']."</b></td>";
                                        else
                                         echo '<td style="background-color:green;color:#FFF;text-align:center;"><b>'.$exp['0']['bus_status']."</b></td>";
                                        echo '<td style="text-align:center;">';
                                        if(!empty($exp['0']['PaymentFile']))
                                            echo '<a href="'.$this->webroot.'expense_file'.DS.$exp['0']['PaymentFile'].'">'.$this->Html->image('download.png', array('alt' => "download",'hieght'=>'15','width'=>'15','class' => 'img-rounded')).'</a>';
                                        echo '</td>';
                                        echo '<td style="text-align:center;">';
                                        if($exp['0']['bus_status']=='Closed' && $exp['0']['Action']=='1')
                                        {
                                            echo $this->Html->link('Re-Open Business Case',array('controller'=>'ExpenseEntries','action'=>'business_case_ropen','?'=>array('Id'=>$exp['0']['Id']),'full_base' => true));
                                        }
                                        else if($exp['0']['Action']=='1')
                                        {
                                            echo '<a href="#" id="myBtn" onclick="get_pop_up('."'".$exp['0']['Branch']."','".$exp['0']['FinanceYear']."','".$exp['0']['FinanceMonth']."','".$exp['0']['HeadingDesc']."','".$exp['0']['SubHeadingDesc']."','".$exp['0']['Amount']."','".$exp['0']['Id']."'".')">Close</a>';
                                        }
                                        echo '</td>';
                                    echo "</tr>";
                                     $Total += $exp['0']['Amount'];
                                }
                                echo "<tr>";
                                    echo '<td colspan="6"></td><td><b>Total</b></td>';
                                    echo '<td><b>'.$Total.'</b></td>';
                                    echo '<td colspan="4"></td>';
                                echo "</tr>";
                        ?>
                    </tbody>
                </table>    
            
		<?php exit; ?>


		
					
		
           

